// -- Functions

// --
function destroy_datatable() {
  // --
  $('#datatable-rooms').dataTable().fnDestroy();
}

// --
function refresh_datatable() {
  // --
  $('#datatable-rooms').DataTable().ajax.reload();
}

function load_datatable() {
  // --
  destroy_datatable();
  let dataTable = $('#datatable-rooms').DataTable({
    ajax: {
      url: BASE_URL + 'Rooms/get_rooms',
      cache: false,
    },
    columns: [
      { data: 'room_number' },
      { data: 'type_name' },
      { data: 'person_limit' },
      { data: 'bed_type' },
      { data: 'room_status' },
      {
        class: 'center',
        render: function (data, type, row) {
          // --
          return (
            '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="' + row.id_room + '">' +
            feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
            '</button>'
            + ' ' +
            '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="' + row.id_room + '">' +
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
    url: BASE_URL + 'Rooms/create_rooms', // Reemplaza 'create_habitacion' con la ruta correcta de creación de habitaciones
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


// -- Funciones

function cargarOpciones() {

  $.ajax({
    url: BASE_URL + 'Rooms/get_option_rooms',
    type: 'GET',
    dataType: 'json', // Espera una respuesta JSON
    cache: false,
    success: function (data) {
      if (data.status === 'OK') {

        $('.opcionesSelect').empty();


        $.each(data.data, function (index, row) {

          console.log(row.id_type);
          $('.opcionesSelect').append(`
                  <option value=${row.id_type}>${row.type_name}</option>
                  `);
        });
        functions.toast_message(data.type, data.msg, data.status);
      } else {

        functions.toast_message(data.type, data.msg, data.status);
      }
    },
    error: function () {
      console.error('Fallo al obtener los datos.');

      functions.toast_message('error', 'Error al obtener los datos', 'Error');
    }
  });
}
// Llamar a la función para cargar las opciones al cargar la página




function update_habitacion(form) {
  // --
  $('#btn_update_habitacion').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + 'Rooms/update_rooms',
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
      console.log(data);
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
  let params = { 'id_room': value } // Asegúrate de que coincida con el nombre correcto del parámetro
  // --
  $.ajax({
    url: BASE_URL + 'Rooms/get_room_by_id',
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
        $('#update_habitacion_form :input[name=id_room]').val(item.id_room);
        $('#update_habitacion_form :input[name=room_number]').val(item.room_number);
        $('#update_habitacion_form :input[name="id_type"]').val(item.id_type);
        $('#update_habitacion_form :input[name=room_status]').val(item.room_status);
        // -- Otras asignaciones de valores para los campos de actualización
      }
    }
  })
  // --
  $('#update_habitacion_modal').modal('show');
})

// -- Otras funciones y eventos necesarios
$(document).on('click', '.btn_delete', function () {
  // --
  let value = $(this).attr('data-process-key');
  // --
  let params = { 'id_room': value }
  // --
  Swal.fire({
    title: '¿Estás seguro?',
    text: '¡No podrás revertir esto!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, eliminar!',
    cancelButtonText: 'No, cancelar!',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1'
    },
    buttonsStyling: false,
    preConfirm: _ => {
      return $.ajax({
        url: BASE_URL + 'Rooms/delete_rooms',
        type: 'POST',
        data: params,
        dataType: 'json',
        cache: false,
        success: function (data) {
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

cargarOpciones();