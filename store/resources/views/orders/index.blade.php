<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мои заказы</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f6f6f6; /* Спокойный фон */
            font-family: 'Montserrat', sans-serif; /* Шрифт Montserrat для всего текста */
            background-image: url('https://www.transparenttextures.com/patterns/paper.png'); /* Текстура фона */
        }
        .navbar {
            background: linear-gradient(to right, #ff70a6, #7d82b8); /* Градиентный фон */
            box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1); /* Тень */
            font-family: 'Arial', sans-serif; /* Шрифт Arial для шапки */
        }
        .navbar-brand {
            font-weight: bold;
            color: #ffffff; /* Белый цвет текста */
            font-size: 24px;
            text-transform: uppercase; /* Преобразование текста в верхний регистр */
            letter-spacing: 2px; /* Расстояние между буквами */
        }
        .navbar-toggler-icon {
            color: #ffffff; /* Белый цвет значка переключателя */
        }
        .navbar-nav .nav-link {
            color: #ffffff; /* Белый цвет ссылок */
            font-size: 16px;
            text-transform: uppercase;
            transition: color 0.3s ease, background-color 0.3s ease; /* Плавный переход для цвета текста и фона */
            padding: 8px 16px;
            border-radius: 5px;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link:focus {
            color: #ffb6c1; /* Изменение цвета при наведении */
            background-color: rgba(255, 255, 255, 0.1); /* Легкий фон при наведении */
        }
        .footer {
            background-color: #7d82b8; /* Цвет фона футера */
            color: #ffffff; /* Цвет текста в футере */
        }
        .order-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            background-color: #fff;
        }
        .order-header {
            font-weight: bold;
            color: #333; /* Цвет текста */
        }
        .order-item {
            margin-bottom: 10px;
            color: #333; /* Цвет текста */
        }
        .btn-danger {
            background-color: #c82333; /* Яркая кнопка */
            color: #fff;
            border: none;
            transition: background-color 0.3s ease; /* Плавный переход для кнопки */
        }
        .btn-danger:hover, .btn-danger:focus {
            background-color: #5e6180; /* Темный оттенок при наведении */
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('products.index') }}"style="color: #ffffff;">BeautyGirl</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart.index') }}">Корзина @if($cartItemCount > 0) <span class="badge badge-pill badge-danger">{{ $cartItemCount }}</span> @endif</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Главная</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="container mt-5">
        <h1 class="mb-4">Мои заказы</h1>
        @if (count($orders) > 0)
            @foreach ($orders as $index => $order)
                <div class="order-card">
                    <div class="order-header">Заказ - {{ $order['date'] }}</div>
                    <div class="order-details mt-2">
                        <h5>Товары:</h5>
                        @foreach ($order['items'] as $item)
                            <div class="order-item">
                                <p>{{ $item['name'] }} - {{ $item['quantity'] }} шт. - {{ $item['price'] }} тг.</p>
                            </div>
                        @endforeach
                    </div>
                    <p><strong>Адрес:</strong> {{ $user->address }}</p> <!-- Отображение адреса пользователя -->
                    <form action="{{ route('orders.cancel', $index) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Отменить заказ</button>
                    </form>
                </div>
            @endforeach
        @else
            <p>У вас нет заказов.</p>
        @endif
    </div>
    <footer class="footer mt-5 py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="mb-4">Мы в соцсетях</h4>
                    <!-- Ссылки на социальные сети -->
                    <ul class="list-inline social-icons">
                        <li class="list-inline-item"><a href="https://www.instagram.com/it_college/?hl=en"><i class="fab fa-instagram fa-3x"></i></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="mb-4">Контактная информация</h4>
                    <!-- Адрес и контактная информация -->
                    <p>Адрес: просп. Абая, 52, лит.Г</p>
                    <p>Телефон: +7 (775) 281 89 11</p>
                    <p>Email: info@intc.kz</p>
                </div>
                <div class="col-md-4">
                    <h4 class="mb-4">Оставить отзыв</h4>
                    <form method="POST" action="{{ route('submit_review') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Имя:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user() ? auth()->user()->name : '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user() ? auth()->user()->email : '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message">Сообщение:</label>
                            <textarea class="form-control" id="message" name="message" rows="3" placeholder="Введите ваш отзыв"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>                
            </div>
            <hr>
            <p class="text-center">&copy; 2024 BeautyGirl. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
