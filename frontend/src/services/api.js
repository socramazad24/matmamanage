const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "http://localhost/mat-manager/api"

console.log("[v0] API Base URL configured:", API_BASE_URL)

class API {
  async request(endpoint, options = {}) {
    const defaultOptions = {
      headers: {
        "Content-Type": "application/json",
      },
      credentials: "include",
    }

    const config = { ...defaultOptions, ...options }
    const url = `${API_BASE_URL}${endpoint}`

    console.log("[v0] Making API request to:", url)

    try {
      const response = await fetch(url, config)

      console.log("[v0] Response status:", response.status)
      console.log("[v0] Response headers:", response.headers.get("content-type"))

      const contentType = response.headers.get("content-type")
      if (!contentType || !contentType.includes("application/json")) {
        const text = await response.text()
        console.error("[v0] Non-JSON response received:", text.substring(0, 200))
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
  async login(username, password) {
    return this.request("/auth/login.php", {
      method: "POST",
      body: JSON.stringify({ username, password }),
    })
  }

  async logout() {
    return this.request("/auth/logout.php", {
      method: "POST",
    })
  }

  async checkAuth() {
    return this.request("/auth/check.php")
  }

  // Materials
  async getMaterials() {
    return this.request("/materials/list.php")
  }

  async getMaterial(idMaterial) {
    return this.request(`/materials/get.php?idMaterial=${idMaterial}`)
  }

  async createMaterial(materialData) {
    return this.request("/materials/create.php", {
      method: "POST",
      body: JSON.stringify(materialData),
    })
  }

  async updateMaterial(materialData) {
    return this.request("/materials/update.php", {
      method: "PUT",
      body: JSON.stringify(materialData),
    })
  }

  async deleteMaterial(idMaterial) {
    return this.request("/materials/delete.php", {
      method: "DELETE",
      body: JSON.stringify({ idMaterial }),
    })
  }

  // Users
  async getUsers() {
    return this.request("/users/list.php")
  }

  async createUser(userData) {
    return this.request("/users/create.php", {
      method: "POST",
      body: JSON.stringify(userData),
    })
  }

  async updateUser(userData) {
    return this.request("/users/update.php", {
      method: "PUT",
      body: JSON.stringify(userData),
    })
  }

  async deleteUser(idEmployee) {
    return this.request("/users/delete.php", {
      method: "DELETE",
      body: JSON.stringify({ idEmployee }),
    })
  }

  // Providers
  async getProviders() {
    return this.request("/providers/list.php")
  }

  async createProvider(providerData) {
    return this.request("/providers/create.php", {
      method: "POST",
      body: JSON.stringify(providerData),
    })
  }

  // Orders
  async getOrders() {
    return this.request("/orders/list.php")
  }

  async createOrder(orderData) {
    return this.request("/orders/create.php", {
      method: "POST",
      body: JSON.stringify(orderData),
    })
  }
}

export default new API()
