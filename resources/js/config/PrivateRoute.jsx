/* eslint-disable react/prop-types */

import { useEffect, useState } from "react";
import { Link, Navigate, useNavigate } from "react-router";
import { useAuthContext } from "../contexts/AuthProvider";
import appLogo from "../assets/appLogo.svg";

import { DefaultLogo, DefaultStyled, LogoutIcon } from "../layouts/layouts.styled";

export default function PrivateRoute({ children }){

  const { isLogged } = useAuthContext();

  if (!isLogged) return <Navigate to="/login" />;
  if (isLogged instanceof Promise) return <Protected>{children}</Protected>
  return children;
}

export const Protected = ({ children }) => {
  const { isLogged } = useAuthContext();
  const [isProtected, setIsProtected] = useState(false)
  const navigate = useNavigate()

  useEffect(() => {
    if (!isLogged) navigate('/login')
    if (isLogged === true) setIsProtected(isLogged)
  }, [isLogged])

  return (
    isProtected
      ? children
      : <DefaultStyled>
        <header>
          <DefaultLogo>
            <Link href="/">
              <img src={appLogo} />
            </Link>
          </DefaultLogo>
          <div>Dashboard</div>
        </header>
        <main>
          <section>
            <p>Verificando autenticação...</p>
          </section>
        </main>
      </DefaultStyled>
  );
}
