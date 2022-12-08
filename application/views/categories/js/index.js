// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatable-category').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatable-category').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatable-category').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Categories/get_categories',
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
        buttons: functions.custom_buttons_datatable([0], '#create_category_modal'), // -- Number of columns
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
function create_category(form) {
    // --
    $('#btn_create_category').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Categories/create_category',
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
                $('#create_category_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_create_category').prop('disabled', false);
            }
        }
    })
}

// --
function update_category(form) {
    // --
    $('#btn_update_category').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Categories/update_category',
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
                $('#update_category_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_update_campus').prop('disabled', false);
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
    let params = {'id_category': value}
    // --
    $.ajax({
        url: BASE_URL + 'Categories/get_category_by_id',
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
                $('#update_category_form :input[name=id_category]').val(item.id);
                $('#update_category_form :input[name=description]').val(item.description);
            }
        }
    })
    // --
    $('#update_category_modal').modal('show');
})


// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_category': value}
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
                url: BASE_URL + 'Categories/delete_category',
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
    $('#create_category_form').validate().resetForm();
    $('#update_category_form').validate().resetForm();
})

// -- Validate form
$('#create_category_form').validate({
    // --
    submitHandler: function(form) {
        create_category(form);
    }
})

// -- Validate form
$('#update_category_form').validate({
    // --
    submitHandler: function(form) {
        update_category(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // -- Enable buttons
    $('#btn_create_category').prop('disabled', false);
    $('#btn_update_category').prop('disabled', false);
});

// --
load_datatable()