class Auth {
  static async checkAuthentication() {
    try {
      const response = await fetch("/api/auth/check.php", {
        method: "GET",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
        },
      })

      const data = await response.json()

      if (data.success && data.authenticated) {
        return data.data
      }
      return null
    } catch (error) {
      console.error("[v0] Error checking authentication:", error)
      return null
    }
  }

  static async redirectIfNotAuthenticated() {
    const user = await this.checkAuthentication()
    if (!user) {
      window.location.href = "/frontend/login.html"
      return null
    }
    return user
  }

  static async redirectToDashboard(role) {
    const dashboards = {
      administrador: "/frontend/admin/index.html",
      gerente: "/frontend/gerente/index.html",
      bodeguero: "/frontend/bodeguero/index.html",
    }

    const dashboard = dashboards[role] || "/frontend/login.html"
    window.location.href = dashboard
  }

  static async logout() {
    try {
      const response = await fetch("/api/auth/logout.php", {
        method: "POST",
        credentials: "include",
        headers: {
          "Content-Type": "application/json",
        },
      })

      const data = await response.json()

      if (data.success) {
        this.clearUserInfo()
        window.location.href = "/frontend/login.html"
      } else {
        throw new Error(data.message)
      }
    } catch (error) {
      console.error("[v0] Error al cerrar sesión:", error)
      alert("Error al cerrar sesión")
    }
  }

  static setUserInfo(user) {
    if (user) {
      localStorage.setItem("user", JSON.stringify(user))
    }
  }

  static getUserInfo() {
    const userStr = localStorage.getItem("user")
    return userStr ? JSON.parse(userStr) : null
  }

  static clearUserInfo() {
    localStorage.removeItem("user")
  }
}

window.Auth = Auth
