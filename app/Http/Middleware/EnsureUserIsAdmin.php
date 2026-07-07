<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o user está logado e se o papel é 'admin'
        if ($request->user() && $request->user()->role !== 'admin') {
            return redirect('/dashboard'); // Ou para a home
        }

        return $next($request);
    }
}


http://127.0.0.1:8000/admin/orders
