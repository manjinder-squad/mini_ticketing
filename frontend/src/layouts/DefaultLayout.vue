<template>
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Navbar -->
    <nav class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-10">
      <div class="container mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <!-- Logo -->
          <router-link to="/" class="text-2xl font-semibold text-gray-800 dark:text-white">
            Ticketing System
          </router-link>

          <!-- Right Side -->
          <div v-if="authStore.isAuthenticated" class="flex items-center gap-4">
            <!-- User Name -->
            <span class="text-sm font-medium text-gray-800 dark:text-white">
              Hello, {{ authStore.user?.name }}
            </span>

            <!-- Logout Button -->
            <button
              @click="authStore.logout"
              class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:bg-red-500 dark:hover:bg-red-600"
            >
              Logout
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="mx-auto py-8 px-6 justify-center">
      <Toast />

      <router-view />
    </main>
  </div>
</template>

<script setup lang="ts">
import { useAuthStore } from '@/stores/auth'
import Toast from '@/components/ui/Toast.vue'

const authStore = useAuthStore()
</script>
