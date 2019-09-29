<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Cycles;

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
    public function postCategories(Request $request)
    {
        $categories = new Categories;
        $categories->name = $request->name;
        $categories->credits = $request->credits;
        $categories->cycles_id = $request->cycles_id;
        $categories->save();
        $categories->cycles = Cycles::find($request->cycles_id);
        return $categories;
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
        $categories = Categories::find($id);
        if($categories->delete()){
            return ;
        }
    }
}
