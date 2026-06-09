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
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
