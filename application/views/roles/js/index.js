// -- Functions

// --
function destroy_datatable() {
    // --
    $('#datatables-roles').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
    // --
    $('#datatables-roles').DataTable().ajax.reload();
}

// --
function load_datatable() {
    // --
    destroy_datatable();
    // --
    let dataTable = $('#datatables-roles').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Roles/get_roles',
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
        buttons: functions.custom_buttons_datatable([0,1], '#create_role_modal'), // -- Number of columns
        language: {
            url: BASE_URL + 'public/assets/json/languaje-es.json'
        }
    })

    // --
    dataTable.on('xhr', function() {
        // --
        var data = dataTable.ajax.json();
        // --
        functions.toast_message(data.type, data.msg, data.status)
    });
}


// --
function create_role(form) {
    // --
    $('#btn_create_role').prop('disabled', true);
    // --
    let params = new FormData(form);
    params.append('permission', JSON.stringify(get_values_for_checkbox('create_role_modal', 'menu')));
    // --
    $.ajax({
        url: BASE_URL + 'Roles/create_role',
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
            functions.toast_message(data.type, data.msg, data.status)
            // --
            if (data.status === 'OK') {
                // --
                $('#create_role_modal').modal('hide');
                form.reset();
                refresh_datatable();
            } else {
                // --
                $('#btn_create_role').prop('disabled', false);
            }
        }
    })
}

// --
function update_role(form) {
    // --
    $('#btn_update_role').prop('disabled', true);
    // --
    let params = new FormData(form);
    params.append('permission', JSON.stringify(get_values_for_checkbox('update_role_modal', 'menu')));
    // --
    $.ajax({
        url: BASE_URL + 'Roles/update_role',
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
                $('#update_role_modal').modal('hide');
                form.reset();
                refresh_datatable();
            } else {
                // --
                $('#btn_update_role').prop('disabled', false);
            }
        }
    })
}

// // --
// function get_permissions() {
//     // --
//     // --
//     $.ajax({
//         url: BASE_URL + 'Permissions/get_permissions',
//         type: 'GET',
//         dataType: 'json',
//         contentType: false,
//         processData: false,
//         cache: false,
//         beforeSend: function() {
//             console.log('Cargando...');
//         },
//         success: function(data) {
//             // --
//             // functions.toast_message(data.type, data.msg, data.status);
//             // --
//             if (data.status === 'OK') {
//                 // -- 
//                 var html = `<tbody>`;
//                 // --
//                 data.data.forEach(function(item, index) {
//                     html += `<tr>
//                         <td class="text-nowrap fw-bolder">` + item.description + `</td>
//                         <td>
//                             <div class="d-flex">
//                                 <div class="form-check me-3 me-lg-3">
//                                     <input class="form-check-input create_role_checkbox" type="checkbox" name="create_permission_create[]" value="`+item.id+`"/>
//                                     <label class="form-check-label"> Crear </label>
//                                 </div>
//                                 <div class="form-check me-3 me-lg-3">
//                                     <input class="form-check-input create_role_checkbox" type="checkbox" name="create_permission_update[]" value="`+item.id+`" />
//                                     <label class="form-check-label"> Actualizar </label>
//                                 </div>
//                                 <div class="form-check me-3 me-lg-3">
//                                     <input class="form-check-input create_role_checkbox" type="checkbox" name="create_permission_delete[]" value="`+item.id+`" />
//                                     <label class="form-check-label"> Eliminar </label>
//                                 </div>
//                             </div>
//                         </td>
//                     </tr>`;
//                 })

//                 html += `</tbody>`;

//                 $('#create_table_permissions').html(html);
//             }
//         }
//     })
// }

// // --
// function get_campus() {
//     // --
//     $.ajax({
//         url: BASE_URL + 'Campus/get_campus',
//         type: 'GET',
//         dataType: 'json',
//         contentType: false,
//         processData: true,
//         cache: false,
//         success: function(data) {
//             // --
//             if (data.status === 'OK') {
//                 // --
//                 var html = '';
//                 // --
//                 data.data.forEach(element => {
//                     html += '<option value="' + element.id + '">'+ element.description +'</option>';
//                 });
//                 // -- Set values for select
//                 $('#create_role_form :input[name=campus]').html(html);
//                 $('#update_role_form :input[name=campus]').html(html);
//             }
//         }
//     });
// }

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
                                    <input type="checkbox" class="custom-control-input create_role_checkbox" name="menu[]" value="` + sub_menu.id + `">
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
            $('#create_role_menu').html(html_menu)
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

// // --
// function get_values_for_checkbox(index_name) {
//     // --
//     var arrayObjects = new Array();

