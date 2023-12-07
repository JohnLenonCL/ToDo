<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class AdminAccessMiddleware
{
    public function handle($request, Closure $next)
    {
        // Verifica se o usuário está autenticado e possui o e-mail correto
        if (auth()->check() && auth()->user()->email === 'john@gmail.com') {
            return $next($request);
        }

        // Se não tiver acesso, redireciona para a home
        return redirect('/');
    }
}
