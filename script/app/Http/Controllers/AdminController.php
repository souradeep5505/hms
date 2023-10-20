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
use App\Models\SubscriptionRoll;
use App\Models\Subscription;
use App\Models\Permission;
use App\Models\Roll;
use App\Models\Organization;
use App\Models\OrgSubscription;
use App\Models\User;
use App\Models\SuperAdmin;
class AdminController extends Controller
{

    //private $adminPath = 'avqsupadmin';
    public function adminLogin(Request $request)
    {
        $result=DB::table('super_admins')->whereRaw("name='".($request->name)."' and password='".md5($request->password)."'")->first();
         if(!empty($result->id) && $result->id>=1){
            Session::put('sup_admin_id',$result->id);
            Session::put('sup_admin_name',$result->name);
            Session::put('roll','super_admin');
            toast('You have successfully logged in.','success');
            return redirect('/dashboard');
         }else{
             toast('Enter Wrong User ID Or Password.','error');
             return back();
         }
    }

    public function dashboard(Request $request)
    {
        return view('admin.pages.dashboard', compact('request'));
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
        toast('You have successfully logged Out.','success');
        //alert()->success('success','You have successfully logged Out.');
        return redirect('/login');
    }

    public function change_password()
    {
        $data =SuperAdmin::find(Session::get('sup_admin_id'));
        return view('admin.pages.authentication.change-password', compact('data'));
    }

    public function changePassword(Request $request,$id)
    {
        $table =SuperAdmin::find($id);
        $table->name=$request->name;
        $table->password=md5($request->password);
        $table->save();
        //alert()->success('success','You have successfully Updated.');
        toast('You have successfully Updated','success');
        return redirect('/dashboard');
    }

    /////////////////////////// Start Roll /////////////////////////////////////

    public function rolls(Request $request)
    {
        return view('admin.pages.from.roll', compact('request'));
    }

