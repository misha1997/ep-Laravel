<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plans;
use App\Models\PlanControls;
use App\Models\PlanItems;
use App\Models\Cycles;
use App\Models\SubCategories;
use App\Models\DistributionHours;

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

    public function postPlanItems(Request $request) {
        $data = new PlanItems;
        if(isset($request->sub_category_id)) {
            $data->sub_category_id = $request->sub_category_id;
        }
        if(isset($request->category_id)) {
            $data->category_id = $request->category_id;
        }
        $data->cycles_id = $request->cycles_id;
        $data->education_plans_id = $request->education_plans_id;
        $data->subject_id = $request->subject_id;
        $data->credits = $request->credits;
        $data->lectures = $request->lectures;
        $data->laboratories = $request->laboratories;
        $data->choice = $request->choice;
        $data->fixed = $request->fixed;
        $data->save();
        return response()->json(PlanItems::with('subjects')->where('education_item_id', '=', $data->education_item_id)->get());
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

    public function deletePlanItems($id)
    {
        DistributionHours::where('education_item_id', '=', $id)->delete();
        PlanItems::where('education_item_id', '=', $id)->delete();
    }

    public function getPlanControls($id)
    {
       $data = PlanControls::where('id', $id)->get();
       return response()->json($data);
    }
    public function updateLearningPlanItems(Request $request, $id)
    {
        $data = PlanItems::find($id);
        $data->lectures = $request->lectures;
        $data->laboratories = $request->laboratories;
        $data->save();
        return response()->json($data);
    }
    public function postHoursItems(Request $request) {
        DistributionHours::where('education_item_id', $request->educationItemId)->delete();
        for($i = 0; $i < count($request->data); $i++) {
            $newHours = new DistributionHours;
            $newHours->education_item_id = $request->educationItemId;
            $newHours->form_control = $request->data[$i]['form_control'];
            $newHours->individual_tasks = $request->data[$i]['individual_tasks'];
            $newHours->module_number = $request->data[$i]['module_number'];
            $newHours->semester = $request->data[$i]['semester'];
            $newHours->value = $request->data[$i]['value'];
            $newHours->save();
        }
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
