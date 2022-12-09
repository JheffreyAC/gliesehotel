// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatables-users').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatables-users').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatables-users').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Users/get_users',
            cache: false,
        },
        columns: [
            { data: 'first_name' },
            {
                class: 'center',
                render: function (data, type, row, meta) {
                    // 
                    if (row.active == "1") {
                        return ('<span class="badge rounded-pill badge-light-success" text-capitalized="">Activo</span>');
                    } else {
                        return ('<span class="badge rounded-pill badge-light-secondary" text-capitalized="">Inactivo</span>');
                    }
                }
            },
            {
                class: 'center',
                render: function (data, type, row, meta) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_user +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_user +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([0,1], '#create_user_modal'), // -- Number of columns
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
function get_menu() {
    // --
    $.ajax({
        url: BASE_URL + 'Menu/get_menu',
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
            // functions.toast_message(data.type, data.msg, data.status);
            console.log(data)
            let menu = data.data
            var html_menu = ''
            // --
            html_menu += '<ul class="timeline">'
            // --
            menu.forEach(function(menu, index_menu) {
                // --
                html_menu += `
                    <li class="timeline-item" style="padding-bottom: 1rem;">
                        <span class="timeline-point timeline-point-indicator"></span>
                        <div class="timeline-event">
                            <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                <h6>` + menu.description + `</h6>
                            </div>
                            <div>`
                            // <div style="display:flex;">
                // --
                menu.sub_menu.forEach(function(sub_menu, index_sub_menu) {
                    // --
                    html_menu += `
                        <div class="media align-items-center" style="margin-right: 1.5rem;">
                            <div class="media-body">
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" name="menu[]" value="` + sub_menu.id + `">
                                    <label class="custom-control-label">` + sub_menu.description + `</label>
                                </div>
                            </div>
                        </div>
                    `
                })
                // --
                html_menu += `
                        </div>
                    </div>
                </li>
                `
            })
            // --
            html_menu += '</ul>'
            // --
            $('#create_user_menu').html(html_menu)
        }
    })
}

// --
function get_user_statistics() {
    // --
    $.ajax({
        url: BASE_URL + 'Users/get_user_statistics',
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
            // functions.toast_message(data.type, data.msg, data.status);
            // --
            $('#total_users').text(data.data.total)
            $('#active_users').text(data.data.active)
            $('#inactive_users').text(data.data.inactive)
        }
    })
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
                $('#create_user_form :input[name=document_type]').html(html);
                $('#update_user_form :input[name=document_type]').html(html);
            }
        }
    })
}


// --
function get_campus() {
    // --
    $.ajax({
        url: BASE_URL + 'Campus/get_campus',
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
                var html = '';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.description +'</option>';
                });
                // -- Set values for select
                $('#create_user_form :input[name=campus]').html(html);
                $('#update_user_form :input[name=campus]').html(html);
            }
        }
    })
}

// --
function get_roles() {
    // --
    $.ajax({
        url: BASE_URL + 'Roles/get_roles',
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
                $('#create_user_form :input[name=role]').html(html);
                $('#update_user_form :input[name=role]').html(html);
            }
        }
    })
}


// --
function create_user(form) {
    // --
    $('#btn_create_user').prop('disabled', true);
    // --
    let params = new FormData(form);
    params.append('campus', JSON.stringify($('#create_user_form :input[name=campus]').val()));
    // --
    $.ajax({
        url: BASE_URL + 'Users/create_user',
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
                $('#create_user_modal').modal('hide');
                form.reset();
                refresh_datatable();
                get_user_statistics();

            } else {
                // --
                $('#btn_create_user').prop('disabled', false);
            }
        }
    })
}


// --
function update_user(form) {
    // --
    $('#btn_update_user').prop('disabled', true);
    // --
    let params = new FormData(form);
    params.append('campus', JSON.stringify($('#update_user_form :input[name=campus]').val()));
    // --
    $.ajax({
        url: BASE_URL + 'Users/update_user',
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
                $('#update_user_modal').modal('hide');
                form.reset();
                refresh_datatable();
                get_user_statistics();

            } else {
                // --
                $('#btn_update_user').prop('disabled', false);
            }
        }
    })
}


