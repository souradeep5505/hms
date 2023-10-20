<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
class chkSupAdminLogin
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
        $sup_admin_id = Session::get('sup_admin_id');
        if ($sup_admin_id>=1) {
            return $next($request);
        }else{
            alert()->error('error','Please Enter Correct Login Details.');
            return redirect('/');
        }
    }
}
