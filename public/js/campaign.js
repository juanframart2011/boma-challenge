/**
 * ===================================
 *    campaign Description Editor 
 * ===================================
*/
var quill = new Quill('#description', {
    modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['image', 'code-block']
        ]
    },
    placeholder: 'Descripción de la campaña...',
    theme: 'snow'  // or 'bubble'
});


/**
 * ====================
 *      File Pond 
 * ====================
*/

// We want to preview images, so we register
// the Image Preview plugin, We also register 
// exif orientation (to correct mobile image
// orientation) and size validation, to prevent
// large files from being added
FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginImageExifOrientation,
    FilePondPluginFileValidateSize,
    // FilePondPluginImageEdit
);

const imageField = FilePond.create(document.getElementById('image'), {
    allowMultiple: false,
    maxFileSize: '3MB'
});

// Validación y envío del formulario
$('#campaign-form').submit(function (e) {

    e.preventDefault();
    submitcampaignForm(imageField);
});

function validateForm() {
    let errors = [];

    let name = $('#name').val().trim();
    let description = $('#description').text().trim();
    let presupuesto = $('#presupuesto').val().trim();
    let fecha = $('#fecha').val().trim();
    
    if (name === '') errors.push("El nombre del campaigno es obligatorio.");
    if (description === '') errors.push("La descripción es obligatoria.");
    if (presupuesto === '' || isNaN(presupuesto) || presupuesto <= 0) errors.push("El presupuesto debe ser un número válido.");
    if (fecha === '') errors.push("El fecha es obligatorio.");

    if (!imageField.getFiles().length) {
        errors.push("La imagen principal es obligatoria.");
    }

    return errors;
}

function submitcampaignForm(imageField) {

    let errors = validateForm(imageField);
    
    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: errors.join('<br>'),
        });
        return;
    }

    let formData = new FormData();

    formData.append('_method', $('#campaign-form').attr( "method" ));

    formData.append('name', $('#name').val());
    formData.append('description', $('#description').text());
    formData.append('fecha', $('#fecha').val());    
    formData.append('presupuesto', $('#presupuesto').val());
    formData.append('active', $('#active').is(':checked') ? 1 : 0);

    if( $('#campaign-form').attr( "method" ) == 'post' ){

        if (imageField.getFiles().length > 0) {
            formData.append('image', imageField.getFile().file);
        }
    }
    else{

        if( imageField.getFiles()[0].file instanceof File ){
            
            formData.append('image', imageField.getFiles()[0].file);
        }
    }

    $.ajax({
        url: $('#campaign-form').attr( "action" ), // Ajusta la URL según tu ruta en Laravel
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
                window.location.href = baseUrl + '/admin/campaign/list';
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