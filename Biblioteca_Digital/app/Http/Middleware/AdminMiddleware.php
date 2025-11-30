<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Si NO está logueado, mandarlo al login de admin
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // 2. Si está logueado pero NO es admin
        if (Auth::user()->rol !== 'admin') {
            // Lo expulsamos al inicio de usuario normal
            return redirect('/inicio')->withErrors(['acceso' => 'Acceso no autorizado.']);
        }

        // 3. Si es admin, ¡Adelante!
        return $next($request);
    }
}