<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Helper;
use Validator;
use App\Models\Department;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.pages.department.department', compact('request'));
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments',
        ],
        [
            'name.required' => 'You have entered an invalid value or blank. Please correct and try again',
            'name.unique' => 'Department Name Already Exists, Please try another one',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=new Department;
            $table->name=$request->name;
            $table->status='1';
            $table->save();
            $success = true;
            $message='Your Department Name have been saved successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table=Department::find($id);
        $table->status = ($request->status=="0") ? "1" : "0";
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

    public function getDepartment(Request $request)
    {
        $table=Department::find($request->id);
        return response()->json([
            $table
        ]);
    }

    public function updet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_update' => 'required|unique:departments,name',
        ],
        [
            'name_update.required' => 'You have entered an invalid value or blank. Please correct and try again',
            'name_update.unique' => 'Department Name Already Exists, Please try another one',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=Department::find($request->id);
            $table->name=$request->name_update;
            $table->save();
            $success = true;
            $message='Your Department Name have been updated successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }
}
