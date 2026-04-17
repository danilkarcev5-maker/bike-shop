<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Велотехника - @yield('title')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        body {
            background: #f4f7f6;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background: #1a3c34;
            padding: 1rem 2rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        nav {
            max-width: 1400px; /* Увеличили ширину контейнера */
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav a, nav button {
            color: #fff;
            text-decoration: none;
            margin: 0 1.5rem; /* Больше пространства между ссылками */
            font-size: 1.1rem; /* Чуть крупнее шрифт */
            transition: color 0.3s;
        }
        nav a:hover, nav button:hover {
            color: #f4d03f;
        }
        nav button {
            background: none;
            border: none;
            cursor: pointer;
        }
        main {
            max-width: 1400px; /* Увеличили ширину основного контента */
            margin: 2rem auto;
            padding: 0 1rem;
            flex: 1;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 5px;
        }
        .alert.success {
            background: #d4edda;
            color: #155724;
        }
        .alert.error {
            background: #f8d7da;
            color: #721c24;
        }
        footer {
            background: #1a3c34;
            color: #fff;
            padding: 3rem 2rem; /* Увеличили отступы сверху и снизу */
            box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
        }
        .footer-container {
            max-width: 1400px; /* Увеличили ширину контейнера */
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 3rem; /* Увеличили расстояние между блоками */
        }
        .footer-section {
            flex: 1;
            min-width: 300px; /* Увеличили минимальную ширину блоков */
            padding: 0 1rem; /* Добавили внутренние отступы по бокам */
        }
        .footer-section h3 {
            color: #f4d03f;
            margin-bottom: 1.5rem; /* Больше пространства под заголовком */
            font-size: 1.4rem; /* Чуть крупнее шрифт */
        }
        .footer-section p, .footer-section a {
            color: #fff;
            font-size: 1rem; /* Увеличили шрифт текста */
            margin-bottom: 0.75rem; /* Больше пространства между строками */
            text-decoration: none;
            transition: color 0.3s;
        }
        .footer-section a:hover {
            color: #f4d03f;
        }
        .footer-bottom {
            margin-top: 2rem; /* Увеличили отступ сверху */
            font-size: 0.9rem; /* Чуть крупнее шрифт */
            color: #ccc;
        }
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                text-align: center;
            }
            nav a, nav button {
                margin: 0.75rem 0;
            }
            .footer-container {
                flex-direction: column;
                text-align: center;
            }
            .footer-section {
                min-width: 100%; /* На мобильных устройствах блоки на всю ширину */
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div>
                <a href="{{ route('home') }}">Главная</a>
                <a href="{{ route('catalog') }}">Каталог</a>
                <a href="{{ route('categories') }}">Категории</a>
                <a href="{{ route('cart') }}">Корзина</a>
            </div>
            <div>
                @auth
                    @if (Auth::user()->isAdmin())
                        <a href="{{ route('admin.index') }}">Админ-панель</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Войти</a>
                    <a href="{{ route('register') }}">Регистрация</a>
                @endauth
            </div>
        </nav>
    </header>
    <main>
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>О нас</h3>
                <p>Магазин велотехники — ваш надёжный партнёр для активного отдыха и спорта.</p>
            </div>
            <div class="footer-section">
                <h3>Навигация</h3>
                <a href="{{ route('home') }}">Главная</a>
                <a href="{{ route('catalog') }}">Каталог</a>
                <a href="{{ route('categories') }}">Категории</a>
                <a href="{{ route('cart') }}">Корзина</a>
            </div>
            <div class="footer-section">
                <h3>Контакты</h3>
                <p>Email: info@bike-shop.ru</p>
                <p>Телефон: +7 (123) 456-78-90</p>
                <p>Адрес: г. Велоград, ул. Спортивная, 10</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© {{ date('Y') }} Велотехника. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>