"use client"

import { createContext, useContext, useState, useEffect } from "react"
import { useNavigate } from "react-router-dom"
import api from "../services/api"

const AuthContext = createContext(null)

export const useAuth = () => {
  const context = useContext(AuthContext)
  if (!context) {
    throw new Error("useAuth must be used within an AuthProvider")
  }
  return context
}

export const AuthProvider = ({ children }) => {
  const [user, setUser] = useState(null)
  const [loading, setLoading] = useState(true)
  const navigate = useNavigate()

  useEffect(() => {
    checkAuth()
  }, [])

  const checkAuth = async () => {
    console.log("[v0] Checking authentication...")
    try {
      const response = await api.checkAuth()
      console.log("[v0] Auth check response:", response)
      if (response.success && response.authenticated) {
        setUser(response.data)
        console.log("[v0] User authenticated:", response.data)
      } else {
        console.log("[v0] User not authenticated")
      }
    } catch (error) {
      console.error("[v0] Error checking authentication:", error)
    } finally {
      setLoading(false)
    }
  }

  const login = async (username, password) => {
    console.log("[v0] Attempting login for user:", username)
    try {
      const response = await api.login(username, password)
      console.log("[v0] Login response:", response)
      if (response.success) {
        setUser(response.data)
        console.log("[v0] Login successful, redirecting to dashboard for role:", response.data.role)
        redirectToDashboard(response.data.role)
      }
      return response
    } catch (error) {
      console.error("[v0] Login error:", error)
      throw error
    }
  }

  const logout = async () => {
    console.log("[v0] Logging out...")
    try {
      await api.logout()
      setUser(null)
      navigate("/login")
      console.log("[v0] Logout successful")
    } catch (error) {
      console.error("[v0] Logout failed:", error)
    }
  }

  const redirectToDashboard = (role) => {
    const dashboards = {
      administrador: "/admin",
      gerente: "/gerente",
      bodeguero: "/bodeguero",
    }
    const destination = dashboards[role] || "/login"
    console.log("[v0] Redirecting to:", destination)
    navigate(destination)
  }

  return <AuthContext.Provider value={{ user, loading, login, logout, checkAuth }}>{children}</AuthContext.Provider>
}
