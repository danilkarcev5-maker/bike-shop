@extends('layouts.app')

@section('title', 'Добавить категорию')

@section('content')
    <style>
        .form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #1a3c34;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        button {
            background: #1a3c34;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #f4d03f;
            color: #1a3c34;
        }
        .error {
            color: #e74c3c;
            font-size: 0.9rem;
        }
    </style>

    <div class="form-container">
        <h1>Добавить категорию</h1>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Название категории</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Сохранить</button>
        </form>
    </div>
@endsection