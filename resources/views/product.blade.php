@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <style>
        .product-container {
            display: flex;
            gap: 2rem;
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .product-details {
            flex: 1;
        }
        .product-details h1 {
            color: #1a3c34;
            margin-bottom: 1rem;
        }
        .product-details p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .product-details .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #f4d03f;
            margin-bottom: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            transition: background 0.3s;
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
        .btn-back {
            background: #1a3c34;
            color: #fff;
        }
        .btn-back:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
            }
        }
    </style>

    <div class="product-container">
        <div class="product-image">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
            @else
                <p>Нет изображения</p>
            @endif
        </div>
        <div class="product-details">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <p>Категория: {{ $product->category->name }}</p>
            <p class="price">{{ $product->price }} руб.</p>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-cart">Добавить в корзину</button>
            </form>
            <a href="{{ route('catalog') }}" class="btn btn-back">Назад к каталогу</a>
        </div>
    </div>
@endsection