// --
function get_values_for_checkbox(form, name) {
    // --
    var arrayObjects = new Array();
    // --
    var arrayChecked = $('#'+form+' :input[name="'+name+'[]"]:checked').map(function(){return this.value;}).get();
    var arrayUnchecked = $('#'+form+' :input[name="'+name+'[]"]:unchecked').map(function(){return this.value;}).get();
    // --
    arrayChecked.forEach(function(item, index) {
        arrayObjects.push({id_sub_menu: item, status: 1});
    })
    // --
    arrayUnchecked.forEach(function(item, index) {
        arrayObjects.push({id_sub_menu: item, status: 0});
    })
    // --
    return arrayObjects;
}

// -- Events


// --
$(document).on('click', '.btn_update', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_user': value};
    // --
    $.ajax({
        url: BASE_URL + 'Users/get_user_by_id',
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
                let item_user = data.data.user;
                let item_campus = data.data.campus;
                // --
                $('#update_user_form :input[name=id_user]').val(item_user.id);
                // --
                $('#update_user_form :input[name=first_name]').val(item_user.first_name);
                $('#update_user_form :input[name=last_name]').val(item_user.last_name);
                $('#update_user_form :input[name=document_number]').val(item_user.document_number);
                $('#update_user_form :input[name=address]').val(item_user.address);
                $('#update_user_form :input[name=user]').val(item_user.user);
                $('#update_user_form :input[name=telephone]').val(item_user.telephone);
                $('#update_user_form :input[name=email]').val(item_user.email);
                // --
                $('#update_user_form :input[name=document_type]').val(item_user.id_document_type).trigger('change');
                $('#update_user_form :input[name=role]').val(item_user.id_role).trigger('change');
                $('#update_user_form :input[name=active]').val(item_user.active).trigger('change');

                // --
                var array_campus = [];
                // --
                item_campus.forEach(function(item, index) {
                    array_campus.push(item.id);
                }); 
                // --
                $('#update_user_form :input[name=campus]').val(array_campus).trigger('change');
            }
        }
    })
    // --
    $('#update_user_modal').modal('show');
})


// // --
// $(document).on('click', '#btn_cancel_user', function() {
//     // $("#update_user_form").validate().resetForm(); // this should work now
//     // $('#update_user_form')[0].reset();
//     // $('#update_user_form').trigger("reset");
// })

// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_user': value}
    // --
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¡No podrás revertir esto!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, desactivar!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        preConfirm: _ => {
            return $.ajax({
                url: BASE_URL + 'Users/delete_user',
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
                        get_user_statistics();
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
    $('#create_user_form').validate().resetForm();
    $('#update_user_form').validate().resetForm();
})

// -- Validate form
$('#create_user_form').validate({
    // --
    submitHandler: function(form) {
        create_user(form);
    }
})

// -- Validate form
$('#update_user_form').validate({
    // --
    submitHandler: function(form) {
        update_user(form);
    }
})
/* Upload image
// variables
var accountUploadImg = $('#account-upload-img'),
accountUploadBtn = $('#account-upload'),
accountUserImage = $('.uploadedAvatar'),
accountResetBtn = $('#account-reset')

// Update user photo on click of button

if (accountUserImage) {
    // --
    var resetImage = accountUserImage.attr('src');
    // --
    accountUploadBtn.on('change', function (e) {
        var reader = new FileReader(),
        files = e.target.files;
        console.log('Files', files)
        reader.onload = function () {
            if (accountUploadImg) {
                accountUploadImg.attr('src', reader.result);
            }
        };
        reader.readAsDataURL(files[0]);
    });
    // --
    accountResetBtn.on('click', function () {
        accountUserImage.attr('src', resetImage);
    });
}
*/


// --
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // --
    $('#btn_create_user').prop('disabled', false);
    $('#btn_update_user').prop('disabled', false);
});



// --
get_campus();
get_document_types();
get_menu();
get_roles();
// --
load_datatable();
get_user_statistics();