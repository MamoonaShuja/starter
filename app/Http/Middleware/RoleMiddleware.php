<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next , $role = '')
    {
        if(Auth::check()){
            $user = Auth::user();
            if($role == 'user'){
                return $next($request);
            }else{
                return redirect('index/donee');
            }
        }
        return $next($request);
    }

    public function terminate($request, $response)
    {
        
    }
}
