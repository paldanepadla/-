<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('https://www.transparenttextures.com/patterns/paper.png');
            font-family: 'Montserrat', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 20px;
            border: 2px solid #ccc;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #ff70a6;
            box-shadow: none;
        }
        .btn-primary {
            margin-top: 20px;
            background-color: #ff70a6;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
            margin-left: 70px;
        }
        .btn-primary:hover {
            background-color: #7d82b8;
        }
        .right-column {
            background-image: linear-gradient(to right, #ff70a6, #7d82b8);
            font-family: 'Arial', sans-serif;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 30px;
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 426.7px;
        }
        .store-name {
            font-weight: bold;
            color: #ffffff;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }
        .alert {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card">
            <h1>Вход</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" class="form-control">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Войти</button>
                </div>
            </form>
            <a href="{{ route('register') }}" class="register-link">Нет аккаунта? Зарегистрируйтесь здесь</a>
        </div>
        <div class="right-column">
            <div class="store-name">BEAUTYGIRL</div>
        </div>
    </div>
</body>
</html>
