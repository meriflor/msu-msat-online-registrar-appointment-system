<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class SubAdminCashier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session()->has('loginId')) {
            $user = User::where('id','=',Session::get('loginId'))->first();
            if($user->role == 3) {
                return $next($request);
            } else {
                return redirect('/dashboard')->with('fail','You are not authorized to access this page');
            }
        } else {
            return redirect('/');
        }
    }
}
