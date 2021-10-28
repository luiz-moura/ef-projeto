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
        $routeName = $request->route()->getName();
        $routeName = explode('.', $routeName)[0];

        $tipo = match ($routeName) {
            'clientes'      => 'c',
            'funcionarios'  => 'f',
            'fornecedores'  => 'u',
            default         => null,
        };

        $rota = match ($routeName) {
            'clientes'      => 'cliente',
            'funcionarios'  => 'funcionario',
            'fornecedores'  => 'fornecedor',
            default         => null,
        };

        if ($request->route($rota)->contextos()->where('tipo', $tipo)->exists()) {
            return $next($request);
        }

        abort(404);
    }
}
