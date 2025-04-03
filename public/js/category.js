// ValCategory y envío del formulario
$('#category-form').submit(function (e) {

    e.preventDefault();
    submitCategoryForm();
});

function validateForm() {
    let errors = [];

    let name = $('#name').val().trim();
    let code = $('#code').val().trim();
    
    if (name === '') errors.push("El nombre de la categoría es obligatorio.");
    if (code === '') errors.push("El código es obligatorio.");
    
    return errors;
}

function submitCategoryForm() {

    let errors = validateForm();
    
    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: errors.join('<br>'),
        });
        return;
    }

    let formData = new FormData();

    formData.append('_method', $('#category-form').attr( "method" ));

    formData.append('name', $('#name').val());
    formData.append('code', $('#code').val());
    
    $.ajax({
        url: $('#category-form').attr( "action" ), // Ajusta la URL según tu ruta en Laravel
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        beforeSend: function () {
            Swal.fire({
                title: 'Guardando...',
                text: 'Por favor espera...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: response.message,
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = baseUrl + '/admin/category/list';
            });
        },
        error: function (xhr) {
            let errorMessage = 'Ocurrió un error inesperado.';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
            }
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: errorMessage,
            });
        }
    });
}