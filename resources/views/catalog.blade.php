@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    <style>
        .catalog-container {
            display: flex;
            gap: 3rem; /* Увеличен зазор между sidebar и products-grid */
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem; /* Добавлены внешние отступы слева и справа */
            width: 90%; /* Ограничение ширины для центрирования */
        }
        .sidebar {
            flex: 1;
            background: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            min-width: 250px;
            margin-left: 1rem; /* Отодвигаем влево внутри контейнера */
        }
        .sidebar h3 {
            color: #1a3c34;
            margin-bottom: 1.5rem;
            font-size: 1.4rem;
            text-align: center;
            border-bottom: 2px solid #f4d03f;
            padding-bottom: 0.5rem;
        }
        .category-list {
            list-style: none;
        }
        .category-item {
            margin-bottom: 1rem;
        }
        .category-item a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            background: #f9f9f9;
            border-radius: 5px;
            color: #1a3c34;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .category-item a:hover {
            background: #1a3c34;
            color: #f4d03f;
            transform: translateX(5px);
        }
        .category-item a i {
            margin-right: 0.5rem;
        }
        .products-grid {
            flex: 3;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        .product-card {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .product-card h3 {
            color: #1a3c34;
            margin: 0.5rem 0;
        }
        .product-card p {
            font-size: 0.9rem;
            color: #666;
        }
        .product-card .price {
            font-weight: bold;
            color: #f4d03f;
            margin: 0.5rem 0;
        }
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
        .btn-details {
            background: #1a3c34;
            color: #fff;
        }
        .btn-details:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
        .btn-cart {
            background: #f4d03f;
            color: #1a3c34;
            border: none;
            cursor: pointer;
        }
        .btn-cart:hover {
            background: #1a3c34;
            color: #fff;
        }
        .pagination {
            margin-top: 2rem;
            text-align: center;
        }
        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            border-radius: 5px;
            text-decoration: none;
            color: #1a3c34;
        }
        .pagination a:hover {
            background: #f4d03f;
            color: #fff;
        }
        .pagination .current {
            background: #1a3c34;
            color: #fff;
        }
        @media (max-width: 768px) {
            .catalog-container {
                flex-direction: column;
            }
            .sidebar {
                min-width: 100%;
                margin-left: 0; /* Убираем отступ на мобильных */
            }
        }
    </style>

    <h1>Каталог товаров</h1>
    <div class="catalog-container">
        <div class="sidebar">
            <h3>Категории</h3>
            <ul class="category-list">
                @foreach ($categories as $category)
                    <li class="category-item">
                        <a href="{{ route('category.products', $category->id) }}">
                            <i class="fas fa-bicycle"></i> {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                    @endif
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 50) }}</p>
                    <p class="price">{{ $product->price }} руб.</p>
                    <a href="{{ route('product.show', $product->id) }}" class="btn btn-details">Подробнее</a>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-cart">В корзину</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection