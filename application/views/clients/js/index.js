// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatable-clients').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatable-clients').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatable-clients').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Clients/get_clients',
            cache: false,
        },
        columns: [
            { data: 'name' },
            { data: 'document_type' },
            { data: 'document_number' },
            { data: 'phone' },
            { data: 'address' },
            { data: 'email' },
            { data: 'business_name' },    
            {
                class: 'center',
                render: function (data, type, row, meta) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_clients +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_clients +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },    
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([7], '#create_clients_modal'), // -- Number of columns
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
function get_document_types() {
    // --
    $.ajax({
        url: BASE_URL + 'Main/get_document_types',
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
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.description +'</option>';
                });
                // -- Set values for select
                $('#create_clients_form :input[name=document_type]').html(html);
                $('#update_clients_form :input[name=document_type]').html(html);
            }
        }
    })
}


//--
function create_clients(form) {
    // --
    $('#btn_create_clients').prop('disabled', true);
    // --
    let params = new FormData(form);
    let documentType = $('#create_clients_form :input[name=document_type]').find('option:selected').text();
    // --
    params.append('description_document_type', documentType);
    // --
    $.ajax({
        url: BASE_URL + 'Clients/create_clients',
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
                $('#create_clients_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_create_clients').prop('disabled', false);
            }
        }
    })
}

//--
function update_clients(form) {
    // --
    $('#btn_update_clients').prop('disabled', true);
    // --
    let params = new FormData(form);
    let documentType = $('#update_clients_form :input[name=document_type]').find('option:selected').text();
    // --
    params.append('description_document_type', documentType);
    // -- 
    $.ajax({
        url: BASE_URL + 'Clients/update_clients',
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
                $('#update_clients_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_update_clients').prop('disabled', false);
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
    let params = {'id_clients': value}
    // --
    $.ajax({
        url: BASE_URL + 'Clients/get_client_by_id',
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
                $('#update_clients_form :input[name=id_clients]').val(item.id_clients);
                $('#update_clients_form :input[name=name]').val(item.name);
                $('#update_clients_form :input[name=document_number]').val(item.document_number);
                $('#update_clients_form :input[name=address]').val(item.address);
                $('#update_clients_form :input[name=phone]').val(item.phone);
                $('#update_clients_form :input[name=email]').val(item.email);
                $('#update_clients_form :input[name=business_name]').val(item.business_name);
                // --
                $('#update_clients_form :input[name=document_type]').val(item.id_document_type).trigger('change');
            }
        }
    })
    // --
    $('#update_clients_modal').modal('show');
})

// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_clients': value}
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
                url: BASE_URL + 'Clients/delete_clients',
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
    $('#create_clients_form').validate().resetForm();
    $('#update_clients_form').validate().resetForm();
})

// -- Validate form
$('#create_clients_form').validate({
    // --
    submitHandler: function(form) {
        create_clients(form);
    }
})

// -- Validate form
$('#update_clients_form').validate({
    // --
    submitHandler: function(form) {
        update_clients(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // -- Enable buttons
    $('#btn_create_clients').prop('disabled', false);
    $('#btn_update_clients').prop('disabled', false);
});



get_document_types();
//--
load_datatable();
