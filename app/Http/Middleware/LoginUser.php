<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,...$roles)
    {
        $user = Auth::user();
        foreach($roles as $role)
        {
            if($role == 'admin' && $user->role == 'admin')
            {
                return $next($request);
            }
            elseif($role == 'teacher' && $user->role == 'teacher' )
            {
                return $next($request);
            }
            elseif($role == 'student' && $user->role == 'student' )
            {
                return $next($request);
            }
        }
        return redirect()->route('login');
    }
}
