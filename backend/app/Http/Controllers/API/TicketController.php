<?php
namespace App\Http\Controllers\API;

use App\Http\Requests\TicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends BaseController
{
    protected TicketService $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function store(TicketRequest $request): JsonResponse
    {
        $ticket = $this->ticketService->createTicket($request->only(['title', 'description', 'status']));

        return $this->sendResponse(new TicketResource($ticket), 'Ticket created successfully.', 201);
    }

    public function index(Request $request): JsonResponse
    {
        $tickets = $this->ticketService->getAllTickets($request->all());
        return $this->sendResponse(TicketResource::collection($tickets), 'Tickets retrieved successfully.');
    }

    public function update($id, UpdateTicketRequest $request): JsonResponse
    {
        $ticket = $this->ticketService->findTicket($id);

        if (!$ticket) {
            return $this->sendError('Not Found', ['Ticket not found']);
        }

        $this->ticketService->updateTicket($id, $request->all());
        $ticket->refresh();

        return $this->sendResponse(new TicketResource($ticket), 'Ticket updated successfully.');
    }

    public function destroy($id): JsonResponse
    {
        $ticket = $this->ticketService->findTicket($id);

        if (!$ticket) {
            return $this->sendError('Not Found', ['Ticket not found']);
        }

        $ticketDeleted = $this->ticketService->deleteTicket($id);

        return $this->sendResponse([], 'Ticket deleted successfully.');
    }
}
