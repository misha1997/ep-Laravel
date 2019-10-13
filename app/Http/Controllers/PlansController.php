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
    function index() {	
        return view('home');
    }
    
    function getPlans() {
       $data = Plans::with('departments')->get();
       return response()->json($data);
    }

    function clonePlan(Request $request) {
        $data = new Plans;
        $data->user_id = $request->user_id;
        $data->department_id = $request->plan['department_id'];
        $data->name = $request->plan['name'].' - клон';
        $data->year = $request->plan['year'];
        $data->qualification = $request->plan['qualification'];
        $data->discipline = $request->plan['discipline'];
        $data->specialty = $request->plan['specialty'];
        $data->specialization = $request->plan['specialization'];
        $data->educational_program = $request->plan['educational_program'];
        $data->educational_level = $request->plan['educational_level'];
        $data->form_study = $request->plan['form_study'];
        $data->training_period = $request->plan['training_period'];
        $data->save();

        $planControls = PlanControls::where('id', $request->plan['id'])->get();

        for($i = 0; $i < count($planControls); $i++) {
            $newPlanControl = new PlanControls;
            $newPlanControl->id = $data->id;
            $newPlanControl->module_number = $planControls[$i]['module_number'];
            $newPlanControl->hours_week = $planControls[$i]['hours_week'];
            $newPlanControl->credit = $planControls[$i]['credit'];
            $newPlanControl->course_work = $planControls[$i]['course_work'];
            $newPlanControl->сontrol_work = $planControls[$i]['сontrol_work'];
            $newPlanControl->semester = $planControls[$i]['semester'];
            $newPlanControl->save();
        }

        $educationItems = PlanItems::where('education_plans_id', $request->plan['id'])->get();
        $newEducationItemId = [];
        for($i = 0; $i < count($educationItems); $i++) {
            $planItems = new PlanItems;
            if(isset($educationItems[$i]['sub_category_id'])) {
                $planItems->sub_category_id = $educationItems[$i]['sub_category_id'];
            }
            if(isset($educationItems[$i]['category_id'])) {
                $planItems->category_id = $educationItems[$i]['category_id'];
            }
            $planItems->cycles_id = $educationItems[$i]['cycles_id'];
            $planItems->education_plans_id = $data->id;
            $planItems->subject_id = $educationItems[$i]['subject_id'];
            $planItems->credits = $educationItems[$i]['credits'];
            $planItems->lectures = $educationItems[$i]['lectures'];
            $planItems->laboratories = $educationItems[$i]['laboratories'];
            $planItems->choice = $educationItems[$i]['choice'];
            $planItems->fixed = $educationItems[$i]['fixed'];
            $planItems->save();
            array_push($newEducationItemId, $planItems->education_item_id);
        }

        $distributionHours = DistributionHours::get();

        for($i = 0; $i < count($distributionHours); $i++) {
            for($j = 0; $j < count($educationItems); $j++) {
                if($distributionHours[$i]['education_item_id'] == $educationItems[$j]['education_item_id']) {
                    $newHours = new DistributionHours;
                    $newHours->education_item_id = $newEducationItemId[$j];
                    $newHours->form_control = $distributionHours[$i]['form_control'];
                    $newHours->individual_tasks = $distributionHours[$i]['individual_tasks'];
                    $newHours->module_number = $distributionHours[$i]['module_number'];
                    $newHours->semester = $distributionHours[$i]['semester'];
                    $newHours->value = $distributionHours[$i]['value'];
                    $newHours->save();
                }
            }
        }
    }

    function changeStatusPlan(Request $request, $id) {
        $data = Plans::find($id);
        $data->status = $request->status;
        $data->save();
    }

    function getPlanId($id) {
       $data = Plans::where('id', $id)->get();
       return response()->json($data);
    }

    function getPlanItems($id) {
        $plan = Plans::where('id', $id)->get();
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
        return response()->json([
            'plan' => $plan,
            'data' => $cycles, 
            'educationItems' => $items
        ]);
    }

    function postPlanItems(Request $request) {
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
        return response()->json(PlanItems::with('subjects')->where('education_item_id', $data->education_item_id)->get());
    }

    function postPlans(Request $request) {
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

    function putPlans(Request $request, $id) {
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
    function deletePlans($id) {
        $data = Plans::find($id);
    }

    function deletePlanItems($id) {
        DistributionHours::where('education_item_id', '=', $id)->delete();
        PlanItems::where('education_item_id', '=', $id)->delete();
    }

    function getPlanControls($id) {
       $data = PlanControls::where('id', $id)->get();
       return response()->json($data);
    }

    function updateLearningPlanItems(Request $request, $id) {
        $data = PlanItems::find($id);
        $data->lectures = $request->lectures;
        $data->laboratories = $request->laboratories;
        $data->save();
        return response()->json($data);
    }

    function postHoursItems(Request $request) {
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
        return response()->json(DistributionHours::where('education_item_id', $request->educationItemId)->get());
    }

    function postPlanControls(Request $request) {
        PlanControls::where('id', $request->planId)->delete();
        for($i = 0; $i < count($request->controls); $i++) {
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
