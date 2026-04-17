@extends('layouts.app')

@section('title', 'Товары')

@section('content')
    <style>
        .container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        h1 {
            color: #1a3c34;
            margin-bottom: 1.5rem;
        }
        .add-btn {
            display: inline-block;
            background: #1a3c34;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: background 0.3s;
        }
        .add-btn:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
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
        img {
            border-radius: 5px;
        }
        .delete-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .delete-btn:hover {
            background: #c0392b;
        }
    </style>

    <div class="container">
        <h1>Товары</h1>
        <a href="{{ route('admin.products.create') }}" class="add-btn">Добавить товар</a>
        @if ($products->isEmpty())
            <p>Товаров пока нет.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Фото</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->price }} руб.</td>
                            <td>
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" width="50" alt="{{ $product->name }}">
                                @else
                                    Нет фото
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn" onclick="return confirm('Вы уверены?');">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection