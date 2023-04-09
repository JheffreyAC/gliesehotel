// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatable-suppliers').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatable-suppliers').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatable-suppliers').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Suppliers/get_suppliers',
            cache: false,
        },
        columns: [
            { data: 'business_name' },
            { data: 'name' },
            { data: 'document_type' },      
            { data: 'document_number' },    
            { data: 'email' },
            { data: 'phone' },
            { data: 'address' },
            {
                class: 'center',
                render: function (data, type, row) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_supplier +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_supplier +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([7], '#create_supplier_modal'), // -- Number of columns
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
                $('#create_supplier_form :input[name=document_type]').html(html);
                $('#update_supplier_form :input[name=document_type]').html(html);
            }
        }
    })
}


// --
function create_supplier(form) {
    // --
    $('#btn_create_supplier').prop('disabled', true);
    // --
    let params = new FormData(form);
    let documentType = $('#create_supplier_form :input[name=document_type]').find('option:selected').text();
    // --
    params.append('description_document_type', documentType);
    // --
    $.ajax({
        url: BASE_URL + 'Suppliers/create_supplier',
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
                $('#create_supplier_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_create_supplier').prop('disabled', false);
            }
        }
    })
}

// --
function update_supplier(form) {
    // --
    $('#btn_update_supplier').prop('disabled', true);
    // --
    let params = new FormData(form);
    let documentType = $('#update_supplier_form :input[name=document_type]').find('option:selected').text();
    // --
    params.append('description_document_type', documentType);
    // -- 
    $.ajax({
        url: BASE_URL + 'Suppliers/update_supplier',
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
                $('#update_supplier_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_update_supplier').prop('disabled', false);
            }
        }
    })
}


// -- Events

// --
$(document).on('click', '.btn_update', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_supplier': value}
    // --
    $.ajax({
        url: BASE_URL + 'Suppliers/get_supplier_by_id',
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
                $('#update_supplier_form :input[name=id_supplier]').val(item.id_supplier);
                $('#update_supplier_form :input[name=name]').val(item.name);
                $('#update_supplier_form :input[name=document_number]').val(item.document_number);
                $('#update_supplier_form :input[name=address]').val(item.address);
                $('#update_supplier_form :input[name=phone]').val(item.phone);
                $('#update_supplier_form :input[name=business_name]').val(item.business_name);
                $('#update_supplier_form :input[name=email]').val(item.email);
                //--
                $('#update_supplier_form :input[name=document_type]').val(item.id_document_type).trigger('change');
            }
        }
    })
    // --
    $('#update_supplier_modal').modal('show');
})


// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_supplier': value}
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
                url: BASE_URL + 'Suppliers/delete_supplier',
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
    $('#create_supplier_form').validate().resetForm();
    $('#update_supplier_form').validate().resetForm();
})

// -- Validate form
$('#create_supplier_form').validate({
    // --
    submitHandler: function(form) {
        create_supplier(form);
    }
})

// -- Validate form
$('#update_supplier_form').validate({
    // --
    submitHandler: function(form) {
        update_supplier(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // -- Enable buttons
    $('#btn_create_supplier').prop('disabled', false);
    $('#btn_update_supplier').prop('disabled', false);
});

get_document_types();
// --
load_datatable();