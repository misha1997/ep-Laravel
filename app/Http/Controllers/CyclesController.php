<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cycles;

class CyclesController extends Controller
{
    public function index()
    {	
        return view('cycles');
    }
    public function getCycles()
    {
       $data = Cycles::orderBy('created_at', 'asc')->get();
       return response()->json($data);
    }
    public function postCycles(Request $request)
    {
        $cycles = new Cycles;
        $cycles->name = $request->name;
        $cycles->credits = $request->credits;
        $cycles->save();
        return $cycles;
    }
    public function putCycles(Request $request, $id)
    {
        $cycles = Cycles::find($id);
        $cycles->name = $request->name;
        $cycles->credits = $request->credits;
        $cycles->save();
    }
    public function deleteCycles($id)
    {
        $cycles = Cycles::find($id);
        if($cycles->delete()){
            return ;
        }
    }
}
