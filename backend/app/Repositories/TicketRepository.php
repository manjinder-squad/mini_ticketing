<?php
namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Contracts\ITicketRepository;
use \Illuminate\Database\Eloquent\Collection;

class TicketRepository implements ITicketRepository
{
    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function getAll(array $filters): Collection
    {
        return Ticket::where('status', $filters['status'] ?? 'open')->get();
    }

    public function update(string $id, array $data): bool
    {
        return Ticket::where('id', $id)->update($data);
    }

    public function delete(string $id): bool
    {
        return Ticket::destroy($id);
    }

    public function find(string $id): ?Ticket
    {
        return Ticket::find($id);
    }
}
