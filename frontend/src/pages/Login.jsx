"use client"

import { useState, useEffect } from "react"
import { useAuth } from "../context/AuthContext"
import { useNavigate } from "react-router-dom"

const Login = () => {
  const [username, setUsername] = useState("")
  const [password, setPassword] = useState("")
  const [showPassword, setShowPassword] = useState(false)
  const [error, setError] = useState("")
  const [loading, setLoading] = useState(false)
  const [apiStatus, setApiStatus] = useState({ checking: true, online: false, message: "" })
  const { login, user } = useAuth()
  const navigate = useNavigate()

  useEffect(() => {
    if (user) {
      const dashboards = {
        administrador: "/admin",
        gerente: "/gerente",
        bodeguero: "/bodeguero",
      }
      navigate(dashboards[user.role] || "/login")
    }
  }, [user, navigate])

  useEffect(() => {
    const checkAPI = async () => {
      try {
        const response = await fetch(
          `${import.meta.env.VITE_API_BASE_URL || "http://localhost/mat-manager/api"}/test.php`,
        )
        if (response.ok) {
          const data = await response.json()
          setApiStatus({ checking: false, online: true, message: "API conectada correctamente" })
        } else {
          setApiStatus({ checking: false, online: false, message: "API no responde correctamente" })
        }
      } catch (err) {
        setApiStatus({
          checking: false,
          online: false,
          message: "No se puede conectar con el backend. Verifica que XAMPP esté corriendo.",
        })
      }
    }
    checkAPI()
  }, [])

  const handleSubmit = async (e) => {
    e.preventDefault()
    setError("")
    setLoading(true)

    try {
      await login(username, password)
    } catch (err) {
      setError(err.message || "Credenciales incorrectas")
    } finally {
      setLoading(false)
    }
  }

  return (
    <div className="bg-gray-50 flex justify-center items-center min-h-screen px-4">
      <div className="w-full max-w-6xl flex flex-col lg:flex-row bg-white rounded-2xl shadow-2xl overflow-hidden">
        {/* Left: Image */}
        <div className="w-full lg:w-1/2 bg-primary flex items-center justify-center p-12">
          <img src="/images/logo.png" alt="MAT-MANAGER Logo" className="w-full max-w-md object-contain" />
        </div>

        {/* Right: Login Form */}
        <div className="w-full lg:w-1/2 p-8 md:p-16 flex flex-col justify-center">
          <div className="mb-6">
            {apiStatus.checking ? (
              <div className="flex items-center gap-2 text-gray-600 text-sm">
                <div className="w-2 h-2 bg-gray-400 rounded-full animate-pulse"></div>
                <span>Verificando conexión con el servidor...</span>
              </div>
            ) : apiStatus.online ? (
              <div className="flex items-center gap-2 text-green-600 text-sm">
                <div className="w-2 h-2 bg-green-500 rounded-full"></div>
                <span>{apiStatus.message}</span>
              </div>
            ) : (
              <div className="p-3 bg-red-50 border border-red-200 rounded-lg">
                <div className="flex items-center gap-2 text-red-700 text-sm font-semibold mb-2">
                  <div className="w-2 h-2 bg-red-500 rounded-full"></div>
                  <span>Error de conexión</span>
                </div>
                <p className="text-red-600 text-xs">{apiStatus.message}</p>
                <p className="text-red-600 text-xs mt-1">
                  Verifica: <code className="bg-red-100 px-1 rounded">http://localhost/mat-manager/api/test.php</code>
                </p>
              </div>
            )}
          </div>

          <form onSubmit={handleSubmit} className="space-y-6">
            <h1 className="text-4xl font-bold mb-8 text-gray-900">Login</h1>

            {error && <div className="p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">{error}</div>}

            <div>
              <label htmlFor="username" className="block text-gray-700 font-semibold mb-2">
                Usuario
              </label>
              <input
                id="username"
                type="text"
                value={username}
                onChange={(e) => setUsername(e.target.value)}
                className="input-field"
                placeholder="Usuario"
                required
                autoComplete="off"
              />
            </div>

            <div>
              <label htmlFor="password" className="block text-gray-700 font-semibold mb-2">
                Contraseña
              </label>
              <div className="relative">
                <input
                  id="password"
                  type={showPassword ? "text" : "password"}
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="input-field pr-12"
                  placeholder="Contraseña"
                  required
                  autoComplete="off"
                />
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute inset-y-0 right-0 pr-3 flex items-center text-secondary hover:text-yellow-600"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    className="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    {showPassword ? (
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      />
                    ) : (
                      <path
                        strokeLinecap="round"
                        strokeLinejoin="round"
                        strokeWidth={2}
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      />
                    )}
                  </svg>
                </button>
              </div>
            </div>

            <div>
              <a href="#" className="text-secondary hover:text-yellow-600 font-semibold text-sm">
                ¿Olvidó su contraseña?
              </a>
            </div>

            <button
              type="submit"
              disabled={loading || !apiStatus.online}
              className="btn-primary w-full disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {loading ? "Iniciando sesión..." : "Iniciar sesión"}
            </button>
          </form>
        </div>
      </div>
    </div>
  )
}

export default Login
