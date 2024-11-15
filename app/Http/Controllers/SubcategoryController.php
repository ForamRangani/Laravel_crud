<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('backend.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }



    public function edit($id)
{
    $subcategory = Subcategory::findOrFail($id);
    $categories = Category::all(); // Assuming you have a Category model
    return view('backend.subcategories.edit', compact('subcategory', 'categories'));
}

public function update(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Update the subcategory
    $subcategory = Subcategory::findOrFail($id);
    $subcategory->name = $request->name;
    $subcategory->category_id = $request->category_id;
    $subcategory->save();

    return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully!');
}

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
