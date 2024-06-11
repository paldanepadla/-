<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменить информацию о пользователе</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('https://www.transparenttextures.com/patterns/paper.png'); /* Текстура фона */
            font-family: 'Montserrat', sans-serif; /* Шрифт Montserrat для всего текста */
            display: flex; /* Отображение в режиме блока */
            align-items: center; /* Выравнивание по вертикали */
            justify-content: center; /* Выравнивание по горизонтали */
            height: 100vh; /* Высота равна высоте окна браузера */
        }
        .card-container {
            display: flex; /* Отображение в режиме блока */
            align-items: center; /* Выравнивание по вертикали */
            justify-content: center; /* Выравнивание по горизонтали */
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9); /* Прозрачный белый фон карточки */
            padding: 30px; /* Внутренний отступ */
            border-top-left-radius: 10px; /* Скругление верхних углов правой колонки */
            border-bottom-left-radius: 10px; /* Скругление нижних углов правой колонки */                
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Тень карточки */
            max-width: 500px; /* Максимальная ширина карточки */
            width: 100%; /* Ширина карточки на всю доступную ширину */
            display: flex; /* Отображение в режиме блока */
            flex-direction: column; /* Вертикальное расположение элементов */
            align-items: center; /* Выравнивание по вертикали */
            justify-content: center; /* Выравнивание по горизонтали */
        }
        h1 {
            text-align: center; /* Выравнивание заголовка по центру */
            color: #333; /* Цвет заголовка */
            margin-bottom: 30px; /* Отступ снизу */
        }
        label {
            font-weight: bold; /* Жирный шрифт для меток */
        }
        .form-control {
            border-radius: 20px; /* Большее скругление углов полей ввода */
            border: 2px solid #ccc; /* Серая граница полей ввода */
            transition: border-color 0.3s ease; /* Плавное изменение цвета границы */
        }
        .form-control:focus {
            border-color: #ff70a6; /* Изменение цвета границы при фокусе */
            box-shadow: none; /* Убираем тень при фокусе */
        }
        .btn-primary, .btn-secondary {
            margin-top: 20px; /* Отступ между кнопками и остальными элементами */
            background-color: #ff70a6; /* Цвет кнопок */
            color: #fff; /* Цвет текста кнопок */
            border: none; /* Убираем границу у кнопок */
            transition: background-color 0.3s ease; /* Плавное изменение цвета фона кнопок */
        }
        .btn-primary:hover, .btn-secondary:hover {
            background-color: #7d82b8; /* Изменение цвета кнопок при наведении */
        }
        .right-column {
            background-image: linear-gradient(to right, #ff70a6, #7d82b8); /* Градиентный фон */
            font-family: 'Arial', sans-serif; /* Шрифт Arial для шапки */
            border-top-right-radius: 10px; /* Скругление верхних углов правой колонки */
            border-bottom-right-radius: 10px; /* Скругление нижних углов правой колонки */
            padding: 30px; /* Внутренний отступ */
            color: #fff; /* Цвет текста */
            text-align: center; /* Выравнивание текста по центру */
            display: flex; /* Отображение в режиме блока */
            flex-direction: column; /* Вертикальное расположение элементов */
            align-items: center; /* Выравнивание по вертикали */
            justify-content: center; /* Выравнивание по горизонтали */
            height: 75.7%; /* Высота равна высоте карточки */
        }
        .store-name {
            font-weight: bold;
            color: #ffffff; /* Белый цвет текста */
            font-size: 24px;
            text-transform: uppercase; /* Преобразование текста в верхний регистр */
            letter-spacing: 2px;
            margin-bottom: 20px; /* Отступ снизу */
            height: 100%; /* Высота равна высоте карточки */
            display: flex; /* Отображение в режиме блока */
            align-items: center; /* Выравнивание по вертикали */
            justify-content: center; /* Выравнивание по горизонтали */
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card">
            <h1>Изменить информацию о пользователе</h1>
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <label for="address">Адрес:</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <!-- Поле для изменения пароля -->
                <div class="form-group">
                    <label for="password">Новый пароль:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Сохранить</button>
                <a href="{{ route('home') }}" class="btn btn-secondary">Назад</a>
            </form>
        </div>
    </div>
    <div class="right-column">
        <div class="store-name">BEAUTYGIRL</div>
    </div>
</div>
</div>
</div>
</div>
</body>
</html>