//     // --
//     var arrayCreateChecked = $('[name="'+index_name+'_permission_create[]"]:checked').map(function(){return this.value;}).get();
//     var arrayUpdateChecked = $('[name="'+index_name+'_permission_update[]"]:checked').map(function(){return this.value;}).get();
//     var arrayDeleteChecked = $('[name="'+index_name+'_permission_delete[]"]:checked').map(function(){return this.value;}).get();

//     // --
//     arrayCreateChecked.forEach(function(item, index) {arrayObjects.push({id_permission: item, identifier: 'create', value: 1})})
//     arrayUpdateChecked.forEach(function(item, index) {arrayObjects.push({id_permission: item, identifier: 'update', value: 1})})
//     arrayDeleteChecked.forEach(function(item, index) {arrayObjects.push({id_permission: item, identifier: 'delete', value: 1})})

//     // --
//     var arrayCreateUnchecked = $('[name="'+index_name+'_permission_create[]"]:unchecked').map(function(){return this.value;}).get();
//     var arrayUpdateUnchecked = $('[name="'+index_name+'_permission_update[]"]:unchecked').map(function(){return this.value;}).get();
//     var arrayDeleteUnchecked = $('[name="'+index_name+'_permission_delete[]"]:unchecked').map(function(){return this.value;}).get();
    
//     // --
//     arrayCreateUnchecked.forEach(function(item, index) {arrayObjects.push({id_permission: item, identifier: 'create', value: 0})})
//     arrayUpdateUnchecked.forEach(function(item, index) {arrayObjects.push({id_permission: item, identifier: 'update', value: 0})})
//     arrayDeleteUnchecked.forEach(function(item, index) {arrayObjects.push({id_permission: item, identifier: 'delete', value: 0})})
    
//     // --
//     let newData = new Object();
//     // --
//     arrayObjects.forEach(item => {
//         // --
//         let id_permission = item.id_permission;
//         if (!newData[id_permission]) newData[id_permission] = [];
//         newData[id_permission].push(item);
//     })

//     // --
//     let newArray = new Array();
//     // --
//     for (const property in newData) {
//         // --
//         let obj = new Object();
//         let item = newData[property];
//         // --
//         item.forEach(value => {
//             // --
//             obj.id_permission = parseInt(value.id_permission);
//             // --
//             if (value.identifier == "create") {
//                 obj.create = value.value;
//             }
//             if (value.identifier == "update") {
//                 obj.update = value.value;
//             }
//             if (value.identifier == "delete") {
//                 obj.delete = value.value;
//             }
//         })
//         // --
//         newArray.push(obj);
//     }

//     // --
//     return newArray;
// }


// -- Events

// --
$(document).on('click', '.btn_update', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_role': value}
    // --
    $.ajax({
        url: BASE_URL + 'Roles/get_role',
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
                $('#update_role_form :input[name=id_role]').val(data.data.role.id);
                $('#update_role_form :input[name=description]').val(data.data.role.description);
                // $('.select2-search__field').css('width', '100%');
                // --
                let menu = data.data.menu
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
                                    <div class="custom-control custom-switch custom-control-inline">`;
                        // --
                        if (sub_menu.status === 1) {
                            html_menu += '<input type="checkbox" class="custom-control-input update_role_checkbox" name="menu[]" value="' + sub_menu.id + '" checked>';
                        } else {
                            html_menu += '<input type="checkbox" class="custom-control-input update_role_checkbox" name="menu[]" value="' + sub_menu.id + '">';
                        }
                        // --
                        html_menu += `
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
                $('#update_role_menu').html(html_menu)
            }
        }
    })
    // --
    $("#update_role_modal").modal('show');
});


// --
$(document).on('click', '.btn_delete', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_role': value}
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
                url: BASE_URL + 'Roles/delete_role',
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
    $('#create_role_form').validate().resetForm();
    $('#update_role_form').validate().resetForm();
})


// -- Validate form
$('#create_role_form').validate({
    // --
    submitHandler: function(form) {
        create_role(form);
    }
})


// -- Validate form
$('#update_role_form').validate({
    // --
    submitHandler: function(form) {
        update_role(form);
    }
})

// -- Select all checkbox - create
$(document).on('click', '#create_role_select_all', function() {
    // --
    if($('#create_role_select_all').is(':checked')) {  
        $('.create_role_checkbox').prop('checked', true);
    } else {  
        $('.create_role_checkbox').prop('checked', false);
    }  
})

// -- Select all checkbox - update
$(document).on('click', '#update_role_select_all', function() {
    // --
    if($('#update_role_select_all').is(':checked')) {  
        $('.update_role_checkbox').prop('checked', true);
    } else {  
        $('.update_role_checkbox').prop('checked', false);
    }  
})

// --
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // -- Enable buttons
    $('#btn_create_role').prop('disabled', false);
    $('#btn_update_role').prop('disabled', false);
});





// --
load_datatable();
// get_permissions();
// get_campus();
get_menu();