// API configuration and helper functions
const API_BASE_URL = "/api"

class API {
  static async request(endpoint, options = {}) {
    const defaultOptions = {
      headers: {
        "Content-Type": "application/json",
      },
      credentials: "include", // Include cookies for session
    }

    const config = { ...defaultOptions, ...options }

    try {
      const response = await fetch(`${API_BASE_URL}${endpoint}`, config)

      const contentType = response.headers.get("content-type")
      if (!contentType || !contentType.includes("application/json")) {
        throw new Error("La respuesta del servidor no es JSON. Verifica que PHP esté funcionando correctamente.")
      }

      const data = await response.json()

      if (!response.ok) {
        throw new Error(data.message || "Error en la solicitud")
      }

      return data
    } catch (error) {
      console.error("[v0] API Error:", error)
      throw error
    }
  }

  // Authentication
  static async login(username, password) {
    return this.request("/auth/login.php", {
      method: "POST",
      body: JSON.stringify({ username, password }),
    })
  }

  static async logout() {
    return this.request("/auth/logout.php", {
      method: "POST",
    })
  }

  static async checkAuth() {
    return this.request("/auth/check.php")
  }

  // Materials
  static async getMaterials() {
    return this.request("/materials/list.php")
  }

  static async getMaterial(idMaterial) {
    return this.request(`/materials/get.php?idMaterial=${idMaterial}`)
  }

  static async createMaterial(materialData) {
    return this.request("/materials/create.php", {
      method: "POST",
      body: JSON.stringify(materialData),
    })
  }

  static async updateMaterial(materialData) {
    return this.request("/materials/update.php", {
      method: "PUT",
      body: JSON.stringify(materialData),
    })
  }

  static async deleteMaterial(idMaterial) {
    return this.request("/materials/delete.php", {
      method: "DELETE",
      body: JSON.stringify({ idMaterial }),
    })
  }

  // Users
  static async getUsers() {
    return this.request("/users/list.php")
  }

  static async createUser(userData) {
    return this.request("/users/create.php", {
      method: "POST",
      body: JSON.stringify(userData),
    })
  }

  static async updateUser(userData) {
    return this.request("/users/update.php", {
      method: "PUT",
      body: JSON.stringify(userData),
    })
  }

  static async deleteUser(idEmployee) {
    return this.request("/users/delete.php", {
      method: "DELETE",
      body: JSON.stringify({ idEmployee }),
    })
  }

  // Providers
  static async getProviders() {
    return this.request("/providers/list.php")
  }

  // Orders
  static async getOrders() {
    return this.request("/orders/list.php")
  }
}

// Export for use in other files
window.API = API
