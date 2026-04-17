@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <style>
        .auth-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            max-width: 400px;
            margin: 0 auto;
        }
        h1 {
            color: #1a3c34;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
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
            width: 100%;
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
        .link {
            text-align: center;
            margin-top: 1rem;
        }
        .link a {
            color: #1a3c34;
            text-decoration: none;
        }
        .link a:hover {
            color: #f4d03f;
        }
    </style>

    <div class="auth-container">
        <h1>Регистрация</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Подтверждение пароля</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <div class="link">
            <a href="{{ route('login') }}">Уже есть аккаунт? Войти</a>
        </div>
    </div>
@endsection