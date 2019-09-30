<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subjects;

class SubjectsController extends Controller
{
    public function index()
    {	
        return view('subjects');
    }
    public function getSubjects()
    {
       $data = Subjects::orderBy('created_at', 'asc')->get();
       return response()->json($data);
    }
    public function postSubjects(Request $request)
    {
        $data = new Subjects;
        $data->name = $request->name;
        $data->save();
    }
    public function putSubjects(Request $request, $id)
    {
        $data = Subjects::find($id);
        $data->name = $request->name;
        $data->save();
    }
    public function deleteSubjects($id)
    {
        $data = Subjects::find($id);
        if($data->delete()){
            return ;
        }
    }
}
