<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Profile;

class IsMineOrAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // CHECK IF THE MEETING BELONGS TO THE USER OR IF THE USER IS AUTHORIZED BY ITS ROLE
        if($request->route('user')){
            $user = $request->route('user');
            if (($request->user()->id == $user->id)) {
                return $next($request);
            }
            else{
                if($this->checkAuthority($request, $roles)){
                    return $next($request);
                }
            }
        }
        // CHECK IF THE MEETING BELONGS TO THE USER OR IF THE USER IS AUTHORIZED BY ITS ROLE
        if($request->route('meeting')){
            $meeting = $request->route('meeting');
            if (($request->user()->id == $meeting->user->id)) {
                return $next($request);
            }
            else{
                if($this->checkAuthority($request, $roles)){
                    return $next($request);
                }
            }
        }
        // CHECK IF THE PROFILE BELONGS TO THE USER OR IF THE USER IS AUTHORIZED BY ITS ROLE
        if($request->route('profile')){
            $prof = $request->route('profile');
            $profile = $prof;
            if(is_string($prof)){
                $profile = Profile::findOrFail($prof);
            }
            if (($request->user()->id == $profile->user_id)) {
                return $next($request);
            }
            else{
                // foreach($roles as $role){
                //     if ($request->user()->hasAuthLevel($role)) {
                //         return $next($request);
                //     }
                // }
                if($this->checkAuthority($request, $roles)){
                    return $next($request);
                }
            }
        }
        return redirect()->back()->with('error_auth', 'Non autorizzato')->with('alert_text', "Non sei autorizzato ad accedere al contenuto selezionato! Contatta l'amministratore del sistema per chiarimenti");
    }


    public function checkAuthority($request, $roles)
    {
        foreach($roles as $role){
            if ($request->user()->hasAuthLevel($role)) {
                return true;
            }
        }
        return false;

    }

}
