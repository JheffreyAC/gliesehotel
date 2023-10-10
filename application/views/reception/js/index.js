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
          const btnDisabled = estadoHabitacion === 'Ocupado' || estadoHabitacion === 'Reservado' ? 'disabled' : '';
          const btnColor = btnDisabled ? 'bg-dark text-light' : 'bg-light text-dark';

          $('#data-container').append(`<div class="card bg-${bgClass} text-light" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
          <div class="card-body">
              <h5 class="card-title text-light" style="font-size: 1.5rem">${row.type_name}</h5>
              <div class="d-flex align-items-center gap-1" style="font-size: 1.5rem">
                  <i class="fa-solid fa-people-group"></i>
                  <p class="card-text ml-2">${row.person_limit}</p>
              </div>
              <div class="text-center mt-2" style="font-size: 1.5rem">
                  ${row.room_status}
              </div>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center" style="border-top: 1px solid rgba(255, 255, 255, 0.2); letter-spacing: 1px;">
              <div class="d-flex align-items-center">
                  <i class="fa-solid fa-bed text-light" style="font-size: 2.3rem;"></i>
                  <span style="font-size: 1.5rem; margin-left: 5px;">${row.room_number}</span>
              </div>
              <div class="d-flex justify-content-center align-items-center gap-1">
                <button class="btn ${btnColor} btn-icon btn-md btn_update" data-process-key="${row.id_room}"  ${btnDisabled}>
                  <i class="fa-solid fa-key"></i>
                </button>
                <button class="btn ${btnColor} btn-icon btn-md btn_create_guest" ${btnDisabled} data-bs-toggle="modal" data-bs-target="#create_guest_reservation_modal">
                  <i class="fa-solid fa-person"></i>
                </button>
              </div>
          </div>
      </div>`);
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


function create_reservation(form) {
  // --
  $('#btn_create_reservation').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + 'Reception/create_reservation',
    type: 'POST',
    data: params,
    dataType: 'json',
    contentType: false,
    processData: false,
    cache: false,
    success: function (data) {
      // --
      // console.log(data);
      functions.toast_message(data.type, data.msg, data.status);
      // --
      if (data.status === 'OK') {
        // --
        $('#update_habitacion_modal').modal('hide');
        form.reset();
        load_data();
        $('#btn_create_reservation').prop('disabled', false);
        filtrarOpciones();
      } else {
        // --
        // console.log('dsfsa');
        $('#btn_create_reservation').prop('disabled', false);
      }
    },
    error: function () {
      console.error('Fallo al obtener los datos.');

      functions.toast_message('error', 'Error al obtener los datos', 'Error');
    }
  })
}

function create_guest(form) {
  $('#btn_create_guest_reservation').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + 'Reception/create_guest_reservation',
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
      // console.log(data);
      functions.toast_message(data.type, data.msg, data.status);
      // --
      if (data.status === 'OK') {
        // --
        $('#create_guest_reservation_modal').modal('hide');
        form.reset();
        load_data();
        $('#btn_create_guest_reservation').prop('disabled', false);
        filtrarOpciones();
      } else {
        // --
        // console.log('dsfsa');
        $('#btn_create_guest_reservation').prop('disabled', false);
      }
    }
  })
}



// -- Funciones

function filtrarOpciones() {
  const client_document_type = $('#client_document_type').val();
  const document_number_reservation = $('#document_number_reservation').val();
  // console.log(client_document_type, document_number_reservation);
  $.ajax({
    url: BASE_URL + 'Reception/get_guest',
    type: 'GET',
    data: { document_type: client_document_type, document_number: document_number_reservation },
    dataType: 'json', // Espera una respuesta JSON
    cache: false,
    success: function (data) {
      if (data.status === 'OK') {

        $('.opcionesSelect').empty();


        $.each(data.data, function (index, row) {

          // console.log(row.id_guest);
          const optionText = (client_document_type === 'DNI' && row.document_type === 'DNI') ?
            `${row.first_names} ${row.last_names}` :
            row.company_name;
          $('.opcionesSelect').append(`
                  <option value=${row.id_guest}>
                    ${optionText}
                  </option >
        `);
        });
        // functions.toast_message(data.type, data.msg, data.status);
      } else {

        // functions.toast_message(data.type, data.msg, data.status);
      }
    },
    error: function () {
      // console.error('Fallo al obtener los datos.');

      // functions.toast_message('error', 'Error al obtener los datos', 'Error');
    }
  });
}




