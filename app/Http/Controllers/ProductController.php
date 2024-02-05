<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'imageProduct')->get();
        
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.products.create', [
            'category' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create product
        $product = Product::create($request->only('name', 'price', 'description', 'stock', 'category_id'));

        // Upload and attach images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ImageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.products.edit', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'removed_images.*' => 'exists:image_products,id',
        ]);

        $product = Product::findOrFail($id);

        // Update product
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'category_id' => $request->input('category_id'),
        ]);

        // Handle image updates
        if ($request->has('removed_images')) {
            $removedImageIds = $request->input('removed_images');

            ImageProduct::whereIn('id', $removedImageIds)->delete();

            // Delete the actual image files
            foreach ($removedImageIds as $imageId) {
                $image = ImageProduct::findOrFail($imageId);

                $imagePath = public_path('storage/' . $image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            return redirect()->back()->with('success', 'Product updated successfully.');
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                ImageProduct::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function removeImage(Request $request, $imageId)
    {
        try {
            $image = ImageProduct::findOrFail($imageId);

            $imagePath = public_path('storage/' . $image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $image->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error removing image']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->imageProduct()->delete();
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
