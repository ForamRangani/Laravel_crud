<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();
        return view('backend.products.index', compact('products'));
    }

    public function create()
    {
         $categories = Category::all();
        //  $subcategories = Subcategaory::get();
         return view('backend.products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required',
        'short_description' => 'required',
        'long_description' => 'required',
        'category_id' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle file upload
    $imageName = time().'.'.$request->image->extension();
    $request->image->move(public_path('images/products'), $imageName);

    // Create product
    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'short_description' => $request->short_description,
        'long_description' => $request->long_description,
        'image' => $imageName,
        'category_id' => $request->category_id,
        'subcategory_id' => $request->subcategory_id
    ]);

    return redirect()->route('products.index')->with('success', 'Product added successfully!');
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $subcategories = Subcategory::all();
    return view('backend.products.edit', compact('product', 'categories', 'subcategories'));
}

// public function update(Request $request, $id)
// {
//     $product = Product::findOrFail($id);

//     $request->validate([
//         'name' => 'required',
//         'price' => 'required',
//         'short_description' => 'required',
//         'long_description' => 'required',
//         'category_id' => 'required',
//         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
//     ]);

//     // Handle file upload if new image is uploaded
//     if ($request->hasFile('image')) {
//         $imageName = time().'.'.$request->image->extension();
//         $request->image->move(public_path('images/products'), $imageName);
//         $product->image = $imageName;
//     }

//     // Update product details
//     $product->update($request->all());

//     return redirect()->route('products.index')->with('success', 'Product updated successfully!');
// }

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'price' => 'required',
        'short_description' => 'required',
        'long_description' => 'required',
        'category_id' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle file upload if new image is uploaded
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if (file_exists(public_path('images/products/'.$product->image))) {
            unlink(public_path('images/products/'.$product->image));
        }

        // Upload new image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);

        // Update the product's image
        $product->image = $imageName;
    }

    // Update other product details
    $product->name = $request->name;
    $product->price = $request->price;
    $product->short_description = $request->short_description;
    $product->long_description = $request->long_description;
    $product->category_id = $request->category_id;
    $product->subcategory_id = $request->subcategory_id;

    // Save the updated product
    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

public function getSubcategories(Request $request)
{
    // Find subcategories based on the selected category
    $subcategories = Subcategory::where('category_id', $request->category_id)->get();

    // Return the subcategories in JSON format
    // return response()->json($subcategories);
    return view('subcatlist',compact('subcategories'));
}

public function destroy($id)
{
    $product = Product::findOrFail($id);
    if (file_exists(public_path('images/products/'.$product->image))) {
        unlink(public_path('images/products/'.$product->image));
    }
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
}


}
