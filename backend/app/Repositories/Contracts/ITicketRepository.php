<?php
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Ticket;

interface ITicketRepository
{
    public function create(array $data): Ticket;
    public function getAll(array $filters): Collection;
    public function update(string $id, array $data): bool;
    public function delete(string $id): bool;
    public function find(string $id): ?Ticket;
}
