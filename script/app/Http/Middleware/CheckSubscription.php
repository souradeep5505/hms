<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;
use Session;
class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domain=request()->getHost();
        $data=DB::table('organizations')->where('domain',$domain)->first();
        $data_sub=DB::table('org_subscriptions')->where('org_id',$data->id)
        ->whereRaw('"'.date('Y-m-d').'" BETWEEN start_date AND end_date')
        ->orderBy('id','desc');

        if($data_sub->count()>=1){
            $sub_data=$data_sub->first();
            Session::put('subscription_id',$sub_data->subs_id);
            return $next($request);
        }else{
            alert()->error('error','Subscription plan expired.');
            return redirect('/');
        }

    }
}
