<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\CachedWordInflector;
use Doctrine\Inflector\RulesetInflector;
use Doctrine\Inflector\Rules\English;

use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\NoopWordInflector;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Validation\Rules\Password;
use DB;
use Session;
use Helper;
use Validator;
use Redirect;
use Route;
use App\Models\SubscriptionRoll;
use App\Models\Subscription;
use App\Models\Permission;
use App\Models\Roll;
use App\Models\Organization;
use App\Models\OrgSubscription;
use App\Models\User;
use App\Models\SuperAdmin;
class UserController extends Controller
{

    function login_user(Request $request){

        return view('admin.pages.authentication.user-login');
    }

    public function loginUser(Request $request)
    {
        $domain=request()->getHost();
        $data=DB::table('organizations')->where('status','1')->where('domain',$domain)->first();
        $result=DB::table('users')->where('org_id',$data->id)
        ->whereRaw("md5(`user_id`)='".md5($request->user_id)."' and password='".md5($request->password)."'")->where('status','1')->where('is_delete','N')->first();
         if(!empty($result->id) && $result->id>=1){
            Session::put('user_id',$result->id);
             Session::put('user_email',$result->email);
             Session::put('user_name',$result->name);
             Session::put('roll_id',$result->roll_id);
             Session::put('org_id',$result->org_id);
             $roll=Helper::roll_state($result->roll_id);
             Session::put('roll',$roll);
             alert()->success('SuccessAlert','You have successfully logged in.');
             return redirect(Session::get('roll').'/dashboard');

         }else{
            toast('Enter Wrong Email Or Password.','error');
            return back();
             //return redirect(lcfirst(Helper::Roll($result->roll_id)).'/dashboard');
         }

    }

    public function logout(Request $request)
    {
       $request->session()->flush();
        alert()->success('success','You have successfully logged Out.');
        return redirect('/');
    }

   public function dashboard(Request $request)
    {
    //     $routes = Route::getRoutes();
    //     foreach ($routes as $route) {
    //         dump($route);
    //         echo $route->getName();
    //         echo '<br>';
    //         echo $route->getPrefix();
    //         echo '<br>';
    //     }
    //    dump($routes);
    //    die;
        return view('admin.pages.dashboard', compact('request'));
    }
}
