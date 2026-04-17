<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Главная страница
    public function index()
    {
        $products = Product::latest()->take(6)->get();
        return view('home', compact('products'));
    }

    // Каталог товаров
    public function catalog()
    {
        $products = Product::with('category')->paginate(12);
        $categories = Category::all();
        return view('catalog', compact('products', 'categories'));
    }

    // Список категорий
    public function categories()
    {
        $categories = Category::all();
        return view('categories', compact('categories'));
    }

    // Товары в категории
    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        return view('category-products', compact('category', 'products'));
    }

    // Детали товара
    public function showProduct($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product', compact('product'));
    }

    // Добавление товара в корзину
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    // Просмотр корзины
    public function cart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Обновление количества товара в корзине
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $quantity = $request->input('quantity', 1);
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                unset($cart[$id]); // Удаляем, если количество 0
            }
            session()->put('cart', $cart);
        }
        return redirect()->route('cart')->with('success', 'Корзина обновлена!');
    }

    // Удаление товара из корзины
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart')->with('success', 'Товар удалён из корзины!');
    }
}