<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $forbidden = true;
        foreach($roles as $role){
            if ($request->user()->hasAuthLevel($role)) {
                $forbidden = false;
                break;
            }
        }
        if($forbidden){
            return redirect()->back()->with('error_auth', 'Non autorizzato')->with('alert_text', "Non sei autorizzato ad accedere al contenuto selezionato! Contatta l'amministratore del sistema per chiarimenti");
        }
        return $next($request);
    }
}
