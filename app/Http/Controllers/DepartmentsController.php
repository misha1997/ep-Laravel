<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departments;

class DepartmentsController extends Controller
{
    public function index()
    {	
        return view('departments');
    }
    public function getDepartments()
    {
       $data = Departments::with('subdivisions')->get();
       return response()->json($data);
    }
    public function getDepartmentId($id)
    {
        $data = Departments::where('subdivision_id', '=', $id)->get();
        return response()->json($data);
    }
    public function postDepartments(Request $request)
    {
        $data = new Departments;
        $data->name = $request->name;
        $data->subdivision_id = $request->subdivision_id;
        $data->save();
    }
    public function putDepartments(Request $request, $id)
    {
        $data = Departments::find($id);
        $data->name = $request->name;
        $data->subdivision_id = $request->subdivision_id;
        $data->save();
    }
    public function deleteDepartments($id)
    {
        $data = Departments::find($id);
        if($data->delete()){
            return ;
        }
    }
}
