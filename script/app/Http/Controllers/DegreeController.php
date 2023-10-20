<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Degree;
use DB;
use Session;
use Helper;
use Validator;
class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('admin.pages.degree.degree', compact('request'));
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
            'name' => 'required|unique:degrees',
        ],
        [
            'name.required' => 'You have entered an invalid value or blank. Please correct and try again',
            'name.unique' => 'Degree Name Already Exists, Please try another one',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=new Degree;
            $table->name=$request->name;
            $table->status='1';
            $table->save();
            $success = true;
            $message='Your Degree Name have been saved successfully';
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
        $table=Degree::find($id);
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

    public function getDegree(Request $request)
    {
        $table=Degree::find($request->id);
        return response()->json([
            $table
        ]);
    }

    public function updet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_update' => 'required|unique:degrees,name',
        ],
        [
            'name_update.required' => 'You have entered an invalid value or blank. Please correct and try again',
            'name_update.unique' => 'Degree Name Already Exists, Please try another one',
        ]);

         if($validator->fails()){
            $success = false;
            $table=json_encode($validator->errors());
            $message='Error';
         }else{
            $table=Degree::find($request->id);
            $table->name=$request->name_update;
            $table->save();
            $success = true;
            $message='Your Degree Name have been updated successfully';
         }
        return response()->json([
            'success' => $success,
            'data' => $table,
            'message' => $message
        ]);
    }
}
