<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanItems;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\DistributionHours;

class CategoriesController extends Controller
{
    public function index()
    {	
        return view('categories');
    }
    public function getCategories()
    {
       $data = Categories::with('cycles')->get();
       return response()->json($data);
    }
    public function getCategoriesId($id)
    {
       $data = Categories::find($id)->with('cycles')->get();
       return response()->json($data);
    }
    public function postCategories(Request $request)
    {
        $categories = new Categories;
        $categories->name = $request->name;
        $categories->credits = $request->credits;
        $categories->cycles_id = $request->cycles_id;
        $categories->save();
    }
    public function putCategories(Request $request, $id)
    {
        $categories = Categories::find($id);
        $categories->name = $request->name;
        $categories->credits = $request->credits;
        $categories->cycles_id = $request->cycles_id;
        $categories->save();
    }
    public function deleteCategories($id)
    {
        $educationItems = PlanItems::where('category_id', $id)->get();
        $distributionHours = DistributionHours::get();

        for ($i = 0; $i < count($distributionHours); $i++) {
            for ($j = 0; $j < count($educationItems); $j++) {
                if($distributionHours[$i]["education_item_id"] == $educationItems[$j]["education_item_id"]) {
                    DistributionHours::where("education_item_id", $educationItems[$j]["education_item_id"])->delete();
                }
            }
        }

        PlanItems::where('category_id', $id)->delete();
        SubCategories::where("category_id", $id)->delete();
        Categories::find($id)->delete();
    }
}
