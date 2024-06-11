document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const confirmDelete = confirm('Вы уверены, что хотите удалить этот продукт?');
            if (!confirmDelete) {
                event.preventDefault();
            }
        });
    });
});