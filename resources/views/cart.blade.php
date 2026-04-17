@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <style>
        .cart-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        h1 {
            color: #1a3c34;
            margin-bottom: 1.5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background: #1a3c34;
            color: #fff;
        }
        td img {
            border-radius: 5px;
        }
        input[type="number"] {
            width: 60px;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }
        .btn-update {
            background: #1a3c34;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .btn-update:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
        .btn-remove {
            background: #e74c3c;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .btn-remove:hover {
            background: #c0392b;
        }
        .total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #f4d03f;
            text-align: right;
        }
        .btn-continue {
            display: inline-block;
            background: #1a3c34;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .btn-continue:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
    </style>

    <div class="cart-container">
        <h1>Корзина</h1>
        @if (empty($cart))
            <p>Ваша корзина пуста.</p>
            <a href="{{ route('catalog') }}" class="btn-continue">Продолжить покупки</a>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $id => $item)
                        <tr>
                            <td>
                                {{ $item['name'] }}
                                @if ($item['image'])
                                    <img src="{{ Storage::url($item['image']) }}" width="50" alt="{{ $item['name'] }}">
                                @endif
                            </td>
                            <td>{{ $item['price'] }} руб.</td>
                            <td>
                                <form action="{{ route('cart.update', $id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0">
                                    <button type="submit" class="btn btn-update">Обновить</button>
                                </form>
                            </td>
                            <td>{{ $item['price'] * $item['quantity'] }} руб.</td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-remove">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="total">Итого: {{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }} руб.</p>
            <a href="{{ route('catalog') }}" class="btn-continue">Продолжить покупки</a>
        @endif
    </div>
@endsection