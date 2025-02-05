<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EnsureTokenAndJsonContentType
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Accept') !== 'application/json') {
            return response()->json([
                'success' => true,
                'data'    => [],
                'message' => "Content-Type or Accept must be application/json",
            ], 415);
        }
        return $next($request);
    }
}
