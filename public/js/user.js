FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginFileValidateSize,
    // FilePondPluginImageEdit
);

const imageField = FilePond.create(document.getElementById('avatar'), {
    allowMultiple: false,
    maxFileSize: '3MB'
});

// Validación y envío del formulario
$('#user-form').submit(function (e) {

    e.preventDefault();
    submitUserForm();
});

function validateForm() {
    let errors = [];

    let name = $('#name').val().trim();
    let email = $('#email').val().trim();
    let role_id = $('#role_id').val().trim();
    
    if (name === '') errors.push("El nombre del usuario es obligatorio.");
    if (email === '') errors.push("El email es obligatorio.");
    if (role_id === '') errors.push("El rol es obligatorio.");

    if (!imageField.getFiles().length) {
        errors.push("El avatar es obligatorio.");
    }

    if( $('#user-form').attr( "method" ) == 'post' ){

        let password = $('#password').val().trim();
        let repassword = $('#repassword').val().trim();
        
        if (repassword === '') errors.push("Repetir contraseña es obligatorio.");
        if (password === '') errors.push("El password es obligatorio.");
        if (password != repassword) errors.push("La contraseña y repetición de contraseña no son iguales.");
    }
    
    return errors;
}

function submitUserForm() {

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

    formData.append('_method', $('#user-form').attr( "method" ));

    formData.append('name', $('#name').val());
    formData.append('email', $('#email').val());
    formData.append('role_id', $('#role_id').val());

    if( $('#user-form').attr( "method" ) == 'post' ){

        if (imageField.getFiles().length > 0) {
            formData.append('avatar', imageField.getFile().file);
        }

        formData.append('password', $('#password').val() );
        formData.append('repassword', $('#repassword').val() );
    }
    else{

        if( imageField.getFiles()[0].file instanceof File ){
            
            formData.append('avatar', imageField.getFiles()[0].file);
        }
    }
    
    $.ajax({
        url: $('#user-form').attr( "action" ), // Ajusta la URL según tu ruta en Laravel
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
                window.location.href = baseUrl + '/admin/user/list';
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