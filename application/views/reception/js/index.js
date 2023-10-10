let colorsRooms = {
  'Disponible': 'success',
  'Ocupado': 'danger',
  'Limpieza': 'info',
  'Reservado': 'warning',
};

function load_data() {
  // Realiza una solicitud AJAX para obtener los datos desde el servidor
  $.ajax({
    url: BASE_URL + 'Reception/get_rooms',
    type: 'GET',
    dataType: 'json', // Espera una respuesta JSON
    cache: false,
    success: function (data) {
      if (data.status === 'OK') {
        // Borra el contenido anterior del contenedor
        $('#data-container').empty();


        $.each(data.data, function (index, row) {
          const estadoHabitacion = row.room_status;
          const bgClass = colorsRooms[estadoHabitacion] || 'success';
          // console.log(bgClass); // Si no coincide, usa 'bg-success'
          $('#data-container').append(`
                  <div style="display: flex; justify-content: center; flex-wrap: wrap; margin: 4px;">
                  <div class="container shadow bg-${bgClass} round" 
                  title=${row.room_status}
                  style="width: 250px; height: 100%;  display: flex; justify-content: center; align-items: center;flex-direction:column;gap:30px; padding: 20px;">
                      <div class="d-flex align-items-center flex-column" style="height: 70px;">
                          <span class="text-light" style="text-align: center; font-size: 17px; font-weight: bold;width: 100%;">${row.type_name}</span>
                          <span class="text-light" style="text-align: center; font-size: 11px; font-weight: bold;width: 100%;">${row.bed_type}</span>
                          <span class="d-flex justify-content-center align-items-center h3 gap-1 text-light" style="color:#000;height: 100%; margin-top: 10px;">
                          <i class="fa-solid fa-people-group"></i>
                           <p class="text-light">${row.person_limit}</p>
                          </span>
                      </div>
                      <hr style="width: 100%;">
                      <div class="d-flex justify-content-center align-items-center h3 gap-1">
                      <i class="fa-solid fa-bed text-light"></i>
                          <span class="text-light">${row.room_number}</span>
                          <button class="btn btn-sm btn-light btn-round btn-icon btn_update" data-process-key=${row.room_number}>
                          <i class="fa-solid fa-key text-dark"></i>
                        </button>
                      </div>
                  </div>
              </div>
                  `);
        });
        functions.toast_message(data.type, data.msg, data.status);
      } else {
        // Muestra un mensaje de tostada en caso de error
        functions.toast_message(data.type, data.msg, data.status);
      }
    },
    error: function () {
      console.error('Fallo al obtener los datos.');
      // Muestra un mensaje de tostada en caso de error de AJAX
      functions.toast_message('error', 'Error al obtener los datos', 'Error');
    }
  });
}

//--
function update_habitacion(form) {
  // --
  $('#btn_update_habitacion').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + 'Habitacion/update_habitacion', // Reemplaza 'update_habitacion' con la ruta correcta de actualización de habitaciones
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


$(document).on('click', '.btn_update', function () {
  // --
  let value = $(this).attr('data-process-key');
  // --
  let params = { 'room_number': value } // Asegúrate de que coincida con el nombre correcto del parámetro
  // --
  $.ajax({
    url: BASE_URL + 'Reception/get_room_by_id',
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
        $('#update_habitacion_form :input[name=room_number]').val(item.room_number);
        $('#update_habitacion_form :input[name=type_name]').val(item.type_name);
        $('#update_habitacion_form :input[name=person_limit]').val(item.person_limit);
        $('#update_habitacion_form :input[name=bed_type]').val(item.bed_type);
        $('#update_habitacion_form :input[name=room_status]').val(item.room_status);
        $('#update_habitacion_form :input[name=price_temporary]').val(item.price_temporary);
        // -- Otras asignaciones de valores para los campos de actualización
      }
    }
  })
  // --
  $('#update_habitacion_modal').modal('show');
})

$('#update_habitacion_form').validate({
  // --
  submitHandler: function (form) {
    update_habitacion(form);
  }
})


function clientDocument() {
  const documentType = document.getElementById('client_document');
  const option_document = document.getElementById('option_document');
  documentType.addEventListener('change', function () {
    if (documentType.value === 'DNI') {
      option_document.innerHTML = ` <div class="col-12">
      <label class="form-label">Nombres</label>
      <input type="text" name="bed_name" class="form-control" placeholder="Nombres" data-msg="" required />
  </div>
  <div class="col-12">
      <label class="form-label">Apellidos</label>
      <input type="text" name="bed_name" class="form-control" placeholder="Apellidos" data-msg="" required />
  </div>`;
    } else {
      option_document.innerHTML = ` <div class="col-12">
      <label class="form-label">Razón Social</label>
      <input type="text" name="" class="form-control" placeholder="Razón Social" data-msg="" required />
  </div>`;
    }

  })
}

clientDocument();

load_data();