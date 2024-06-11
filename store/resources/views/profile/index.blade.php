<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding-top: 50px;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 30px;
            font-size: 18px;
            font-weight: bold;
        }
        h1 {
            color: #343a40;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Panel</h1>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('products.create') }}" class="btn btn-custom btn-success mr-2">Добавить</a>
            <a href="{{ route('products.index1') }}" class="btn btn-custom btn-primary mr-2">Редактировать</a>
            <a href="{{ route('products.delete') }}" class="btn btn-custom btn-danger mr-2">Удалить</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-custom btn-secondary">Выход</button>
            </form>
        </div>
    </div>
</body>
</html>
