import { ref } from 'vue'

interface Toast {
  message: string
  type: 'success' | 'error'
}

const toasts = ref<Toast[]>([])

export function useToast() {
  const addToast = (message: string, type: 'success' | 'error' = 'success') => {
    const toast = { message, type }
    toasts.value.push(toast)
    setTimeout(() => {
      const index = toasts.value.indexOf(toast)
      if (index > -1) {
        toasts.value.splice(index, 1)
      }
    }, 3000)
  }

  return { toasts, addToast }
}
