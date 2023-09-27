// -- Functions

// --
function destroy_datatable() {
  // --
  $('#datatable-roomtype').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
  // --
  $('#datatable-roomtype').DataTable().ajax.reload();
}


function load_datatable() {
  // --
  destroy_datatable();
  let dataTable = $('#datatable-roomtype').DataTable({
    ajax: {
      url: BASE_URL + 'RoomType/get_room_types',
      cache: false,
    },
    columns: [
      { data: 'id_type' },
      { data: 'type_name' },
      { data: 'person_limit' },
      { data: 'bed_type' },
      { data: 'price_temporary' },
      { data: 'price_half' },
      { data: 'price_day' },
      {
        class: 'center',
        render: function (data, type, row) {
          // --
          return (
            '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="' + row.id_type + '">' +
            feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
            '</button>'
            + ' ' +
            '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="' + row.id_type + '">' +
            feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
            '</button>'
          );
        }
      },
    ],
    dom: functions.head_datatable(),
    buttons: functions.custom_buttons_datatable([2], '#create_habitacion_modal'),
    language: {
      url: BASE_URL + 'public/assets/json/languaje-es.json'
    }
  })

  // 
  dataTable.on('xhr', function () {
    // 
    var data = dataTable.ajax.json();
    functions.toast_message(data.type, data.msg, data.status);
  });
}

function create_habitacion(form) {
  // --
  $('#btn_create_habitacion').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + 'RoomType/create_room_types',
    type: 'POST',
    data: params,
    dataType: 'json',
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      console.log('Cargando...');
    },
    success: function (data) {
      // --
      functions.toast_message(data.type, data.msg, data.status);
      // --
      if (data.status === 'OK') {
        // --
        $('#create_habitacion_modal').modal('hide');
        form.reset();
        refresh_datatable();

      } else {
        // --
        $('#btn_create_habitacion').prop('disabled', false);
      }
    }
  })
}


function update_habitacion(form) {
  // --
  $('#btn_update_habitacion').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + 'RoomType/update_room_type', // Reemplaza 'update_habitacion' con la ruta correcta de actualización de habitaciones
    type: 'POST',
    data: params,
    dataType: 'json',
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      console.log('Cargando...');
    },
    success: function (data) {
      // --
      functions.toast_message(data.type, data.msg, data.status);
      // --
      if (data.status === 'OK') {
        // --
        $('#update_habitacion_modal').modal('hide');
        form.reset();
        refresh_datatable();

      } else {
        // --
        $('#btn_update_habitacion').prop('disabled', false);
      }
    }
  })
}
// -- Eventos

// --
$(document).on('click', '.btn_update', function () {
  // --
  let value = $(this).attr('data-process-key');
  // --
  let params = { 'id_habitacion': value } // Asegúrate de que coincida con el nombre correcto del parámetro
  // --
  $.ajax({
    url: BASE_URL + 'Habitacion/get_habitacion_by_id', // Reemplaza 'get_habitacion_by_id' con la ruta correcta para obtener habitaciones por ID
    type: 'GET',
    data: params,
    dataType: 'json',
    contentType: false,
    processData: true,
    cache: false,
    success: function (data) {
      // --
      if (data.status === 'OK') {
        // --
        let item = data.data
        // --
        $('#update_habitacion_form :input[name=id_habitacion]').val(item.id);
        $('#update_habitacion_form :input[name=description]').val(item.description);
        // -- Otras asignaciones de valores para los campos de actualización
      }
    }
  })
  // --
  $('#update_habitacion_modal').modal('show');
})

// -- Otras funciones y eventos necesarios

// -- Reset forms
$(document).on('click', '.reset', function () {
  // --
  $('#create_habitacion_form').validate().resetForm();
  $('#update_habitacion_form').validate().resetForm();
})

// -- Validate form
$('#create_habitacion_form').validate({
  // --
  submitHandler: function (form) {
    create_habitacion(form);
  }
})

// -- Validate form
$('#update_habitacion_form').validate({
  // --
  submitHandler: function (form) {
    update_habitacion(form);
  }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
  // --
  $(this).find('form')[0].reset();
  // -- Enable buttons
  $('#btn_create_habitacion').prop('disabled', false);
  $('#btn_update_habitacion').prop('disabled', false);
});


load_datatable();