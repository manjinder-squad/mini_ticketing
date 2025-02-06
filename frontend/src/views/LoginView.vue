<template>
  <div class="h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900 px-6">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
      <!-- Title -->
      <h2 class="text-center text-2xl font-bold text-gray-900 dark:text-white">
        Sign in to your account
      </h2>

      <!-- Form -->
      <form class="mt-6 space-y-4" @submit.prevent="handleLogin">
        <!-- Email Input -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300"
            >Email</label
          >
          <input
            id="email"
            v-model="email"
            type="email"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Enter your email"
          />
        </div>

        <!-- Password Input -->
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300"
            >Password</label
          >
          <input
            id="password"
            v-model="password"
            type="password"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            placeholder="Enter your password"
          />
        </div>

        <!-- Error Message -->
        <p v-if="errorMessage" class="text-red-500 text-sm text-center">{{ errorMessage }}</p>

        <!-- Submit Button -->
        <div class="mb-4">
          <button
            type="submit"
            :disabled="loading"
            class="w-full flex justify-center items-center px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium rounded-md shadow-md transition-all duration-150 ease-in-out disabled:opacity-50"
          >
            <span v-if="loading" class="animate-spin mr-2">🔄</span>
            {{ loading ? 'Signing in...' : 'Sign in' }}
          </button>
        </div>
      </form>

      <!-- Register Link -->
      <div class="mt-4 text-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
          Don't have an account?
          <router-link
            to="/register"
            class="font-medium text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400"
          >
            Register here
          </router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useToast } from '@/composables/useToast'

const authStore = useAuthStore()
const { addToast } = useToast()

const email = ref('')
const password = ref('')
const loading = ref(false)
const errorMessage = ref('')

const handleLogin = async () => {
  errorMessage.value = ''
  loading.value = true

  try {
    await authStore.login({ email: email.value, password: password.value })
  } catch (error) {
    errorMessage.value = 'Invalid credentials. Please try again.'
    addToast(errorMessage.value, 'error')
  } finally {
    loading.value = false
  }
}
</script>
