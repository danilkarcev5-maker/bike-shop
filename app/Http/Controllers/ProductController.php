<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Список товаров
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    // Показать форму создания
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // Сохранение нового товара
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:2048',
    ]);

    $data = $request->all();
    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    Product::create($data);
    return redirect()->route('admin.products.index')->with('success', 'Товар добавлен.');
}

    // Удаление товара
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Товар удалён.');
    }
}