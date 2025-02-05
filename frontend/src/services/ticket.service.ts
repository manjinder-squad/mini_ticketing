import axios from '@/api/axios'
import type { Ticket } from '@/types'

const TicketService = {
    async fetchTickets(): Promise<Ticket[]> {
        try {
            const response = await axios.get('/tickets')
            return response.data.data
        } catch (error) {
            throw new Error('Failed to fetch tickets')
        }
    },

    async createTicket(ticket: Partial<Ticket>): Promise<Ticket> {
        try {
            const response = await axios.post('/tickets', ticket)
            return response.data.data
        } catch (error) {
            throw new Error('Failed to create ticket')
        }
    },

    async updateTicket(id: number, ticket: Partial<Ticket>): Promise<Ticket> {
        try {
            const response = await axios.put(`/tickets/${id}`, ticket)
            return response.data.data
        } catch (error) {
            throw new Error('Failed to update ticket')
        }
    },

    async deleteTicket(id: number): Promise<void> {
        try {
            await axios.delete(`/tickets/${id}`)
        } catch (error) {
            throw new Error('Failed to delete ticket')
        }
    },
}

export default TicketService
