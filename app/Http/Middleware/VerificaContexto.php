<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificaContexto
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route()->getName();
        $route = explode('.', $route)[0];

        $tipo = match ($route) {
            'clientes'      => 'c',
            'funcionarios'  => 'f',
            'fornecedores'  => 'u',
            default         => null,
        };

        if ($request->route('cliente')->contextos()->where('tipo', $tipo)->exists()) {
            return $next($request);
        }

        abort(404);
    }
}
