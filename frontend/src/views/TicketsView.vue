<template>
  <div
      class="h-screen items-center justify-center space-y-6 max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-6"
  >
    <!-- Header -->
    <div class="flex items-center justify-between">
      <h1 class="text-2xl font-bold text-gray-900">Tickets</h1>
      <button
          @click="showCreateModal = true"
          class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md shadow-sm transition"
      >
        + Create Ticket
      </button>
    </div>

    <!-- Loading Spinner -->
    <div v-if="ticketStore.loading" class="flex justify-center py-8">
      <div
          class="h-8 w-8 border-4 border-indigo-500 border-t-transparent rounded-full animate-spin"
      ></div>
    </div>

    <!-- Error Message -->
    <div v-else-if="ticketStore.error" class="text-center py-4 text-red-600">
      {{ ticketStore.error }}
    </div>

    <!-- No Tickets Found -->
    <div v-else-if="ticketStore.tickets.length === 0" class="text-center py-4 text-gray-500">
      No tickets found. Create one to get started.
    </div>

    <!-- Ticket List -->
    <div v-else class="bg-white shadow sm:rounded-lg overflow-hidden">
      <ul class="divide-y divide-gray-200">
        <li
            v-for="ticket in ticketStore.tickets"
            :key="ticket.id"
            class="px-6 py-4 hover:bg-gray-50 transition"
        >
          <div class="flex justify-between items-center">
            <!-- Ticket Info -->
            <div class="flex-1 min-w-0">
              <h3 class="text-lg font-semibold text-gray-900">{{ ticket.title }}</h3>
              <p class="mt-1 text-sm text-gray-600">{{ ticket.description }}</p>
              <div class="mt-2 flex items-center text-xs text-gray-500">
                <span class="mr-3">📅 Created: {{ formatDate(ticket.created_at) }}</span>
                <span>⏳ Updated: {{ formatDate(ticket.updated_at) }}</span>
              </div>
            </div>

            <!-- Ticket Actions -->
            <div class="flex items-center space-x-4">
              <span
                  class="px-2 py-1 text-xs font-medium rounded-full"
                  :class="statusClass(ticket.status)"
              >
                {{ ticket.status }}
              </span>
              <button
                  @click="editTicket(ticket)"
                  class="text-indigo-600 hover:text-indigo-900 transition"
              >
                ✏️ Edit
              </button>
              <button
                  @click="deleteTicket(ticket.id)"
                  class="text-red-600 hover:text-red-900 transition"
              >
                🗑 Delete
              </button>
            </div>
          </div>
        </li>
      </ul>
    </div>

    <!-- Create/Edit Modal -->
    <div
        v-if="showCreateModal || editingTicket"
        class="fixed inset-0 z-10 flex items-center justify-center px-4"
    >
      <!-- Transparent background with subtle dimming -->
      <div class="fixed inset-0 bg-black bg-opacity-20"></div> <!-- Dark but transparent background -->
      <div class="relative bg-white shadow-lg rounded-lg w-full max-w-lg p-6">
        <TicketForm
            :ticket="editingTicket"
            :is-edit="!!editingTicket"
            @submit="handleTicketSubmit"
            @cancel="closeModal"
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import { useTicketStore } from '@/stores/tickets'
import { useToast } from '@/composables/useToast'
import TicketForm from '@/components/tickets/TicketForm.vue'
import type { Ticket } from '@/types'

const ticketStore = useTicketStore()
const { addToast } = useToast()

const showCreateModal = ref(false)
const editingTicket = ref<Ticket | null>(null)

onMounted(() => {
  ticketStore.fetchTickets()
})

const formatDate = (date: string) => new Date(date).toLocaleDateString()

const closeModal = () => {
  showCreateModal.value = false
  editingTicket.value = null
}

const editTicket = (ticket: Ticket) => {
  editingTicket.value = ticket
}

const handleTicketSubmit = async (ticketData: Partial<Ticket>) => {
  try {
    if (editingTicket.value) {
      await ticketStore.updateTicket(editingTicket.value.id, ticketData)
      addToast('✅ Ticket updated successfully!')
    } else {
      await ticketStore.createTicket(ticketData)
      addToast('✅ Ticket created successfully!')
    }
    closeModal()
  } catch (error) {
    addToast('❌ Failed to save ticket.')
  }
}

const deleteTicket = async (id: number) => {
  if (confirm('Are you sure you want to delete this ticket?')) {
    try {
      await ticketStore.deleteTicket(id)
      addToast('🗑 Ticket deleted successfully!')
    } catch (error) {
      addToast('❌ Failed to delete ticket.')
    }
  }
}

const statusClass = (status: string) => {
  return {
    'bg-green-100 text-green-800': status === 'closed',
    'bg-yellow-100 text-yellow-800': status === 'in_progress',
    'bg-blue-100 text-blue-800': status === 'open',
  }
}
</script>
