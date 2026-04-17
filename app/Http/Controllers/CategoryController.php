<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Список категорий
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Показать форму создания
    public function create()
    {
        return view('admin.categories.create');
    }

    // Сохранение новой категории
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Категория добавлена.');
    }

    // Удаление категории
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена.');
    }
}