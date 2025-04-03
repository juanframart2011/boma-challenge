/**
 * ===================================
 *    Product Description Editor 
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
    placeholder: 'Descripción del producto...',
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

const galleryField = FilePond.create(document.getElementById('images'), {
    allowMultiple: true,
    maxFiles: 5,
    maxFileSize: '3MB'
});

/**
 * =====================
 *      Product Tags 
 * =====================
*/
// The DOM element you wish to replace with Tagify
var input = document.querySelector('.product-tags');

// initialize Tagify on the above input node reference
var tagsTagify = new Tagify(input)

// Validación y envío del formulario
$('#product-form').submit(function (e) {

    e.preventDefault();
    submitProductForm(imageField, galleryField);
});

function validateForm() {
    let errors = [];

    let name = $('#name').val().trim();
    let description = $('#description').text().trim();
    let priceSale = $('#price_sale').val().trim();
    let pricePurchase = $('#price_purchase').val().trim();
    let categoryId = $('#category_id').val();
    let code = $('#code').val().trim();
    let sku = $('#sku').val().trim();
    
    if (name === '') errors.push("El nombre del producto es obligatorio.");
    if (description === '') errors.push("La descripción es obligatoria.");
    if (priceSale === '' || isNaN(priceSale) || priceSale <= 0) errors.push("El precio de venta debe ser un número válido.");
    if (pricePurchase === '' || isNaN(pricePurchase) || pricePurchase <= 0) errors.push("El precio de compra debe ser un número válido.");
    if (categoryId === '') errors.push("Debe seleccionar una categoría.");
    if (code === '') errors.push("El código es obligatorio.");
    if (sku === '') errors.push("El SKU es obligatorio.");

    if (!imageField.getFiles().length) {
        errors.push("La imagen principal es obligatoria.");
    }

    return errors;
}

function submitProductForm(imageField, galleryField) {

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

    formData.append('_method', $('#product-form').attr( "method" ));

    formData.append('name', $('#name').val());
    formData.append('description', $('#description').text());

    formData.append('code', $('#code').val());
    formData.append('sku', $('#sku').val());
    
    var tagsArry = [];
    for( let t = 0; t < tagsTagify.value.length; t++){

        tagsArry.push( tagsTagify.value[t].value );
    }
    
    formData.append('tags', JSON.stringify(tagsArry));

    formData.append('price_sale', $('#price_sale').val());
    formData.append('price_purchase', $('#price_purchase').val());
    formData.append('category_id', $('#category_id').val());
    formData.append('is_visible', $('#is_visible').is(':checked') ? 1 : 0);
    formData.append('in_stock', $('#in_stock').is(':checked') ? 1 : 0);
    formData.append('include_taxes', $('#include_taxes').is(':checked') ? 1 : 0);

    if( $('#product-form').attr( "method" ) == 'post' ){

        if (imageField.getFiles().length > 0) {
            formData.append('image', imageField.getFile().file);
        }

        // Agregar imágenes de la galería
        let galleryFiles = galleryField.getFiles();
        for (let i = 0; i < galleryFiles.length; i++) {
            formData.append('gallery[]', galleryFiles[i].file);
        }
    }
    else{

        if( imageField.getFiles()[0].file instanceof File ){
            
            formData.append('image', imageField.getFiles()[0].file);
        }

        let galleryFiles = galleryField.getFiles();
        
        galleryFiles.forEach(file => {
            if( !existingImages.includes( file.source ) ){

                // **Si la imagen es nueva, la subimos**
                formData.append('gallery[]', file.file);
            }
        });

        // **Enviar imágenes eliminadas**
        formData.append('deleted_images', JSON.stringify(imagesToDelete));
    }

    $.ajax({
        url: $('#product-form').attr( "action" ), // Ajusta la URL según tu ruta en Laravel
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
                window.location.href = baseUrl + '/admin/products/list';
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