$('#document_number_reservation').on('keyup', function () {
  filtrarOpciones();
})

//--
$('#client_document_type').on('change', function () {
  // Llama a la función para cargar las opciones nuevamente cuando cambie el tipo de documento
  filtrarOpciones();
});



$(document).on('click', '.btn_update', function () {
  // --
  let value = $(this).attr('data-process-key');
  // --
  let params = { 'id_room': value } // Asegúrate de que coincida con el nombre correcto del parámetro

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
      // console.log(data);

      if (data.status === 'OK') {
        // --
        let item = data.data
        // --
        $('#create_reservation_form :input[name=room_number]').val(item.room_number);
        $('#create_reservation_form :input[name=type_name]').val(item.type_name);
        $('#create_reservation_form :input[name=person_limit]').val(item.person_limit);
        $('#create_reservation_form :input[name=bed_type]').val(item.bed_type);
        $('#create_reservation_form :input[name=room_status]').val(item.room_status);
        $('#create_reservation_form :input[name=price_temporary]').val(item.price_temporary);
        $('#create_reservation_form :input[name=price_half]').val(item.price_half);
        $('#create_reservation_form :input[name=price_day]').val(item.price_day);
        $('#create_reservation_form :input[name=id_room]').val(item.id_room);
        // -- Otras asignaciones de valores para los campos de actualización
      }
    },
    error: function () {
      console.error('Fallo al obtener los datos.');

      functions.toast_message('error', 'Error al obtener los datos', 'Error');
    }
  })
  // --
  $('#update_habitacion_modal').modal('show');
})




function room_rate() {
  const room_rateSelect = $('#room_rate').val();
  $.ajax({
    url: BASE_URL + 'Reception/get_rooms_price',
    type: 'GET',
    data: { type_name: room_rateSelect },
    dataType: 'json',
    cache: false,
    success: function (data) {
      if (data.status === 'OK') {
        // Limpia el contenido actual del select

        $('#priceSelectOption').empty();


        $.each(data.data, function (index, row) {
          // Agrega una opción para price_temporary
          $('#priceSelectOption').append(`
            <option value="${row.price_temporary}">
              Temporal: ${row.price_temporary}
            </option> 
            <option value="${row.price_half}">
            Mitad: ${row.price_half}
          </option>
          <option value="${row.price_day}">
            Diario: ${row.price_day}
          </option>
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


$('#room_rate').on('change', function () {
  room_rate();
})




function guestDocument() {
  const documentType = document.getElementById('client_document');
  // const document_number = document.getElementById('document_number');

  documentType.addEventListener('change', function () {
    const documentNumberInput = document.getElementById('document_number');
    const selectedDocumentType = this.value;

    if (selectedDocumentType === 'DNI') {
      documentNumberInput.maxLength = 8;
    } else {
      documentNumberInput.maxLength = 11;
    }
  });


  document_number.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
  });
}

function reservationDocument() {
  const documentType = document.getElementById('client_document_type');
  const document_number = document.getElementById('document_number_reservation');

  documentType.addEventListener('change', function () {
    const documentNumberInput = document.getElementById('document_number_reservation');
    const selectedDocumentType = this.value;
    // console.log(selectedDocumentType);

    if (selectedDocumentType === 'DNI') {
      documentNumberInput.maxLength = 8;
    } else if (selectedDocumentType === 'RUC') {
      documentNumberInput.maxLength = 11;
    } else {
      documentNumberInput.maxLength = 8;
    }
  })

  document_number.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
  });
}



// -- Reset forms
$(document).on('click', '.reset', function () {
  $('#create_reservation_form').validate().resetForm();
  // --
  $('#create_guest_reservation_form').validate().resetForm();
})


$('#create_reservation_form').validate({
  // --
  submitHandler: function (form) {
    create_reservation(form);
  }
})
// -- Validate form
$('#create_guest_reservation_form').validate({
  // --
  submitHandler: function (form) {
    create_guest(form);
  }
})

load_data();
guestDocument();
reservationDocument();