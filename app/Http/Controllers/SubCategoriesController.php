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
        $data = SubCategories::find($id);
        if($data->delete()){
            return ;
        }
    }
}
