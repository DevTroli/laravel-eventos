<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se usuário está logado E é admin
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(403, 'Acesso restrito a administradores.');
        }

        return $next($request);
    }
}
