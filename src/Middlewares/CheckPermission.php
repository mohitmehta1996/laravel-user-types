<?php

namespace Mohit\Usertype\Middlewares;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (!$request->user()){
            return redirect('login');
        }
        $permissions = explode('|', $permission);
        $roles = explode(',',Auth::user()->type);
        $check = false;

        foreach ($permissions as $key => $value) {
            if (in_array($value, $roles)){
                $check = true;
            }
        }

        if($check){
            return $next($request);
        }else{
            return new Response(view('usertype::unauthorized')->with('role', $roles[0]));
        }
    }
}