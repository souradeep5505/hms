<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

date_default_timezone_set('Asia/Kolkata');
    Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!!!!";
 });



 Route::middleware(['chkDomain'])->group(function () {
    Route::get('/user-login', [UserController::class,'login_user']);
    Route::post('/userlogin', [UserController::class,'loginUser']);

    Route::middleware(['chkUserLogin'])->group(function () {

        $array=DB::table('permissions')->get();

        // foreach($datas as $data){
        //     print_r($data->permis_name);
        // }

        foreach($array as $value) {
        print_r($value->permis_name) ;
        }

        $length = count($array);
        for ($i = 0; $i < $length; $i++) {
        print $value->permis_name[$i];
        }

        // Admin
        Route::group(['prefix'=>'admin','as'=>'admin.'], function () {

        Route::get('/dashboard', [UserController::class,'dashboard'])->name('dashboard');

        Route::get('/logout', [UserController::class,'logout'])->name('logout');

        });
        // Account
        Route::group(['prefix'=>'account','as'=>'account.'], function () {
            Route::get('/dashboard', [UserController::class,'dashboard'])->name('dashboard');
            Route::get('/logout', [UserController::class,'logout'])->name('logout');

            });

    });

    });


    // SUPER ADMIN



Route::post('/hello', function (Request $request) {
    return $request->t1;
});

Route::get('/patient-registration', function (Request $request) {
    return view('admin.pages.from.patient-registration', compact('request'));
});
Route::get('/table', function (Request $request) {
    return view('admin.pages.from.table', compact('request'));
});

Route::get('/doctor-timetable', function (Request $request) {
    return view('admin.pages.from.doctor_timetable', compact('request'));
});
Route::get('/book-doctor', function (Request $request) {
    return view('admin.pages.from.book_doctor', compact('request'));
});


Route::get('/', function (Request $request) {
    // return $request->getHttpHost();
    // die;
    return view('welcome');
});

Route::get('/login', function (Request $request) {
    return view('admin.pages.authentication.login', compact('request'));
});


Route::get('/logout', [AdminController::class,'logout']);
Route::get('/change-password', [AdminController::class,'change_password']);
Route::post('/changePassword/{id}', [AdminController::class,'changePassword']);

Route::post('/adminLogin', [AdminController::class,'adminLogin']);
Route::middleware(['chkSupAdminLogin'])->group(function () {

Route::get('/dashboard', [AdminController::class,'dashboard']);

/////////////////////////// Start Roll //////////////////////////////////////////////////////
Route::get('/rolls',[AdminController::class,'rolls']);
Route::post('/add-roll',[AdminController::class,'addRoll']);
Route::post('/getRoll', [AdminController::class,'getRoll']);
Route::post('/updateRoll', [AdminController::class,'updateRoll']);
Route::post('/roll-status/{id}', [AdminController::class,'rollStatus']);
Route::get('/create-form/{id}', [AdminController::class,'createForm']);
Route::get('/ajax-create-form', [AdminController::class,'ajaxCreateForm']);
Route::post('/createform/{id}', [AdminController::class,'create_form']);
/////////////////////////// End Roll ////////////////////////////////////////////////////////

/////////////////////////// Start Subscriptions /////////////////////////////////////////////
Route::get('/subscriptions', [AdminController::class,'subscriptions']);
Route::post('/add-subscriptions',[AdminController::class,'addSubscriptions']);
Route::post('/getSubscriptions',[AdminController::class,'getSubscriptions']);
Route::post('/updateSubscriptions',[AdminController::class,'updateSubscriptions']);
Route::post('/subscriptions-status/{id}', [AdminController::class,'subscriptionsStatus']);
/////////////////////////// End Subscriptions ///////////////////////////////////////////////

/////////////////////////// Start Permissions ////////////////////////////////////////////////
Route::get('/permissions', [AdminController::class,'permissions']);
Route::post('/add-permission',[AdminController::class,'addPermission']);
Route::post('/getPermission', [AdminController::class,'getPermission']);
Route::post('/updatePermission', [AdminController::class,'updatePermission']);
Route::post('/permission-status/{id}', [AdminController::class,'permissionStatus']);
/////////////////////////// End Permissions ///////////////////////////////////////////////////

/////////////////////////// Start Subscription Roll //////////////////////////////////////////
Route::get('/list-subscription-permissions/{id}', [AdminController::class,'subscriptionPermissions']);
Route::get('/add-subscription-roll',[AdminController::class,'add_subscription_roll']);
Route::get('/edit-subscription-roll/{id}',[AdminController::class,'edit_subscription_roll']);
Route::post('/editsubscriptionroll/{id}',[AdminController::class,'editSubscriptionRoll']);
Route::post('/addsubscriptionroll',[AdminController::class,'addSubscriptionRoll']);
Route::post('/sub-roll-status/{id}', [AdminController::class,'subRollStatus']);
/////////////////////////// End Subscription Roll //////////////////////////////////////////////

/////////////////////////// Start Organization ////////////////////////////////////////////////
Route::get('/list-organization', [AdminController::class,'listOrganization']);
Route::get('/add-organization', [AdminController::class,'addOrganization']);
Route::post('/addorganization', [AdminController::class,'add_Organization']);
Route::get('/edit-organization/{id}', [AdminController::class,'editOrganization']);
Route::post('/editorganization/{id}', [AdminController::class,'edit_Organization']);
Route::post('/add-org-subscription', [AdminController::class,'addOrganizationSub']);
Route::post('/org-status/{id}', [AdminController::class,'orgStatus']);
/////////////////////////// End Organization ///////////////////////////////////////////////////

Route::get('/all-doctor', [AdminController::class,'allDoctor']);
Route::get('/all-doctor2', [AdminController::class,'allDoctor2']);
Route::get('/add-doctor', [AdminController::class,'addDoctor']);
Route::get('/ajax-add-doctor', [AdminController::class,'ajaxAddDoctor']);
Route::get('/edit-doctor', [AdminController::class,'doctorProfile']);
Route::get('/doctor-time-edit', [AdminController::class,'timeEdit']);

/////////////////////////// Start Users ///////////////////////////////////////////////////
Route::get('/ajax-add-user', [AdminController::class,'ajaxAddUser']);
Route::get('/user/{id}', [AdminController::class,'addUser']);
Route::post('/adduser', [AdminController::class,'add_User']);
// Route::get('/edit-users/{id}', [AdminController::class,'editUsers']);
// Route::post('/editusers/{id}', [AdminController::class,'edit_users']);
Route::post('/usersstatus/{id}', [AdminController::class,'usersStatus']);
Route::post('/userdelete/{id}', [AdminController::class,'userDelete']);

/////////////////////////// End Users ///////////////////////////////////////////////////

});

