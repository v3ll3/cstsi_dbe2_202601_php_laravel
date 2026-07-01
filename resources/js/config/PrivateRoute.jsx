/* eslint-disable react/prop-types */
import { Navigate } from "react-router";
import { useAuthContext } from "../contexts/AuthProvider";

export default function PrivateRoute({ children }){
  const { token } = useAuthContext();
  return token ? children : <Navigate to="/login" />;
};
