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
        .product-heading {
            text-align: center; /* Выравнивание по центру */
            font-size: 32px; /* Размер шрифта */
            margin-top: 50px; /* Отступ сверху */
            margin-bottom: 30px; /* Отступ снизу */
            color: #333; /* Цвет текста */
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
            border: 1px solid #ccc;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Разделяем содержимое и кнопку */
            transition: all 0.3s ease; /* Плавный переход для карточек */
        }

        .product-card:hover {
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1); /* Тень при наведении */
            transform: translateY(-5px); /* Небольшое поднятие при наведении */
        }

        .product-image {
            height: 300px;
            width: 100%;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
            transition: all 0.3s ease; /* Плавный переход для изображений */
        }

        .product-details {
            padding: 20px;
            flex-grow: 1; /* Заставляем содержимое растягиваться */
        }

        .product-price {
            font-weight: bold;
            color: #7d82b8; /* Цвет цены продукта */
        }

        .btn-buy {
            margin-top: auto; /* Автоматическое выравнивание кнопки по нижнему краю */
            background-color: #7d82b8; /* Яркая кнопка */
            color: #fff;
            border: none;
            transition: background-color 0.3s ease; /* Плавный переход для кнопки */
        }

        .btn-buy:hover, .btn-buy:focus {
            background-color: #5e6180; /* Темный оттенок при наведении */
        }

        .carousel-inner img {
            width: 100%;
            height: 400px; /* Высота изображений в слайдере */
            object-fit: cover;
        }

        .footer {
            background-color: #7d82b8; /* Цвет фона подвала */
            color: #ffffff;
        }
        #notification-list {
            max-height: 300px;
            overflow-y: auto;
            padding: 15px; /* Больше отступов */
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Тень */
        }
        #notificationModal .modal-dialog {
            position: absolute;
            right: 190px;
            top: 30px; /* измените значение, если нужно сместить вверх/вниз */
        }

        #notification-icon.text-white {
            color: white !important;
        }

        .list-group-item {
            padding: 15px; /* Больше отступов */
            border: none;
            border-bottom: 1px solid #eee; /* Разделительные линии между элементами */
            transition: background-color 0.3s ease; /* Плавный переход цвета фона */
        }

        .list-group-item:last-child {
            border-bottom: none; /* Убираем разделительную линию у последнего элемента */
        }

        .list-group-item:hover {
            background-color: #f5f5f5; /* Изменяем цвет фона при наведении */
        }

    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffb6c1; /* Изменение цвета фона шапки */">
            <div class="container">
                <a class="navbar-brand" href="{{ route('products.index') }}" style="color: #ffffff; /* Белый цвет текста */">BeautyGirl</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="color: #ffffff; /* Белый цвет значка переключателя */"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <!-- Отображение элементов навигации -->
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cart.index') }}" style="color: #ffffff;"> <!-- Белый цвет ссылок -->
                                    Корзина @if($cartItemCount > 0) <span class="badge badge-pill badge-danger">{{ $cartItemCount }}</span> @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('orders.index') }}" style="color: #ffffff;">
                                    Заказы @if($orderCount > 0) <span class="badge badge-pill badge-danger">{{ $orderCount }}</span> @endif
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #ffffff;">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('user.edit', ['id' => Auth::user()->id]) }}">Редактировать профиль</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Выход</button>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="notification-icon-container" style="color: #ffffff;">
                                    <i class="fas fa-bell" id="notification-icon"></i>
                                </a>
                            </li>                            
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="color: #ffffff;">Вход</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="2000">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" ></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="https://sun9-33.userapi.com/impf/Mdim1OCMs6rgPC8gS3MdBcpM3GFQcE-83JM3fA/LQtn57o8SgI.jpg?size=1920x768&quality=95&crop=0,0,1920,767&sign=2f52a4508f1caac76d14140f109018bf&type=cover_group" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://sun9-75.userapi.com/impf/uxytS-VgU-vU2fBm42R24qB_R6Av5c_9R_ngbw/OIOb8T5FIBo.jpg?size=1920x768&quality=95&crop=0,0,1326,530&sign=f27ef4657379afa8074fe1c65c2f10b1&type=cover_group" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="https://sun9-7.userapi.com/impf/jZlmdCMB3fKJM2OXyjMOXZ0B0d-lBYDGHgRfPg/hH4BncAOUS4.jpg?size=1920x768&quality=95&crop=0,52,1500,599&sign=afc699be5178235df25b4dabea5efe85&type=cover_group" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <main class="main-content">
        <div class="container">
            <h2 class="product-heading"></h2>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card product-card">
                            @if ($product->image)
                                <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" class="card-img-top product-image" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/300" class="card-img-top product-image" alt="Placeholder">
                            @endif
                            <div class="card-body product-details">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text product-price">{{ $product->price }} тг.</p>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @auth
                                        <button type="submit" class="btn btn-buy">В корзину</button>
                                    @else
                                        <p class="text-danger">Чтобы добавить товар в корзину, необходимо <a href="{{ route('login') }}">войти</a> или <a href="{{ route('register') }}">зарегистрироваться</a>.</p>
                                    @endauth
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
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
    @auth
    <!-- Модальное окно уведомлений -->
    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Уведомления</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="notification-list">
                        <!-- Список уведомлений будет добавлен здесь -->
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    @endauth        
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @auth
    <script>
        // Ваш существующий скрипт
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Document loaded');
            setRedColor(); // Установить красный цвет для иконки уведомлений при входе
    
            // Обработчик клика по иконке уведомлений
            document.getElementById('notification-icon-container').addEventListener('click', function() {
                console.log('Notification icon clicked');
                fetch(notificationListUrl)
                    .then(response => response.json())
                    .then(data => {
                        const notificationList = document.getElementById('notification-list');
                        notificationList.innerHTML = ''; // Очищаем список уведомлений
    
                        data.notifications.forEach(notification => {
                            const listItem = document.createElement('li');
                            listItem.className = 'list-group-item';
                            listItem.textContent = notification.message;
                            notificationList.appendChild(listItem);
                        });
    
                        // Показать всплывающее окно уведомлений
                        $('#notificationModal').modal('show');
                    })
                    .catch(error => {
                        console.error('Ошибка при получении уведомлений:', error);
                    });
            });
    
    
            // Обработчик нажатия на кнопку закрытия модального окна уведомлений
            document.getElementById('closeModalBtn').addEventListener('click', function() {
                console.log('Notification modal closed');
                clearRedColor(); // Убрать красный цвет для иконки уведомлений
            });
    
            function setRedColor() {
                console.log('Setting notification icon color to red');
                document.getElementById('notification-icon').classList.add('text-danger');
            }
    
            function clearRedColor() {
                console.log('Clearing notification icon color');
                document.getElementById('notification-icon').classList.remove('text-danger');
            }
        }); 
    
        // Функция для отображения списка уведомлений
        function openNotificationList() {
            // Реализация открытия списка уведомлений
            console.log('Opening notification list');
        }

        const notificationListUrl = '{{ route('notifications.list') }}';
    </script> 
    <script> 
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            console.log('Notification modal closed');
            clearRedColor(); // Убрать красный цвет для иконки уведомлений
        });
        function clearRedColor() {
        console.log('Clearing notification icon color');
        document.getElementById('notification-icon').classList.remove('text-danger');
        }
    </script> 
    @endauth
    
    

    <script>
        window.addEventListener('load', function() {
            // Находим все карточки
            const productCards = document.querySelectorAll('.product-card');
    
            // Находим самую высокую карточку
            let maxHeight = 0;
            productCards.forEach(function(card) {
                const height = card.offsetHeight;
                if (height > maxHeight) {
                    maxHeight = height;
                }
            });
    
            // Устанавливаем эту высоту для всех карточек
            productCards.forEach(function(card) {
                card.style.height = maxHeight + 'px';
            });
    
            // Находим все кнопки "В корзину"
            const buyButtons = document.querySelectorAll('.btn-buy');
    
            // Находим максимальную высоту среди кнопок "В корзину"
            maxHeight = 0;
            buyButtons.forEach(function(button) {
                const height = button.offsetHeight;
                if (height > maxHeight) {
                    maxHeight = height;
                }
            });
    
            // Устанавливаем эту высоту для всех кнопок "В корзину"
            buyButtons.forEach(function(button) {
                button.style.height = maxHeight + 'px';
            });
        });
    </script>      
        <script>
            $(document).ready(function(){
                $('.carousel').carousel({
                    interval: 3000
                });
            });
            window.addEventListener('load', function() {
                const productCards = document.querySelectorAll('.product-card');
                let maxHeight = 0;
                productCards.forEach(function(card) {
                    const height = card.offsetHeight;
                    if (height > maxHeight) {
                        maxHeight = height;
                    }
                });
                productCards.forEach(function(card) {
                    card.style.height = maxHeight + 'px';
                });
            });
        </script> 
</body>
</html>