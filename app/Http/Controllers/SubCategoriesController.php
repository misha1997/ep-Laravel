<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategories;

class SubCategoriesController extends Controller
{
    public function index()
    {	
        return view('subcategories');
    }
    public function getSubCategories()
    {
       $data = SubCategories::with('categories')->get();
       return response()->json($data);
    }
    public function getSubCategoriesId($id)
    {
       $data = SubCategories::find($id)->with('categories')->get();
       return response()->json($data);
    }
    public function postSubCategories(Request $request)
    {
        $data = new SubCategories;
        $data->name = $request->name;
        $data->credits = $request->credits;
        $data->category_id = $request->category_id;
        $data->save();
    }
    public function putSubCategories(Request $request, $id)
    {
        $data = SubCategories::find($id);
        $data->name = $request->name;
        $data->credits = $request->credits;
        $data->category_id = $request->category_id;
        $data->save();
    }
    public function deleteSubCategories($id)
    {
        $educationItems = PlanItems::where('sub_category_id', $id)->get();
        $distributionHours = DistributionHours::get();

        for ($i = 0; $i < count($distributionHours); $i++) {
            for ($j = 0; $j < count($educationItems); $j++) {
                if($distributionHours[$i]["education_item_id"] == $educationItems[$j]["education_item_id"]) {
                    DistributionHours::where("education_item_id", $educationItems[$j]["education_item_id"])->delete();
                }
            }
        }

        PlanItems::where('sub_category_id', $id)->delete();
        SubCategories::find($id)->delete();
    }
}
