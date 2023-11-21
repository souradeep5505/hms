<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use DB;
use Session;
use Helper;
use Validator;
use App\Models\Doctor;
use App\Models\DoctorsTime;
use App\Models\DocTimeDayWeek;
use App\Models\DocTimeMonth;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.doctor.list-doctor');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.doctor.add-doctor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->department_id;
        // die;
       $table=new Doctor;
       $table->org_id=$request->org_id;
       $table->entry_id=$request->entry_id;
       $table->f_name=$request->f_name;
       $table->l_name=$request->l_name;
       $table->email=$request->email;
       $table->mobile=$request->mobile;
       $table->dob=$request->dob;
       $degree = json_encode($request->degree_id, true);
       $table->degree_id=$degree;
       $table->department_id=$request->department_id;
       $table->fees=$request->fees;
       $table->gender=$request->gender;
       if ($request->hasFile('image')) {
        $image = $request->file('image');
        $new_file_name=Helper::imageConvert("doc-img-",'doctor/',$image);
        $table->image=$new_file_name;
        }
       $table->address=$request->address;
       $table->entry_by='sa';//$request->entry_by;
       $table->status='1';
       $table->save();
    //    for($i=1;$i<=$request->counter_sec; $i++){
    //    $table1=new DoctorsTime;
    //    $table1->doctor_id=$table->id;
    //    $table1->day=$request['day'.$i];
    //    $table1->start_time=$request['start_time'.$i];
    //    $table1->end_time=$request['end_time'.$i];
    //    $table1->slot=$request['slot'.$i];
    //    $table1->save();
    //    }
       $table2=new DoctorsTime;
       $table2->org_id=$request->org_id;
       $table2->doc_id=$table->id;
       $table2->opt=null;
       $table2->value=$request->value;
       $table2->status='1';
       $table2->save();
       toast('You have successfully Added','success');
       return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Doctor::find($id);
        return view("admin.pages.doctor.edit-doctor",compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $table = Doctor::find($id);
       // $table->org_id=1;//$request->org_id;
       // $table->entry_id=1;//$request->entry_id;
        $table->f_name=$request->f_name;
        $table->l_name=$request->l_name;
        $table->email=$request->email;
        $table->mobile=$request->mobile;
        $table->dob=$request->dob;
        $degree = json_encode($request->degree_id, true);
        $table->degree_id=$degree;
        $table->department_id=$request->department_id;
        $table->fees=$request->fees;
        $table->gender=$request->gender;

        if ($request->hasFile('image')) {
            $image_path = './public/images/doctor/'.$table->image;
            if (file_exists($image_path) && !empty($table->image))
            {
            unlink($image_path);
            }
            $image = $request->file('image');
            $new_file_name=Helper::imageConvert("doc-img-",'doctor/',$image);
            $table->image=$new_file_name;
            }
        $table->address=$request->address;
        $table->save();
        toast('You have successfully updated','success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
       //
    }

    public function ajaxAddDoctor(Request $request)
    {
        $html="";

        $html='<tr>
                   <td>
                        <select class="form-select" name="day'.($request->call).'">
                            <option value="sunday">Sunday</option>
                            <option value="monday">Monday</option>
                            <option value="twesday">Twesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Twesday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                        </select>
                   </td>
                   <td>
                        <input type="time" name="start_time'.($request->call).'" class="form-control">
                   </td>
                   <td>
                        <input type="time" name="end_time'.($request->call).'" class="form-control">
                   </td>
                   <td>
                        <input type="text" name="slot'.($request->call).'" class="form-control">
                   </td>
                   <td colspan="2">
                        <button type="button" id="remove" class="btn btn-sm" onclick="removeRow()" title="Remove"><i class="fas fa-times text-danger" aria-hidden="true"></i></button>
                   </td>
                </tr>';

        return $html;

    }

    function timeEdit(Request $request,$id){

        $doctrs=DB::table('doctors')->where('id',$id)->where('status','1')->first();
        $doctors=DB::table('doctors_times')->where('doctor_id',$doctrs->id)->get();
        return view('admin.pages.doctor.doctor-time-edit',compact('doctrs','doctors'));
    }

    function timeUpdate(Request $request,$id){

        for($i=1;$i<=$request->counter_sec; $i++){
            $table1=new DoctorsTime;
            $table1->doctor_id=$id;
            $table1->day=$request['day'.$i];
            $table1->start_time=$request['start_time'.$i];
            $table1->end_time=$request['end_time'.$i];
            $table1->slot=$request['slot'.$i];
            $table1->save();
            }
            toast('You have successfully updated','success');
            return back();
    }

    public function ajaxDocTimeDelete($id)
    {
        $table = DoctorsTime::find($id);
        $table->delete();
        toast('You have successfully delete','success');
        //return back();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }


    public function ajaxDoctorTime(Request $request)
    {
    $html = '';

    $html .= '<tr>
    <td>
        <select class="form-select" name="month'.$request->call.'">
            <option value="">Select Month</option>';
            for ($mon=1;$mon<=12;$mon++){
                $html .= '<option value="'.$mon.'">'.Helper::months($mon).'</option>';
            }
            $html .= '</select>
    </td>
    <td>
        <select class="form-select" name="mulopt'.$request->call.'" onchange="selectMulOpt(this.value,'.$request->call.')">
            <option value="">Select Option</option>
            <option value="day">Day</option>
            <option value="week">Week</option>
        </select>
    </td>
    <td>
        <div id="mulDay'.$request->call.'" style="display: none;">
            <select id="selectMultipleDay'.$request->call.'" name="mul_day'.$request->call.'[]" class="form-control" multiple="multiple" data-placeholder="Select Day" >
                <option value="">Select Day</option>';
                for($day=1;$day<=31;$day++){
                    $html .= '<option value="'.$day.'">'.$day.'</option>';
        }
        $html .= '</select>
        </div>
        <div id="mulWeek'.$request->call.'" style="display: none;">
            <select id="selectMultipleWeek'.$request->call.'" name="mul_week'.$request->call.'[]" class="form-control" multiple="multiple" data-placeholder="Select Week" >
                <option value="">Select Week</option>';
                for ($wk=1;$wk<=7;$wk++){
                    $html .= '<option value="'.$wk.'">'.Helper::weekDays($wk).'</option>';
                }
                $html .= ' </select>
        </div>

    </td>
    <td>
    <button type="button" id="remove1" class="btn btn-sm remove-button" title="Remove"><i class="fas fa-times text-danger"></i></button>
   </td>
        <script>
            $(document).ready(function() {
                $("#selectMultipleDay'.$request->call.'").select2();
                $("#selectMultipleWeek'.$request->call.'").select2();
            });
        </script>

    </tr>';
    return $html;
}

function doctortime(Request $request,$id)
{
    $doctrs=DB::table('doctors')->where('id',$id)->where('status','1')->first();
    return view("admin.pages.doctor.doctortime",compact('request','doctrs'));
}

function docTime(Request $request,$id)
{
    // return $request->all();
    // die;
    $table = DoctorsTime::find($id);
    $table->org_id='1';
    $table->doc_id=$request->doc_id;
    $table->opt=$request->opt;
    $table->value=json_encode($request->all());
    $table->slot=$request->slot;
    //$table->status='1';
    $table->save();
    toast('You have successfully updated','success');
    return back();

}

function doctimeTable(Request $request) {

    return view("admin.pages.doctor.doctortimetable");

}

public function ajaxdoctimeTable(Request $request)
{
    $html1 = '<input type="time" class="form-control" name="start_time'.$request->p.'_' . $request->call . '"><br>';

    $html2 = '<input type="time" class="form-control" name="end_time'.$request->p.'_' . $request->call . '"><br>';
    $html=[
        $html1, $html2
    ];
    return $html;
}

}
