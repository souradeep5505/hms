<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

class chkDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // print_r(config()['app']['url']);
        // die;
        $domain=request()->getHost();
        $count=DB::table('organizations')->where('domain',$domain)->count();
        if($count>=1){
            return $next($request);
        }else{
            return redirect(config()['app']['url']);
        }

    }
}
