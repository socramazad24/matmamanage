"use client"

import { Navigate, Outlet } from "react-router-dom"
import { useAuth } from "../context/AuthContext"

const ProtectedRoute = ({ allowedRoles }) => {
  const { user, loading } = useAuth()

  if (loading) {
    return (
      <div className="flex items-center justify-center min-h-screen">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-secondary"></div>
      </div>
    )
  }

  if (!user) {
    return <Navigate to="/login" replace />
  }

  if (allowedRoles && !allowedRoles.includes(user.role)) {
    const dashboards = {
      administrador: "/admin",
      gerente: "/gerente",
      bodeguero: "/bodeguero",
    }
    return <Navigate to={dashboards[user.role] || "/login"} replace />
  }

  return <Outlet />
}

export default ProtectedRoute