    public function addRoll(Request $request) {
        // return $request->t1;
        // die;
        $validator = Validator::make($request->all(), [
            'roll_name' => 'required|unique:rolls',
        ],
        [
            'roll_name.required' => 'You have entered an invalid value or blank. Please correct and try again',
            'roll_name.unique' => 'Roll Name Already Exists, Please try another one',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $inflector = new Inflector(
                new CachedWordInflector(new RulesetInflector(
                    English\Rules::getSingularRuleset()
                )),
                new CachedWordInflector(new RulesetInflector(
                    English\Rules::getPluralRuleset()
                ))
            );
            $table_name=$inflector->tableize($request->roll_name);
            //$table_name=$inflector->pluralize($sm_name);

            $table=new Roll;
            $table->roll_name=$request->roll_name;
            $table->roll=$table_name;
            $table->status='1';
            $table->save();
            $success = true;
            $message='Your Roll Name and Roll have been saved successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }

    public function getRoll(Request $request)
    {
        $table=Roll::find($request->id);
        return response()->json([
            $table
        ]);
    }

    public function updateRoll(Request $request) {
        // return $request->all();
        // die;
        $validator = Validator::make($request->all(), [
            'roll_name_update' => 'required|unique:rolls,roll_name',
        ],
        [
            'roll_name_update.required' => 'You have entered an invalid value or blank. Please correct and try again',
            'roll_name_update.unique' => 'Roll Name Already Exists, Please try another one',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=Roll::find($request->id);
            $table->roll_name=$request->roll_name_update;
            $table->roll=$table->roll_name;
            $table->save();
            $success = true;
            $message='Your Roll Name and Roll have been updated successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }

    function rollStatus(Request $request) {
        $table=Roll::find($request->id);
        $table->status = ($request->status=="0") ? "1" : "0";
        $table->save();
        toast('You have successfully Updated','success');
        return back();
    }

    function createForm($id){

        $data=Roll::find($id);
        return view('admin.pages.from.create-table-form', compact('data'));
    }

    public function ajaxCreateForm(Request $request)
    {
        $html="";

        $html='<tr>
                   <td>
                        <input type="text" name="meta_fld'.($request->call).'" class="form-control">
                   </td>
                   <td>
                   <select name="meta_type'.($request->call).'" class="form-select">
                   <option value="">Select Input Type</option>
                   <option value="text">Text</option>
                   <option value="email">Email</option>
                   <option value="number">Number</option>
                   <option value="password">Password</option>
                   <option value="radio">Radio</option>
                   <option value="checkbox">CheckBox</option>
                    </select>
                   </td>
                   <td colspan="2">
                   <button type="button" id="remove" class="btn btn-sm" onclick="removeForm()" title="Remove"><i class="fas fa-times text-danger" aria-hidden="true"></i></button></td>
                 </tr>';

        return $html;

    }

    function create_form(Request $request,$id)
    {
        $table=Roll::find($id);
        if (Schema::hasTable($table->roll))
        {
            // If exists
           // $table="yes";
        }else{
            $arr=[];
            Schema::create($table->roll, function (Blueprint $tables) use($request,$arr){
                $tables->id();
                for($i=1;$i<=$request->counter_sec;$i++){
                    $fld='meta_fld'.$i;
                    $type='meta_type'.$i;
                    $req_fld=$request->$fld;
                    $req_type=$request->$type;
                    $tables->$req_type($req_fld);
                    $data=[
                        $req_fld=>$request->$type
                    ];

                    array_push($arr,$data);
                }

                $tables->timestamps();
            });

            $resultArray = [];
            foreach ($arr as $subarray) {
                $resultArray = array_merge($resultArray, $subarray);
            }
            $table1=Roll::find($id);
            $table1->meta_data=$resultArray;
            $table1->save();


        }

        toast('You have successfully submitted','success');
        return back();
    }
    /////////////////////////// End Roll ///////////////////////////////////////////////////////

    /////////////////////////// Start subscriptions ////////////////////////////////////////////

    function subscriptions(Request $request) {
        return view('admin.pages.from.subscription', compact('request'));
    }

    public function addSubscriptions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sub_name' => 'required',
            'subn_amt_month' => 'required',
            'sub_amt_year' => 'required',
            'duration' => 'required',
        ],
        [
            'sub_name.required' => 'hbashbahs',
            'subn_amt_month.required' => 'Unique',
            'sub_amt_year.required' => 'We need to know your roll!',
            'duration.required' => 'We need to know your roll!',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=new Subscription;
            $table->subscription_name=$request->sub_name;
            $table->subscription_amount_month=$request->subn_amt_month;
            $table->subscription_amount_year=$request->sub_amt_year;
            $table->duration=$request->duration;
            $table->status='0';
            $table->save();
            $success = true;
            $message='Your Subscriptions have been saved successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);

    }

    public function getSubscriptions(Request $request)
    {
        $table=Subscription::find($request->id);
        return response()->json([
            $table
        ]);
    }

    public function updateSubscriptions(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ud_sub_name' => 'required',
            'ud_subn_amt_month' => 'required',
            'ud_sub_amt_year' => 'required',
            'ud_duration' => 'required',
        ],
        [
            'ud_sub_name.required' => 'hbashbahs',
            'ud_subn_amt_month.required' => 'Unique',
            'ud_sub_amt_year.required' => 'We need to know your roll!',
            'ud_duration.required' => 'We need to know your roll!',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=Subscription::find($request->id);
            $table->subscription_name=$request->ud_sub_name;
            $table->subscription_amount_month=$request->ud_subn_amt_month;
            $table->subscription_amount_year=$request->ud_sub_amt_year;
            $table->duration=$request->ud_duration;
            $table->save();
            $success = true;
            $message='Your Subscriptions have been updated successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);

    }

    function subscriptionsStatus(Request $request) {
        $table=Subscription::find($request->id);
        $table->status = ($request->status=="0") ? "1" : "0";
        $table->save();
        toast('You have successfully Updated','success');
        return back();
    }

    /////////////////////////// End subscriptions /////////////////////////////////////////////////


    function permissions(Request $request) {
        return view('admin.pages.from.permission', compact('request'));
    }

    public function addPermission(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'permis_name' => 'required',
            'permis_route' => 'required',
        ],
        [
            'permis_name.required' => 'hbashbahs',
            'permis_route.required' => 'We need to know your roll!',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=new Permission;
            $table->permis_name=$request->permis_name;
            $table->permis_route=$request->permis_route;
            $table->is_parent=$request->is_parent;
            $table->status='0';
            $table->save();
            $success = true;
            $message='Your Permission have been saved successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }

    public function getPermission(Request $request)
    {
        $table=Permission::find($request->id);
        return response()->json([
            $table
        ]);
    }

    public function updatePermission(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'permis_name_update' => 'required',
            'permis_route_update' => 'required',
        ],
        [
            'permis_name_update.required' => 'hbashbahs',
            'permis_route_update.required' => 'We need to know your roll!',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=Permission::find($request->id);
            $table->permis_name=$request->permis_name_update;
            $table->permis_route=$request->permis_route_update;
            $table->save();
            $success = true;
            $message='Your Permission have been updated successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }

    function permissionStatus(Request $request) {
        $table=Permission::find($request->id);
        $table->status = ($request->status=="0") ? "1" : "0";
        $table->save();
        toast('Permission status updated successfully','success');
        return back();
    }

    /////////////////////////// End Permissions ///////////////////////////////////////////////////

    /////////////////////////// Start Subscription Roll ///////////////////////////////////////////

    public function subscriptionPermissions(Request $request,$id)
    {
        return view('admin.pages.from.list-sub-permissions', compact('request','id'));
    }

    public function add_subscription_roll(Request $request)
    {
        return view('admin.pages.from.add-sub-roll', compact('request'));
    }

    public function addSubscriptionRoll(Request $request)
    {
        $table=new SubscriptionRoll;
        $table->subscrip_id=$request->subscrip_id;
        $table->roll_id=$request->roll_id;
        $table->permis_id=json_encode($request->permis_id, true);
        $table->status='0';
        $table->save();
        alert()->success('success','Your Subscriptions Roll have been saved successfully.');
        return back();
    }

    public function edit_subscription_roll($id)
    {
        $data=SubscriptionRoll::find($id);
        return view('admin.pages.from.edit-sub-roll', compact('data'));
    }

    public function editSubscriptionRoll(Request $request,$id)
    {
        $table=SubscriptionRoll::find($id);
        $table->permis_id=json_encode($request->permis_id, true);
        $table->status='0';
        $table->save();
        alert()->success('success','Your Subscriptions Roll have been updated successfully.');
        return back();
    }

    function subRollStatus(Request $request) {
        $table=SubscriptionRoll::find($request->id);
        $table->status = ($request->status=="0") ? "1" : "0";
        $table->save();
        toast('You have successfully Updated','success');
        return back();
    }
    /////////////////////////// End Subscription Roll //////////////////////////////////////////////

    /////////////////////////// Start Organization //////////////////////////////////////////////////

    function addOrganization(Request $request){
        return view('admin.pages.from.add-organization', compact('request'));
    }

    function add_Organization(Request $request){

        $rules = [
            'org_abbreviation' => 'required|unique:organizations',
        ];

        $customMessages = [
            'unique' => 'Abbreviation Already Exists, Please try another one',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        }else{

            $table = new Organization;
            $table->org_name = $request->org_name;

            $fullDomain = $request->input('domain') . '.' . $request->getHttpHost();

            $table->domain = $fullDomain;
            $table->org_address = $request->org_address;
            $table->org_mobile = $request->org_mobile;
            $table->org_fax = $request->org_fax;
            $table->org_email = $request->org_email;
            $table->org_registration_no = $request->org_registration_no;
            $table->org_gst_no = $request->org_gst_no;
            $table->org_abbreviation = $request->org_abbreviation;

            if ($request->hasFile('org_logo')) {
                $image = $request->file('org_logo');
                $new_file_name = Helper::imageConvert("org-logo-", 'org-logo/', $image);
                $table->org_logo = $new_file_name;
            }

            if ($request->hasFile('org_lhead')) {
                $image = $request->file('org_lhead');
                $new_file_name = Helper::imageConvert("org-lhead-", 'org-lhead/', $image);
                $table->org_lhead = $new_file_name;
            }

            if ($request->hasFile('org_lfooter')) {
                $image = $request->file('org_lfooter');
                $new_file_name = Helper::imageConvert("org-lfooter-", 'org-lfooter/', $image);
                $table->org_lfooter = $new_file_name;
            }

            $table->status = '0';
            $table->save();
            alert()->success('success','You have successfully added Organization.');
            return back();
        }

    }

    function listOrganization(Request $request){
        return view('admin.pages.from.list-organization',compact('request'));
    }

    function editOrganization($id){

        $data=Organization::find($id);
        return view('admin.pages.from.edit-organization', compact('data'));
    }

    function edit_Organization(Request $request, $id){

        $table=Organization::find($id);
        $table->org_name = $request->org_name;
        $table->org_address = $request->org_address;
        $table->org_mobile = $request->org_mobile;
        $table->org_fax = $request->org_fax;
        $table->org_email = $request->org_email;
        $table->org_registration_no = $request->org_registration_no;
        $table->org_gst_no = $request->org_gst_no;
        $table->org_abbreviation = $request->org_abbreviation;

        if ($request->hasFile('org_logo')) {
            $image_path = './public/images/org-logo/'.$table->org_logo;
            if (file_exists($image_path) && !empty($table->org_logo))
            {
            unlink($image_path);
            }
            $image = $request->file('org_logo');
            $new_file_name = Helper::imageConvert("org-logo-", 'org-logo/', $image);
            $table->org_logo=$new_file_name;
            }

        if ($request->hasFile('org_lhead')) {
            $image_path = './public/images/org-lhead/'.$table->org_lhead;
            if (file_exists($image_path) && !empty($table->org_lhead))
            {
            unlink($image_path);
            }
            $image = $request->file('org_lhead');
            $new_file_name = Helper::imageConvert("org-lhead-", 'org-lhead/', $image);
            $table->org_lhead=$new_file_name;
            }

        if ($request->hasFile('org_lfooter')) {
            $image_path = './public/images/org-lhead/'.$table->org_lfooter;
            if (file_exists($image_path) && !empty($table->org_lfooter))
            {
            unlink($image_path);
            }
            $image = $request->file('org_lfooter');
            $new_file_name = Helper::imageConvert("org-lfooter-", 'org-lfooter/', $image);
            $table->org_lfooter=$new_file_name;
            }

        $table->save();
        alert()->success('success','You have successfully updated Organization.');
        return back();

    }

    function addOrganizationSub(Request $request){

        $table = new OrgSubscription;
        $table->org_id=$request->org_id;
        $table->subs_id=$request->subs_id;
        $table->start_date=$request->start_date;
        $table->end_date=$request->end_date;
        $table->save();
        toast('Organization subscription saved successfully','success');
        return back();
    }

    function orgStatus(Request $request){
        $table=Organization::find($request->id);
        $table->status = ($request->status=="0") ? "1" : "0";
        $table->save();
        toast('Organization subscription status updated successfully','success');
        return back();
    }

    /////////////////////////// End Organization /////////////////////////////////////////////////////

    function allDoctor(Request $request){
        return view('admin.pages.from.all-doctor');
    }

    //  function addDoctor(Request $request){
    //     return view('admin.pages.doctor.add-doctor');
    // }

    function doctorProfile(Request $request){
        return view('admin.pages.from.doctor-profile');
    }


    function allDoctor2(Request $request)  {

        return view('admin.pages.from.all-doctor2');
    }

    function addUser(Request $request,$id)  {

        return view('admin.pages.from.add-user',compact('request','id'));
    }

    function add_User(Request $request)  {

        $rules = [
            'user_id' => 'required|unique:users',
            //'password' => ['required', 'confirmed', Password::min(8)],
        ];

        $customMessages = [
            'unique' => 'User Id Already Exists, Please try another one',
            //'required' => ' Please try another one',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator)->withInput();

        }else{

            $table = new User;
            $table->name = $request->name;
            $table->email = $request->email;
            $table->phone = $request->phone;
            $table->user_id = $request->user_id;
            $table->password = md5($request->password);

            $arr = [];

            for ($i = 1; $i <= $request->counter_sec; $i++) {
                $titleKey = 'title' . $i;
                $valueKey = 'value' . $i;
                $title = $request->$titleKey;
                $value = $request->$valueKey;

                //if (!empty($title) && !empty($value)) {
                    $data = [
                        $title => $value,
                    ];
                    array_push($arr,$data);
               // }
            //    return $data;
            //    die;
            }
            // dump($arr);
            // die;
            $resultArray = [];
            foreach ($arr as $subarray) {
                $resultArray = array_merge($resultArray, $subarray);
            }
            $jsonData = json_encode($resultArray);

            $table->additional_data = $jsonData;
            $table->roll_id = $request->roll_id;
            $table->org_id = $request->org_id;
            $table->status = "1";
            $table->is_delete = "N";
            $table->save();

            alert()->success('success', 'You have successfully added Users.');
            return back();
        }

    }

    public function ajaxAddUser(Request $request)
    {
        $html = '';

        $html = '<tr>
                   <td>
                        <input type="text" name="title' . ($request->call) . '" class="form-control">
                   </td>
                   <td>
                        <input type="text" name="value' . ($request->call) . '" class="form-control">
                   </td>
                   <td colspan="2">
                   <button type="button" id="remove" class="btn btn-sm" onclick="removeProduct()" title="Remove"><i class="fas fa-times text-danger" aria-hidden="true"></i></button></td>
                 </tr>';

        return $html;
    }


    // function editUsers($id) {

    //     $data=User::find($id);
    //     return view('admin.pages.from.edit-user',compact('data'));

    // }

    // function edit_users(Request $request,$id) {

    //     $table=User::find($id);
    //     $table->name=$request->name;
    //     $table->email=$request->email;
    //     $table->phone=$request->phone;
    //     $table->user_id=$request->user_id;
    //     $table->password=md5($request->password);
    //     $table->additional_data=$request->additional_data;
    //     $table->additional_data=$request->additional_data;
    //     $table->roll_id=$request->roll_id;
    //     $table->org_id=$request->org_id;
    //     $table->save();
    //     alert()->success('success','You have successfully updated Users.');
    //     return back();
    // }

    function usersStatus(Request $request) {
        $table=User::find($request->id);
        $table->status = ($request->status=="0") ? "1" : "0";
        $table->save();
        toast('User status updated successfully','success');
        return back();
    }

    function userDelete($id) {
        $table=User::find($id);
        $table->is_delete="Y";
        $table->save();
        toast('User delete successfully','success');
        return back();
    }

}
