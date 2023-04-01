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
    let dataTable = $('#datatable-products').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Products/get_products',
            cache: false,
        },
        columns: [
            { data: 'code' },
            { data: 'category' },
            { data: 'description' },      
            { data: 'stock' },    
            { data: 'expiration_date' },
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
    // --
    $('#btn_create_product').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Products/create_product',
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
                $('#create_product_modal').modal('hide');
                form.reset();
                refresh_datatable();
        
                // Obtener la fecha de expiración de la base de datos
                let productId = data.id; // El ID del producto recién creado
                $.get(BASE_URL + 'Products/get_product/' + productId, function(product) {
                    let expirationDate = new Date(product.expiration_date);
                    let currentDate = new Date();
                    let timeDiff = expirationDate.getTime() - currentDate.getTime();
        
                    // Calcular la nueva fecha de expiración en 30 días
                    let newExpirationDate = new Date(currentDate);
                    newExpirationDate.setDate(newExpirationDate.getDate() + 30);
        
                    // Calcular la diferencia en días entre la nueva fecha de expiración y la fecha actual
                    timeDiff = newExpirationDate.getTime() - currentDate.getTime();
                    let daysUntilExpiration = Math.ceil(timeDiff / (1000 * 3600 * 24));
        
                    // Crear un objeto de notificación y agregarlo a la lista de notificaciones
                    let notification = {
                        title: 'Producto próximo a expirar',
                        message: `El producto expira en ${daysUntilExpiration} días el ${newExpirationDate.toLocaleDateString()}.`
                    };
        
                    // Para evitar toda esta logica :v tenian que hacer un query, mas naaaaaa
                    // -- Ese dia les mencione que tenian que hacer su función, por rango de fechas
                    // para evitar toda esta logica, es dms codigo
                    // PAra ello, supoooooooooooongo que guardan la fecha en timestamp (int) 
                    /* Comprobando si daysUntilExpiration es menor o igual a 30 y mayor que
                    0. Si es así, agregará daysUntilExpiration al mensaje. si es igual
                    a 0, cambiará el título a 'Producto expirado' y agregará '(hoy)' al
                    mensaje. También agregará la clase 'text-danger' al elemento de notificación. */
                    if (daysUntilExpiration <= 30 && daysUntilExpiration > 0) {
                        notification.message += ` (${daysUntilExpiration} días restantes)`;
                    } else if (daysUntilExpiration === 0) {
                        notification.title = 'Producto expirado';
                        notification.message += ' (hoy)';
                        notificationItem.addClass('text-danger');
                    }
        
                    // Crear un nuevo elemento de notificación y agregarlo al menú desplegable de notificaciones. //
                    let notificationItem = $('<a>').addClass('d-flex justify-content-between align-items-start dropdown-item').attr('href', '#').append(
                        $('<div>').addClass('media').append(
                            $('<div>').addClass('media-body').append(
                                $('<h6>').addClass('notification-text mb-0').text(notification.title),
                                $('<small>').addClass('text-muted').text(notification.message)
                            ),
                            $('<div>').addClass('notification-icon d-flex align-items-center justify-content-center me-50').append(
                                $('<i>').addClass('feather icon-alert-circle font-medium-5')
                            )
                        )
                    );

                    // |CURSOR_MARCADOR| - ROJO //
                    if (daysUntilExpiration === 0) {
                        notificationItem.addClass('text-danger');
                    }
        
                    // Anteponer el elemento de notificación a la lista de notificaciones. //
                    $('#notification-list').prepend(notificationItem);
        
                    // Actualizar el contador de notificaciones y el badge de la barra de navegación
                    let notificationCount = $('#notification-list a').length;
                    $('#new-notifications-count').text(notificationCount);
                    $('#notification-badge').text(notificationCount);
                });
            } else {
                // --
                $('#btn_create_product').prop('disabled', false);
            }
        }
        
    });
}

//--
function showAddExpirationDate(select) {
    var expirationDate = document.getElementById("expiration_date");
    if (select.value == 1) {
      expirationDate.style.display = "block";
      expirationDate.innerHTML = '<div><label class="form-label">Fecha de expiración</label><input type="date" name="expiration_date" class="form-control" data-msg="" /></div>';
    } else if (select.value == 0) {
      expirationDate.style.display = "block";
      expirationDate.innerHTML = '<div><label class="form-label">NO EXPIRA</label><input type="hidden" name="expiration_date" value="WITHOUT EXPIRATION" /></div>';
    } else {
      expirationDate.style.display = "none";
    }
  }

  function showUpdateExpirationDate(select) {
    var expirationDate = document.getElementById("update_expiration_date");
    if (select.value == 1) {
        expirationDate.style.display = "block";
        expirationDate.innerHTML = '<div><label class="form-label">Fecha de expiración</label><input type="date" name="expiration_date" class="form-control" data-msg="" /></div>';
    } else if (select.value == 0) {
        expirationDate.style.display = "block";
        expirationDate.innerHTML = '<div><label class="form-label">NO EXPIRA</label><input type="hidden" name="expiration_date" value="WITHOUT EXPIRATION" /></div>';
    } else {
        expirationDate.style.display = "none";
    }
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
                $('#update_product_form :input[name=expiration_date]').val(item.expiration_date);
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