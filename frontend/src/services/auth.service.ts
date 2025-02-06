// src/services/AuthService.ts
import axios from '@/api/axios'
import type { LoginCredentials, RegisterData, User } from '@/types'

interface AuthResponse {
    token: string
    user: { id: string; name: string; email: string }  // Adjust user fields based on your type
}

const login = async (credentials: LoginCredentials): Promise<AuthResponse> => {
    const response = await axios.post<{ data: AuthResponse }>('/login', credentials)
    return response.data.data
}

const register = async (data: RegisterData): Promise<AuthResponse> => {
    const response = await axios.post<{ data: AuthResponse }>('/signup', data)
    return response.data.data
}

const getUser = async (): Promise<User> => {
  const response = await axios.get<{ data: User }>('/user')
  return response.data
}

const logout = async (): Promise<void> => {
    await axios.delete('/logout')
}

export const AuthService = {
    login,
    register,
    logout,
    getUser,
}
