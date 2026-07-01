/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react-refresh/only-export-components */
import { createContext, useState, useContext, useEffect, useRef } from "react"
import  axiosClient, {getCsrfCookie} from "../utils/axios-client";

const VEIRIFY_USER_INTERVAL = import.meta.env.VITE_VEIRIFY_USER_INTERVAL || 60000

console.error(VEIRIFY_USER_INTERVAL)

const verifyUser = async () => {
    try {
        const { data } = await axiosClient.get('/user')
        if (!data) throw new Error("Erro ao recuperar usuário!")
        console.log({ data })
        return data;
    } catch (error) {
        const { response } = error
        response?.status === 401 && clearAuthStorages()
        console.error('Error:', error)
        throw error;
    }
}

const verifyLocalStorage = () => {
    try {
        const localStoragteUser = JSON.parse(localStorage.getItem('CURRENT_USER'));
        if (localStoragteUser?.name) return localStoragteUser
        return false
    } catch (error) {
        console.error(error)
        localStorage.removeItem('CURRENT_USER')
        return false
    }
}

const clearAuthStorages = () => {
    console.log('clear')
    console.log('CURRENT_USER')
    localStorage.removeItem('CURRENT_USER');
}

const AuthContext = createContext({})

export const AuthProvider = ({ children }) => {

    const [user, _setUser] = useState(null)

    const [isLogged, setIsLogged] = useState(() => {
        if (verifyLocalStorage())
            return verifyUser()
                .then(user => {
                    setUser(user)
                    setIsLogged(true)
                }).catch(error => {
                    console.error(error)
                    setIsLogged(false)
                })
        return false;
    })

    const intervalLogin = useRef(null);

    const setUser = (user) => {
        if(user){
            const {name, email} = user
            localStorage.setItem('CURRENT_USER', JSON.stringify({name,email}))
        }else clearAuthStorages();
        _setUser(user)
    }

    const auth = async (credentials) => {
        try {
            await getCsrfCookie()
            const response = await axiosClient.post("/login", credentials);
            if (response?.status !== 200) throw new Error(response.data);
            const { data } = response;
            console.log({ data });
            setUser(data.data);
            setIsLogged(true);
        } catch (error) {
            setIsLogged(false)
            throw error
        }
    }

    const verifyLogin = async () => {
        try {
            const user = await verifyUser()
            setUser(user)
            return true;
        } catch (error) {
            setUser(null)
            setIsLogged(false)
            console.error(error)
            return false;
        }
    }

    const logOut = async () => {
        await getCsrfCookie()
        await axiosClient.post('logout')
        setIsLogged(false)
        clearAuthStorages()
        setUser(null)
    }

    useEffect(() => {
        console.log(user)
        if (user) {
            intervalLogin.current = setInterval(async () => {
                console.log("Verificando login...");
                console.log(user)
                const isLogged = await verifyLogin();
                setIsLogged(isLogged);
                !isLogged && clearAuthStorages();
            }, VEIRIFY_USER_INTERVAL)
        }

        return () => {
            clearInterval(intervalLogin.current);
        }
    }, [user]);

    return (
        <AuthContext.Provider value={{
            user,
            isLogged,
            auth,
            logOut,
        }}>
            {children}
        </AuthContext.Provider>
    )
}

export const useAuthContext = () => useContext(AuthContext)
