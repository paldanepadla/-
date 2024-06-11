<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление продуктов</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Удаление продуктов</h1>
        <ul class="list-group mt-4">
            @foreach ($products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $product->name }}
                    <form id="deleteForm{{ $product->id }}" action="{{ route('products.destroy', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger delete-button" data-product="{{ $product->id }}">Удалить</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <a href="javascript:history.back()" class="btn btn-secondary mt-3">Назад</a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Успешно удалено</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Продукт успешно удален.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload()">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-button').click(function() {
                var productId = $(this).data('product');
                $('#deleteForm' + productId).submit();
                $('#successModal').modal('show');
            });
        });
    </script>
</body>
</html>
