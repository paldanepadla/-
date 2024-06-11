<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список продуктов</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .product-card {
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .product-info {
            margin-bottom: 10px;
        }

        .product-info h3 {
            margin: 0;
            color: #007bff;
            font-size: 1.2rem;
        }

        .product-info p {
            margin: 5px 0;
            color: #666;
        }

        .back-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Список продуктов</h1>
        <div class="products">
            @foreach ($products as $product)
                <div class="product-card" onclick="editProduct({{ $product->id }})">
                    <div class="product-info">
                        <h3>{{ $product->name }}</h3>
                        <p>Цена: {{ $product->price }}</p>
                        <p>Описание: {{ $product->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="back-btn" onclick="window.location.href = '{{ route('profile.index') }}'">Назад</button>
    </div>

    <script>
        function editProduct(productId) {
            window.location.href = '/products/' + productId + '/edit';
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
