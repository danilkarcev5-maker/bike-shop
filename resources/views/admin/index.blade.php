@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
    <style>
        .admin-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        h1 {
            color: #1a3c34;
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }
        .admin-links {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .admin-links a {
            display: block;
            background: #1a3c34;
            color: #fff;
            padding: 1rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .admin-links a:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
    </style>

    <div class="admin-container">
        <h1>Панель администратора</h1>
        <div class="admin-links">
            <a href="{{ route('admin.categories.index') }}">Управление категориями</a>
            <a href="{{ route('admin.products.index') }}">Управление товарами</a>
        </div>
    </div>
@endsection