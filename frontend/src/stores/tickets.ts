import { defineStore } from 'pinia'
import type { Ticket } from '@/types'
import TicketService from '@/services/ticket.service'

interface TicketState {
  tickets: Ticket[]
  loading: boolean
  error: string | null
}

export const useTicketStore = defineStore('tickets', {
  state: (): TicketState => ({
    tickets: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchTickets() {
      this.loading = true
      this.error = null
      try {
        this.tickets = await TicketService.fetchTickets()
      } catch (error) {
        this.error = 'Failed to fetch tickets'
        throw error
      } finally {
        this.loading = false
      }
    },

    async createTicket(ticket: Partial<Ticket>) {
      try {
        const newTicket = await TicketService.createTicket(ticket)
        this.tickets.push(newTicket)
        return newTicket
      } catch (error) {
        throw new Error('Failed to create ticket')
      }
    },

    async updateTicket(id: number, ticket: Partial<Ticket>) {
      try {
        const updatedTicket = await TicketService.updateTicket(id, ticket)
        const index = this.tickets.findIndex((t) => t.id === id)
        if (index !== -1) {
          this.tickets[index] = updatedTicket
        }
        return updatedTicket
      } catch (error) {
        throw new Error('Failed to update ticket')
      }
    },

    async deleteTicket(id: number) {
      try {
        await TicketService.deleteTicket(id)
        this.tickets = this.tickets.filter((t) => t.id !== id)
      } catch (error) {
        throw new Error('Failed to delete ticket')
      }
    },
  },
})
