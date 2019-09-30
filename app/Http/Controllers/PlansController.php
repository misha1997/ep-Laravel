<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;
use App\Models\PlanControls;

class PlansController extends Controller
{
    public function index()
    {	
        return view('home');
    }
    public function getPlans()
    {
       $data = Plans::with('departments')->get();
       return response()->json($data);
    }
    public function postPlans(Request $request)
    {
        $data = new Plans;
        $data->user_id = $request->user_id;
        $data->department_id = $request->department_id;
        $data->name = $request->name;
        $data->year = $request->year;
        $data->qualification = $request->qualification;
        $data->discipline = $request->discipline;
        $data->specialty = $request->specialty;
        $data->specialization = $request->specialization;
        $data->educational_program = $request->educational_program;
        $data->educational_level = $request->educational_level;
        $data->form_study = $request->form_study;
        $data->training_period = $request->training_period;
        $data->save();
    }
    public function putPlans(Request $request, $id)
    {
        $data = Plans::find($id);
        $data->name = $request->name;
        $data->department_id = $request->department_id;
        $data->year = $request->year;
        $data->qualification = $request->qualification;
        $data->discipline = $request->discipline;
        $data->specialty = $request->specialty;
        $data->specialization = $request->specialization;
        $data->educational_program = $request->educational_program;
        $data->educational_level = $request->educational_level;
        $data->form_study = $request->form_study;
        $data->training_period = $request->training_period;
        $data->save();
    }
    public function deletePlans($id)
    {
        $data = Plans::find($id);
        if($data->delete()){
            return ;
        }
    }

    public function getPlanControls($id)
    {
       $data = PlanControls::find($id);
       return response()->json($data);
    }
}
