<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;
use App\Models\PlanControls;
use App\Models\PlanItems;
use App\Models\Cycles;
use App\Models\SubCategories;

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
    public function getPlanId($id)
    {
       $data = Plans::where('id', $id)->get();
       return response()->json($data);
    }
    public function getPlanItems($id)
    {
        $cycles = Cycles::with('categories')->orderBy('created_at', 'asc')->get();
        $subCategories = SubCategories::orderBy('created_at', 'asc')->get();
        for($i = 0; $i < count($cycles); $i++) {
            if(count($cycles[$i]['categories']) > 0) {
                for($k = 0; $k < count($cycles[$i]['categories']); $k++) {
                    $array = [];
                    for($j = 0; $j < count($subCategories); $j++) {
                        if($cycles[$i]['categories'][$k]['category_id'] == $subCategories[$j]['category_id']) {
                            array_push ($array, $subCategories[$j]);
                        }
                    }
                    $cycles[$i]['categories'][$k]['subcategory'] = $array;
                    $array = [];
                }
            }
        }
        $items = PlanItems::with('subjects', 'hours')->where('education_plans_id', $id)->get();
        return response()->json(['data' => $cycles, 'educationItems' => $items]);
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
       $data = PlanControls::where('id', $id)->get();
       return response()->json($data);
    }

    public function postPlanControls(Request $request)
    {
        $control = PlanControls::where('id', $request->planId)->get();
         if(count($control) > 0) {
             for($i = 0; $i < 16; $i++) {
                $data = PlanControls::find($control[$i]['control_id']);
                $data->module_number = $request->controls[$i]['module_number'];
                $data->hours_week = $request->controls[$i]['hours_week'];
                $data->credit = $request->controls[$i]['credit'];
                $data->course_work = $request->controls[$i]['course_work'];
                $data->сontrol_work = $request->controls[$i]['сontrol_work'];
                $data->semester = $request->controls[$i]['semester'];
                $data->save();
             }
        } else {
            for($i = 0; $i < 16; $i++) {
                $data = new PlanControls;
                $data->id = $request->planId;
                $data->module_number = $request->controls[$i]['module_number'];
                $data->hours_week = $request->controls[$i]['hours_week'];
                $data->credit = $request->controls[$i]['credit'];
                $data->course_work = $request->controls[$i]['course_work'];
                $data->сontrol_work = $request->controls[$i]['сontrol_work'];
                $data->semester = $request->controls[$i]['semester'];
                $data->save();
            }
        }
    }
}
