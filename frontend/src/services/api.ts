const API_BASE_URL = '/api';

export class ApiService {
  private static async request<T>(
    endpoint: string,
    options: RequestInit = {}
  ): Promise<T> {
    const response = await fetch(`${API_BASE_URL}${endpoint}`, {
      ...options,
      credentials: 'include',
      headers: {
        'Content-Type': 'application/json',
        ...options.headers,
      },
    });

    const data = await response.json();

    if (!response.ok) {
      throw new Error(data.message || 'Error en la petición');
    }

    return data;
  }

  static async login(username: string, password: string) {
    return this.request('/auth/login.php', {
      method: 'POST',
      body: JSON.stringify({ username, password }),
    });
  }

  static async logout() {
    return this.request('/auth/logout.php', {
      method: 'POST',
    });
  }

  static async checkAuth() {
    return this.request('/auth/check.php');
  }

  static async getMaterials() {
    return this.request('/materials/list.php');
  }

  static async createMaterial(material: any) {
    return this.request('/materials/create.php', {
      method: 'POST',
      body: JSON.stringify(material),
    });
  }

  static async updateMaterial(id: string, material: any) {
    return this.request('/materials/update.php', {
      method: 'POST',
      body: JSON.stringify({ idMaterial: id, ...material }),
    });
  }

  static async deleteMaterial(id: string) {
    return this.request('/materials/delete.php', {
      method: 'POST',
      body: JSON.stringify({ idMaterial: id }),
    });
  }

  static async getOrders() {
    return this.request('/orders/list.php');
  }

  static async createOrder(order: any) {
    return this.request('/orders/create.php', {
      method: 'POST',
      body: JSON.stringify(order),
    });
  }

  static async getProviders() {
    return this.request('/providers/list.php');
  }

  static async createProvider(provider: any) {
    return this.request('/providers/create.php', {
      method: 'POST',
      body: JSON.stringify(provider),
    });
  }

  static async getUsers() {
    return this.request('/users/list.php');
  }

  static async createUser(user: any) {
    return this.request('/users/create.php', {
      method: 'POST',
      body: JSON.stringify(user),
    });
  }

  static async updateUser(id: string, user: any) {
    return this.request('/users/update.php', {
      method: 'POST',
      body: JSON.stringify({ idEmployee: id, ...user }),
    });
  }

  static async deleteUser(id: string) {
    return this.request('/users/delete.php', {
      method: 'POST',
      body: JSON.stringify({ idEmployee: id }),
    });
  }
}
