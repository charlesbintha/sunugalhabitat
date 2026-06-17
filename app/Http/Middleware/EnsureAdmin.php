<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (! $request->user() || ! $request->user()->is_admin || ! $request->user()->is_active) {
            abort(403);
        }

        return $next($request);
    }
}
