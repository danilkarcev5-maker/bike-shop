<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Публичные маршруты
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');
Route::get('/categories', [HomeController::class, 'categories'])->name('categories');
Route::get('/category/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');
Route::get('/product/{id}', [HomeController::class, 'showProduct'])->name('product.show');

// Корзина
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::post('/cart/add/{id}', [HomeController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [HomeController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [HomeController::class, 'removeFromCart'])->name('cart.remove');

// Авторизация
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Админ-панель
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('categories', CategoryController::class, ['names' => [
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'destroy' => 'admin.categories.destroy',
    ]])->except(['show', 'edit', 'update']);
    Route::resource('products', ProductController::class, ['names' => [
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'destroy' => 'admin.products.destroy',
    ]])->except(['show', 'edit', 'update']);
});