<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Helper;
use Validator;
use App\Models\Doctor;
use App\Models\PatientRegistration;

class PatientRegister extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.pages.patient.patient-registration', compact('request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = DB::table('patient_registrations')->orderBy('id', 'desc')->first();
        if (!empty($data->id) && $data->id > '0') {
            $prv_id = $data->patient_id;
            echo $prv_id;
            die;
        } else {
            $prv_id = '0';
        }
        $table = new PatientRegistration;
        $table->org_id=$request->org_id;
        $table->depart_id=$request->depart_id;
        $table->doc_id=$request->doc_id;
        $table->patient_id = Helper::genCodeNo($prv_id);
        $table->f_name=$request->f_name;
        $table->l_name=$request->l_name;
        $table->gender=$request->gender;
        $table->marital_status=$request->marital_status;
        $table->lmp=$request->lmp;
        $table->handed=$request->handed;
        $table->blood_group=$request->blood_group;
        $table->bs=$request->bs;
        $table->dob=$request->dob;
        $table->age=$request->age;
        $table->height=$request->height;
        $table->weight=$request->weight;
        $table->bp_sy=$request->bp_sy;
        $table->bp_di=$request->bp_di;
        $table->occupation=$request->occupation;
        $table->mobile=$request->mobile;
        $table->email=$request->email;
        $table->address=$request->address;
        $table->book_date=$request->book_date;
        $table->fees=$request->fees;
        $table->total_amount=$request->total_amount;
        $table->discount=$request->discount;
        $table->due=$request->due;
        $table->payment_method=$request->payment_method;//'cash';
        $table->comments=$request->comments;
        $table->status='1';
        $table->save();
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
    public function edit(string $id)
    {
        $data = PatientRegistration::find($id);
        return view("admin.pages.patient.edit-patient-registration",compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = DB::table('patient_registrations')->orderBy('id', 'desc')->first();
        if (!empty($data->id) && $data->id > '0') {
            $prv_id = $data->patient_id;
            // echo $prv_id;
            // die;
        } else {
            $prv_id = '0';
        }
        $table = PatientRegistration::find($id);
        $table->org_id=$request->org_id;
        $table->depart_id=$request->depart_id;
        $table->doc_id=$request->doc_id;
        $table->patient_id = Helper::genCodeNo($prv_id);
        $table->f_name=$request->f_name;
        $table->l_name=$request->l_name;
        $table->gender=$request->gender;
        $table->marital_status=$request->marital_status;
        $table->lmp=$request->lmp;
        $table->handed=$request->handed;
        $table->blood_group=$request->blood_group;
        $table->bs=$request->bs;
        $table->dob=$request->dob;
        $table->age=$request->age;
        $table->height=$request->height;
        $table->weight=$request->weight;
        $table->bp_sy=$request->bp_sy;
        $table->bp_di=$request->bp_di;
        $table->occupation=$request->occupation;
        $table->mobile=$request->mobile;
        $table->email=$request->email;
        $table->address=$request->address;
        $table->book_date=$request->book_date;
        $table->fees=$request->fees;
        $table->total_amount=$request->total_amount;
        $table->discount=$request->discount;
        $table->due=$request->due;
        $table->payment_method=$request->payment_method;//'cash';
        $table->comments=$request->comments;
        $table->status='1';
        $table->save();
        toast('You have successfully Updated','success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function listPatient(Request $request)
    {
        return view('admin.pages.patient.list-patient', compact('request'));
    }
}
