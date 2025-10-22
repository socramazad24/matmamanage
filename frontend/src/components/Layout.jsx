"use client"

import { useAuth } from "../context/AuthContext"

const Layout = ({ children, title }) => {
  const { user, logout } = useAuth()

  return (
    <div className="min-h-screen flex flex-col">
      <header className="bg-primary text-white shadow-lg">
        <div className="container mx-auto px-4 py-4 flex justify-between items-center">
          <h1 className="text-2xl font-bold">{title}</h1>
          <div className="flex items-center gap-4">
            <span className="text-sm font-medium">{user?.username}</span>
            <button
              onClick={logout}
              className="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition-colors font-medium"
            >
              Cerrar Sesión
            </button>
          </div>
        </div>
      </header>

      <main className="flex-1">{children}</main>

      <footer className="bg-primary text-white text-center py-4 mt-8">
        <p>&copy; 2023 MAT-MANAGER</p>
      </footer>
    </div>
  )
}

export default Layout
