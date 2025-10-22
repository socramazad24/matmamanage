export interface User {
  idEmployee: string;
  firstName?: string;
  lastName?: string;
  username: string;
  email?: string;
  phone?: number;
  role: 'administrador' | 'gerente' | 'bodeguero';
  created_at?: string;
  date_reg?: string;
}

export interface Material {
  idMaterial: string;
  MaterialName: string;
  Description: string;
  costoUnitario: number;
  cantidadMaterial: number;
  idProveedor: string;
  idPedido: string;
  date_reg: string;
}

export interface Order {
  idPedido: string;
  idProveedor: string;
  MaterialName: string;
  Description: string;
  cantidadMaterial: number;
  costoUnitario: number;
  Estado: string;
  fecha_reg: string;
  created_at?: string;
}

export interface Provider {
  idProveedor: string;
  nameProveedor: string;
  materiales: string;
  telefono: number;
  correo: string;
  direccion: string;
  date_reg: string;
  created_at?: string;
}

export interface AuthResponse {
  success: boolean;
  message: string;
  data?: {
    username: string;
    role: string;
    idEmployee: string;
  };
}

export interface ApiResponse<T> {
  success: boolean;
  message?: string;
  data?: T;
}
