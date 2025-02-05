<template>
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
    <h2 class="text-xl font-semibold text-gray-900 mb-4">
      {{ isEdit ? 'Edit Ticket' : 'Create Ticket' }}
    </h2>

    <form @submit.prevent="handleSubmit" class="space-y-4">
      <!-- Title Field -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input
          v-model="form.title"
          type="text"
          placeholder="Enter ticket title"
          class="w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300"
          required
        />
      </div>

      <!-- Description Field -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea
          v-model="form.description"
          rows="3"
          placeholder="Enter ticket description"
          class="w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300"
          required
        ></textarea>
      </div>

      <!-- Status Dropdown -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select
          v-model="form.status"
          class="w-full px-3 py-2 border rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 bg-white"
        >
          <option value="open">Open</option>
          <option value="in_progress">In Progress</option>
          <option value="closed">Closed</option>
        </select>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end space-x-3">
        <button
          type="button"
          @click="$emit('cancel')"
          class="px-4 py-2 rounded-lg text-gray-700 bg-gray-100 border border-gray-300 hover:bg-gray-200"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="px-4 py-2 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700"
        >
          {{ isEdit ? 'Update Ticket' : 'Create Ticket' }}
        </button>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { ref, watch, defineProps, defineEmits } from 'vue'
import type { Ticket } from '@/types'

const props = defineProps<{
  ticket?: Ticket
  isEdit?: boolean
}>()

const emit = defineEmits<{
  (e: 'submit', ticket: Partial<Ticket>): void
  (e: 'cancel'): void
}>()

const form = ref({
  title: '',
  description: '',
  status: 'open',
})

// Watch for changes in the ticket prop and update form values
watch(
  () => props.ticket,
  (newTicket) => {
    if (newTicket) {
      form.value = {
        title: newTicket.title,
        description: newTicket.description,
        status: newTicket.status,
      }
    } else {
      form.value = { title: '', description: '', status: 'open' }
    }
  },
  { immediate: true },
)

const handleSubmit = () => {
  emit('submit', form.value)
}
</script>
