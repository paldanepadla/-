<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeautyGirl - интернет-магазин косметики</title>
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
        .product-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            align-items: center;
            background-color: #ffffff;
        }
        .product-image {
            max-width: 100px;
            height: auto;
            border-radius: 10px;
            margin-right: 20px;
        }
        .product-details {
            flex-grow: 1;
        }
        .product-name {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-price {
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            margin: 0 5px;
            color: #000; /* Черный цвет текста */
        }
        .total-price {
            font-size: 20px;
            font-weight: bold;
            text-align: right;
            color: #007bff;
        }
        .btn-remove {
            margin-top: 10px;
        }
        .footer {
            background-color: #7d82b8; /* Цвет фона подвала */
            color: #ffffff;
        }
        
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateQuantity(productId, quantity) {
            $.ajax({
                url: "{{ route('cart.update') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    quantity: quantity
                },
                success: function(response) {
                    location.reload(); // Reload the page to update the total price and other details
                },
                error: function(error) {
                    console.error('Error updating quantity:', error);
                }
            });
        }

        function incrementQuantity(productId) {
            var input = document.getElementById('quantity-' + productId);
            var value = parseInt(input.value);
            if (!isNaN(value)) {
                input.value = value + 1;
                updateQuantity(productId, value + 1);
            }
        }

        function decrementQuantity(productId) {
            var input = document.getElementById('quantity-' + productId);
            var value = parseInt(input.value);
            if (!isNaN(value) && value > 1) {
                input.value = value - 1;
                updateQuantity(productId, value - 1);
            }
        }
    </script>
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
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                Заказы @if($orderCount > 0) <span class="badge badge-pill badge-danger">{{ $orderCount }}</span> @endif
                            </a>
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
        <h1 class="mb-4">Корзина</h1>
        @foreach ($cartItems as $item)
        <div class="product-card">
            @if ($item['image'])
                <img src="data:image/jpeg;base64,{{ base64_encode($item['image']) }}" alt="Product Image" class="product-image">
            @else
                <img src="https://via.placeholder.com/100" alt="Placeholder Image" class="product-image">
            @endif
            <div class="product-details">
                <div class="product-name">{{ $item['name'] }}</div>
                <div class="product-price">{{ $item['price'] }} тг.</div>
                <div class="quantity-control mt-2">
                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity({{ $item['product_id'] }})">-</button>
                    <input type="number" id="quantity-{{ $item['product_id'] }}" name="quantity" class="form-control quantity-input" value="{{ $item['quantity'] }}" min="1" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity({{ $item['product_id'] }})">+</button>
                </div>
                <form action="{{ route('cart.remove') }}" method="POST" class="form-inline mt-2">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                    <button type="submit" class="btn btn-danger btn-remove">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach    
        @if (count($cartItems) > 0)
            <div class="mt-4">
                <strong>Общая сумма: {{ $totalPrice }} тг.</strong>
            </div>
            <form action="{{ route('cart.clear') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-warning btn-danger">Очистить корзину</button>
            </form>
            <form action="{{ route('cart.checkout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-success">Заказать</button>
            </form>
        @else
            <p>Ваша корзина пуста.</p>
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
            <script>
            function checkout() {
            $.ajax({
            url: "{{ route('cart.checkout') }}",
            method: 'POST',
            data: {
            _token: '{{ csrf_token() }}'
            },
            success: function(response) {
            // Покажем уведомление
            alert(response.message);
            },
            error: function(error) {
            console.error('Error processing checkout:', error);
            }
            });
            }
            </script>
</body>
</html>
