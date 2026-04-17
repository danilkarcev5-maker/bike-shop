@extends('layouts.app')

@section('title', 'Товары в категории')

@section('content')
    <style>
        .products-grid {
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
    </style>

    <h1>Товары в категории: {{ $category->name }}</h1>
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
    <div class="pagination">
        {{ $products->links() }}
    </div>
@endsection