<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать продукт</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-size: 18px;
        }

        button[type="submit"]:hover {
            background-color: #218838;
        }

        .image-container {
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            background-color: #f0f0f0;
            height: 200px;
        }

        .image-container img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
            transition: transform 0.3s ease;
            object-fit: cover; /* Добавлено для корректного отображения изображения */
        }

        .image-container img:hover {
            transform: scale(1.1);
        }

        .image-container input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            z-index: 1;
        }

        .upload-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #555;
            font-size: 40px;
            z-index: 0;
        }

        .upload-icon:hover + input[type="file"] {
            cursor: pointer;
        }

        .upload-icon:hover {
            color: #333;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            font-size: 18px;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Редактировать продукт</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Название:</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}">

            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" value="{{ $product->price }}">

            <label for="description">Описание:</label>
            <textarea id="description" name="description">{{ $product->description }}</textarea>

            <div class="image-container">
                @if ($product->image)
                    <img src="data:image/jpeg;base64,{{ base64_encode($product->image) }}" alt="{{ $product->name }}">
                @else
                    <img src="https://via.placeholder.com/300" class="card-img-top product-image" alt="Placeholder">
                @endif
                <input type="file" id="image" name="image" onchange="previewImage(event)">
                <span class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></span>
            </div>
            
            <button type="submit">Сохранить изменения</button>
        </form>
        <button class="back-button" onclick="window.location.href = '{{ route('products.index1') }}'">Назад</button>
    </div>

    <script>
        // JavaScript для предварительного просмотра загружаемого изображения
        function previewImage(event) {
            var img = document.querySelector('.image-container img');
            img.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>
</html>
