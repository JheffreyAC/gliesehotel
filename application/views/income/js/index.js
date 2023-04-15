// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatable-income').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatable-income').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatable-income').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Income/get_income',
            cache: false,
        },
        columns: [
            { data: 'proof_date' },
            { data: 'business_name' },
            { data: 'first_name' },         
            { data: 'vt_description' } ,   
            { 
                class: 'center',
                render: function (data, type, row, meta) {
                    // --
                    return (
                        row.proof_series + ' - ' + row.voucher_series
                    );
                }  
            },
            { data: 'full_purchase' },   
            {
                class: 'center',
                render: function (data, type, row, meta) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_income +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_income +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([8], '#create_income_modal', false), // -- Number of columns
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

//--
function update_income(form) {
    // --
    $('#btn_update_income').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Incoome/update_income',
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
                $('#update_income_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_update_income').prop('disabled', false);
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
    let params = {'id_income': value}
    // --
    $.ajax({
        url: BASE_URL + 'Income/get_income_by_id',
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
                $('#update_income_form :input[name=id_income]').val(item.id_income);
                $('#update_income_form :input[name=id_category]').val(item.id_category);
                $('#update_income_form :input[name=description]').val(item.description);
                $('#update_income_form :input[name=stock]').val(item.stock);
                $('#update_income_form :input[name=code]').val(item.code);
                // --
            }
        }
    })
    // --
    $('#update_income_modal').modal('show');
})

// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_income': value}
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
                url: BASE_URL + 'Income/delete_income',
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

// -- Redirect new controller
$(document).on('click', '.create-new', function() {
    // --
    window.location.assign(BASE_URL + 'Income_Details');
})

// -- Reset forms
$(document).on('click', '.reset', function() {
    // --
    $('#update_income_form').validate().resetForm();
})



// -- Validate form
$('#update_income_form').validate({
    // --
    submitHandler: function(form) {
        update_income(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // --
    $('#btn_update_income').prop('disabled', false);
});




//--
load_datatable();