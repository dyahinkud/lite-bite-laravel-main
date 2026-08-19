<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
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
        $products = MenuItem::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'carb' => 'nullable|string|max:20',
            'protein' => 'nullable|string|max:20',
            'fat' => 'nullable|string|max:20',
            'calories' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $validated['image_url'] = 'storage/' . $path;
        }

        MenuItem::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = MenuItem::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.form', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = MenuItem::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'carb' => 'nullable|string|max:20',
            'protein' => 'nullable|string|max:20',
            'fat' => 'nullable|string|max:20',
            'calories' => 'nullable|string|max:20',
        ]);

        if ($request->hasFile('image_file')) {
            // Delete old image if exists
            if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->image_url));
            }
            $path = $request->file('image_file')->store('products', 'public');
            $validated['image_url'] = 'storage/' . $path;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = MenuItem::findOrFail($id);

        if ($product->image_url && str_starts_with($product->image_url, 'storage/')) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->image_url));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}