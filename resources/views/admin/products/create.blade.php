@extends('layouts.app')

@section('title', 'Добавить товар')

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
        input[type="text"], input[type="number"], textarea, select, input[type="file"] {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        textarea {
            resize: vertical;
            height: 100px;
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
        <h1>Добавить товар</h1>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Название</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Цена (руб.)</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
                @error('price')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category_id">Категория</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Выберите категорию</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" id="image" name="image">
                @error('image')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit">Сохранить</button>
        </form>
    </div>
@endsection