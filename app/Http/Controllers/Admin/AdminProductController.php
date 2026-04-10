<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
     public function index()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'type' => 'nullable|string|max:100',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('photo')) {
            $filePath = $request->file('photo')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'type' => $request->type,
            'price' => $request->price,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

        public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika ada file baru diupload
        if ($request->hasFile('photo')) {
            // hapus foto lama (opsional)
            if ($product->file_path && file_exists(storage_path('app/public/' . $product->file_path))) {
                unlink(storage_path('app/public/' . $product->file_path));
            }

            // simpan foto baru
            $path = $request->file('photo')->store('products', 'public');
            $validatedData['file_path'] = $path;
        }

        // update data ke database
        $product->update($validatedData);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Hapus file gambar jika ada
        if ($product->file_path && Storage::disk('public')->exists($product->file_path)) {
            Storage::disk('public')->delete($product->file_path);
        }

        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}
