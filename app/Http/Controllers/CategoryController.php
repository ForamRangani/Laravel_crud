<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    public function show($id)
    {
             $category = Category::findOrFail($id);
             return view('backend.categories.show', compact('category'));
    }

    public function create()

    {
        return view('backend.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        Category::create([
            'name' => $request->name,

        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully...');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('backend.categories.edit', compact('category'));
    }

    // Update an existing category in the database
    public function update(Request $request,$id)
    {

        $category = Category::findOrFail($id);

        // Validate the input
        $request->validate([
            'name' => 'required',

        ]);

        // Category update karo
        $category->name = $request->input('name');
        $category->save();

        // Redirect back with success message
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');

    }

    // Delete a category from the database
    public function destroy($id)
    {
        $category = Category::findOrFail($id); // Find the category by ID
        $category->delete(); // Delete the category
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
