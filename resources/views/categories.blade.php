@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <style>
        .categories-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }
        .category-card {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s;
        }
        .category-card:hover {
            transform: translateY(-5px);
        }
        .category-card a {
            color: #1a3c34;
            text-decoration: none;
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        .category-card a:hover {
            color: #f4d03f;
        }
    </style>

    <h1>Категории товаров</h1>
    <div class="categories-container">
        @foreach ($categories as $category)
            <div class="category-card">
                <a href="{{ route('category.products', $category->id) }}">{{ $category->name }}</a>
            </div>
        @endforeach
    </div>
@endsection