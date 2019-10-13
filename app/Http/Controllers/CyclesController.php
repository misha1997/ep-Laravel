<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cycles;
use App\Models\PlanItems;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\DistributionHours;

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
    public function getCyclesId($id)
    {
       $data = Cycles::find($id)->orderBy('created_at', 'asc')->get();
       return response()->json($data);
    }
    public function postCycles(Request $request)
    {
        $cycles = new Cycles;
        $cycles->name = $request->name;
        $cycles->credits = $request->credits;
        $cycles->save();
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
        $educationItems = PlanItems::where('cycles_id', $id)->get();
        $distributionHours = DistributionHours::get();

        for ($i = 0; $i < count($distributionHours); $i++) {
            for ($j = 0; $j < count($educationItems); $j++) {
                if($distributionHours[$i]["education_item_id"] == $educationItems[$j]["education_item_id"]) {
                    DistributionHours::where("education_item_id", $educationItems[$j]["education_item_id"])->delete();
                }
            }
        }

        $category = Categories::where('cycles_id', $id)->get();
        $subCategories = SubCategories::get();

        for ($i = 0; $i < count($subCategories); $i++) {
            for ($j = 0; $j < count($category); $j++) {
                if($subCategories[$i]["category_id"] == $category[$j]["category_id"]) {
                    SubCategories::where("category_id", $category[$j]["category_id"])->delete();
                }
            }
        }

        PlanItems::where('cycles_id', $id)->delete();
        Categories::where("cycles_id", $id)->delete();
        Cycles::find($id)->delete();
    }
}
