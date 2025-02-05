<?php
namespace App\Services;

use App\Repositories\Contracts\ITicketRepository;
use App\Models\Ticket;
use \Illuminate\Database\Eloquent\Collection;

class TicketService
{
    protected ITicketRepository $ticketRepository;

    public function __construct(ITicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function createTicket(array $data): Ticket
    {
        return $this->ticketRepository->create($data);
    }

    public function getAllTickets(array $filters): Collection
    {
        return $this->ticketRepository->getAll($filters);
    }

    public function updateTicket(string $id, array $data): bool
    {
        return $this->ticketRepository->update($id, $data);
    }

    public function deleteTicket(string $id): bool
    {
        return $this->ticketRepository->delete($id);
    }

    public function findTicket(string $id): ?Ticket
    {
        return $this->ticketRepository->find($id);
    }
}
