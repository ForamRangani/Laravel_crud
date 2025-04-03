<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return response()->json([
            'categories'=>$categories,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->post(),[
            'name'=>'required|max:255',
        ]);
        if($validator->fails()){
            return response()->json([
                  'error'=>$validator->errors(),
            ]);
        }
        $category=Category::create([
            'name'=>$request->name,
        ]);

        return  response()->json([
            'message'=>'category created!!',
            'category'=>$category,
        ]);
    }

    public function edit(Request $request)
    {
        $id=$request->id;
        $category=Category::where('id',$id)->first();
         return response()->json([
            'category'=>$category,
        ]);
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 400);
        }

        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }

        $category->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'Category updated!!',
            'category' => $category,
        ], 200);
    }

    public function destroy($id)
    {
    $category = Category::find($id);

    if (!$category) {
        return response()->json([
            'message' => 'Category not found'
        ], 404);
    }


    $category->delete();

    return response()->json([
        'message' => 'Category deleted successfully!'
    ], 200);

    }

}
