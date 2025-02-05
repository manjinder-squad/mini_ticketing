<template>
  <div class="fixed top-4 right-4 z-50" v-if="toasts.length">
    <div
      v-for="(toast, index) in toasts"
      :key="index"
      class="mb-2 p-4 rounded-md shadow-lg text-white"
      :class="toast.type === 'error' ? 'bg-red-500' : 'bg-green-500'"
    >
      {{ toast.message }}
    </div>
  </div>
</template>

<script setup lang="ts">
import { useToast } from '@/composables/useToast'

const { toasts } = useToast()
</script>
