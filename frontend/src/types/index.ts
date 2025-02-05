export interface User {
  id: number
  name: string
  email: string
}

export interface Ticket {
  id: number
  title: string
  description: string
  status: 'open' | 'in_progress' | 'closed'
  created_at: string
  updated_at: string
}

export interface LoginCredentials {
  email: string
  password: string
}

export interface RegisterData {
  email: string
  password: string
  name: string
  password_confirmation: string
}

export interface ApiResponse<T> {
  data: T
  message?: string
}
