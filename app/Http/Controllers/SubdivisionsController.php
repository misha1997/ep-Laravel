<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subdivisions;

class SubdivisionsController extends Controller
{
    public function index()
    {	
        return view('subdivisions');
    }
    public function getSubdivisions()
    {
       $data = Subdivisions::orderBy('created_at', 'asc')->get();
       return response()->json($data);
    }
    public function postSubdivisions(Request $request)
    {
        $data = new Subdivisions;
        $data->name = $request->name;
        $data->save();
    }
    public function putSubdivisions(Request $request, $id)
    {
        $data = Subdivisions::find($id);
        $data->name = $request->name;
        $data->save();
    }
    public function deleteSubdivisions($id)
    {
        $data = Subdivisions::find($id);
        if($data->delete()){
            return ;
        }
    }
}
