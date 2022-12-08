// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatable-permissions').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatable-permissions').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    // --
    let dataTable = $('#datatable-permissions').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Permissions/get_permissions',
            cache: false,
        },
        columns: [
            { data: 'description' },
            {
                class: 'center',
                render: function (data, type, row, meta) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([0,1,2], '#create_permission_modal'), // -- Number of columns
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
function create_permission(form) {
    // --
    $('#btn_create_permission').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Permissions/create_permission',
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
                $('#create_permission_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_create_permission').prop('disabled', false);
            }
        }
    })
}

// --
function update_permission(form) {
    // --
    $('#btn_update_permission').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Permissions/update_permission',
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
                $('#update_permission_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_update_permission').prop('disabled', false);
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
    // -- Get data for register
    let params = {'id_permission': value}
    // --
    $.ajax({
        url: BASE_URL + 'Permissions/get_permission',
        type: 'GET',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: true,
        cache: false,
        success: function(data) {
            // --
            //functions.toast_message(data.type, data.msg, data.status);
            // --
            if (data.status === 'OK') {
                // --
                let item = data.data[0] // -- First
                // --
                $('#update_permission_form :input[name=id_permission]').val(item.id);
                $('#update_permission_form :input[name=description]').val(item.description);
            }
        }
    })
    // --
    $("#update_permission_modal").modal('show');
})


// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_permission': value}
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
                url: BASE_URL + 'Permissions/delete_permission',
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
    $('#create_permission_form').validate().resetForm();
    $('#update_permission_form').validate().resetForm();
})

// -- Validate form
$('#create_permission_form').validate({
    // --
    submitHandler: function(form) {
        create_permission(form);
    }
})

// -- Validate form
$('#update_permission_form').validate({
    // --
    submitHandler: function(form) {
        update_permission(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // -- Enable buttons
    $('#btn_create_permission').prop('disabled', false);
    $('#btn_update_permission').prop('disabled', false);
});


// -- Load
load_datatable();