// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatable-products').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatable-products').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatable-reservation').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Reservation/get_reservation',
            cache: false,
        },
        columns: [
            { data: 'id_reservation' },
            { data: 'checkin_date' },
            { data: 'checkout_date' },      
            { data: 'id_room' },    
            { data: 'id_guest'}, 
            {
                class: 'center',
                render: function (data, type, row) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_product +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_product +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([2], '#create_product_modal'), // -- Number of columns
        language: {
            url: BASE_URL + 'public/assets/json/languaje-es.json'
        }
    })

    // --
    dataTable.on('xhr', function() {
        // --
        var data = dataTable.ajax.json();
        // --
        functions.toast_message(data.type, data.msg, data.status);
    });
}

// --
function get_categories() {
    // --
    $.ajax({
        url: BASE_URL + 'Categories/get_categories',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // var html = '';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.description +'</option>';
                });
                // -- Set values for select
                $('#create_product_form :input[name=id_category]').html(html);
                $('#update_product_form :input[name=id_category]').html(html);
            }
        }
    })
}

// --
function create_product(form) {
    // Desactivar el botón mientras se guarda el producto
    $('#btn_create_product').prop('disabled', true);

    // Crear un objeto FormData con los datos del formulario
    let params = new FormData(form);

    // Enviar una solicitud AJAX al servidor para guardar el producto
    $.ajax({
        url: BASE_URL + 'Products/create_product',
        type: 'POST',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        success: function(data) {
            // Mostrar un mensaje al usuario
            functions.toast_message(data.type, data.msg, data.status);

            // Si el producto se guardó correctamente, cerrar el modal y actualizar la tabla de productos
            if (data.status === 'OK') {
                $('#create_product_modal').modal('hide');
                form.reset();
                refresh_datatable();
            }

            // Activar el botón después de guardar el producto
            $('#btn_create_product').prop('disabled', false);
        }
    });
}




//--
function update_product(form) {
    // --
    $('#btn_update_product').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Products/update_product',
        type: 'POST',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            functions.toast_message(data.type, data.msg, data.status);
            // --
            if (data.status === 'OK') {
                // --
                $('#update_product_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_update_product').prop('disabled', false);
            }
        }
    })
}

// -- Events

//--
$(document).on('click', '.btn_update', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_product': value}
    // --
    $.ajax({
        url: BASE_URL + 'Products/get_product_by_id',
        type: 'GET',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: true,
        cache: false,
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                let item = data.data
                // --
                $('#update_product_form :input[name=id_product]').val(item.id_product);
                $('#update_product_form :input[name=id_category]').val(item.id_category);
                $('#update_product_form :input[name=description]').val(item.description);
                $('#update_product_form :input[name=stock]').val(item.stock);
                $('#update_product_form :input[name=code]').val(item.code);
                $('#update_product_form :input[name=ts_start]').val(item.ts_start);
                // --
            }
        }
    })
    // --
    $('#update_product_modal').modal('show');
})

// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_product': value}
    // --
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        preConfirm: _ => {
            return $.ajax({
                url: BASE_URL + 'Products/delete_product',
                type: 'POST',
                data: params,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    // --
                    functions.toast_message(data.type, data.msg, data.status);
                    // --
                    if (data.status === 'OK') {
                        // --
                        refresh_datatable();
                    }
                }
            })
        }
    }).then(result => {
        if (result.isConfirmed) {
        }
    });
})


// -- Reset forms
$(document).on('click', '.reset', function() {
    // --
    $('#create_product_form').validate().resetForm();
    $('#update_product_form').validate().resetForm();
})

// -- Validate form
$('#create_product_form').validate({
    // --
    submitHandler: function(form) {
        create_product(form);
    }
})

// -- Validate form
$('#update_product_form').validate({
    // --
    submitHandler: function(form) {
        update_product(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // --
    $('#btn_create_product').prop('disabled', false);
    $('#btn_update_product').prop('disabled', false);
});

//--
get_categories();
//--
load_datatable();