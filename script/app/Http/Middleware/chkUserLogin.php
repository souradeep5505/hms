<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class chkUserLogin
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
        //echo $roll_id = Session::get('roll_id');
        $user_id = Session::get('user_id');
        if ($user_id>=1) {
            return $next($request);
        }else{
            alert()->error('error','Please Enter Correct Login Details.');
            return redirect('/');
        }

    }
}
