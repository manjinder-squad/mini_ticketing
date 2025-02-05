// src/stores/AuthStore.ts
import { defineStore } from 'pinia'
import type { User, LoginCredentials, RegisterData } from '@/types'
import { AuthService } from '@/services/auth.service'
import router from '@/router'

// Defining the state type
interface AuthState {
  user: User | null
  token: string | null
  isAuthenticated: boolean
}

export const useAuthStore = defineStore('auth', {
  state: (): AuthState => ({
    user: null,
    token: localStorage.getItem('token'),
    isAuthenticated: !!localStorage.getItem('token'),
  }),

  actions: {
    // Helper function to set authentication state
    setAuthState(token: string, user: User): void {
      localStorage.setItem('token', token)
      this.token = token
      this.user = user
      this.isAuthenticated = true
    },

    // Common function for redirecting after login or registration
    redirectToTickets(): void {
      router.push('/tickets')
    },

    // Login function that uses the AuthService for API call
    async login(credentials: LoginCredentials): Promise<void> {
      try {
        const { token, user } = await AuthService.login(credentials)
        this.setAuthState(token, user)
        this.redirectToTickets()
      } catch (error) {
        throw new Error('Login failed')
      }
    },

    // Register function that uses the AuthService for API call
    async register(data: RegisterData): Promise<void> {
      try {
        const { token, user } = await AuthService.register(data)
        this.setAuthState(token, user)
        this.redirectToTickets()
      } catch (error) {
        throw new Error('Signup failed')
      }
    },

    // Logout function that uses the AuthService for API call
    async logout(): Promise<void> {
      try {
        await AuthService.logout()
        localStorage.removeItem('token')
        this.token = null
        this.user = null
        this.isAuthenticated = false
        router.push('/')
      } catch (error) {
        throw new Error(error)
      }
    },
  },
})
