<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
        // Kontrola, zda je uživatel administrátor
        if(auth()->user() && auth()->user()->user_type == 'admin') {
            return $next($request);
        }

        // Pokud není administrátor, můžete přesměrovat nebo něco jiného
        return redirect()->route('login'); // přesměrování na přihlašovací stránku

        // Pokud nechcete dále zpracovávat požadavek, můžete vrátit odpověď zde
        // return response('Unauthorized.', 401);
    }
}