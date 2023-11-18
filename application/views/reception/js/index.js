const colorsRooms = {
  Disponible: "success",
  Ocupado: "danger",
  Limpieza: "info",
  Reservado: "warning",
};

function load_data() {
  // Realiza una solicitud AJAX para obtener los datos desde el servidor
  $.ajax({
    url: BASE_URL + "Reception/get_rooms",
    type: "GET",
    dataType: "json", // Espera una respuesta JSON
    cache: false,
    success: function (data) {
      if (data.status === "OK") {
        // Borra el contenido anterior del contenedor
        $("#data-container").empty();

        $.each(data.data, function (index, row) {
          const estadoHabitacion = row.room_status;
          const bgClass = colorsRooms[estadoHabitacion] || "success";
          const btnDisabled = estadoHabitacion === "Ocupado" && "hidden";
          const btnTimer = ` <button class="btn bg-light text-dark btn-icon btn-md btn_timer ${btnDisabled}" data-process-key="${row.id_room}"  >
          <i class="fa-solid fa-clock"></i>
        </button>`
          const buttonClean = `<button class="btn bg-light text-dark btn-icon btn-md btn_clean ${btnDisabled}" data-process-key="${row.id_room}" type="submit" >
          <i class="fa-solid fa-circle-check"></i>
        </button>`
          const stateCleaning = row.room_status === 'Limpieza' ? buttonClean : '';
          const statusButton = row.room_status === 'Reservado' ? btnTimer : '';
          $("#data-container")
            .append(`<div class="card bg-${bgClass} text-light" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
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
                <button class="btn bg-light text-dark btn-icon btn-md btn_update ${btnDisabled}" data-process-key="${row.id_room}"  >
                  <i class="fa-solid fa-key"></i>
                </button>
               ${statusButton}
               ${stateCleaning}
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
    error: function (xhr, status, error) {
      console.error("Error en la solicitud AJAX:", error);
      console.error("Fallo al obtener los datos.");
      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
}



function update_habitacion(form) {
  // --
  $("#btn_create_reservation").prop("disabled", true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + "Reception/update_state_reservation",
    type: "POST",
    data: params,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      console.log("Cargando...");
    },
    success: function (data) {
      // --
      if (data.status === "OK") {
        // --
        $("#update_habitacion_modal").modal("hide");
        form.reset();
        load_data();
      } else {
        // --
        $("#btn_create_reservation").prop("disabled", false);
      }
    },
  });
}

// create a cronometer

function create_cronometer(roomId) {
  var inputTime = document.getElementById("timer_time").value; // Obtener el valor del input
  console.log(inputTime);
  var timeInSeconds = parseInt(inputTime) * 60; // Convertir a segundos

  var timerDisplay = document.getElementById("timer");

  var interval = setInterval(function () {
    var minutes = Math.floor(timeInSeconds / 60);
    var seconds = timeInSeconds % 60;
    console.log(minutes);
    console.log(seconds);
    // Actualizar el elemento "timer" con el tiempo restante
    timerDisplay.textContent =
      minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

    console.log(timeInSeconds);
    if (timeInSeconds <= 0) {
      clearInterval(interval); // Detener el temporizador cuando llegue a cero
      alert("¡Tiempo terminado!");
    } else {
      timeInSeconds--;
    }
  }, 1000);
  console.log(roomId);
}

$("#btn_start_timer").on("click", function () {
  var roomId = $(this).data("process-key");
  create_cronometer(roomId);
});


function update_state_timer(form) {
  // --
  $("#btn_remove_reservation").prop("disabled", true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + "Reception/update_state_timer",
    type: "POST",
    data: params,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      console.log("Cargando...");
    },
    success: function (data) {
      // --
      if (data.status === "OK") {
        // --
        $("#timer_modal").modal("hide");
        form.reset();
        load_data();
        functions.toast_message(data.type, data.msg, data.status);

      } else {
        // --
        functions.toast_message(data.type, data.msg, data.status);

        $("#btn_remove_reservation").prop("disabled", false);
      }
    },
    error: function (xhr, status, error) {
      console.error("Fallo al obtener los datos." + error);
      console.log(xhr.responseText);
      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
}



// function is validate a state reservation

function state_reservation_mode() {
  const pre_payment = document.getElementById("pre_payment").value;
  const stateReservationType = document.getElementById("state-reservation");
  if (pre_payment != '1') {
    stateReservationType.innerHTML = `
<label class="form-label">Estado de Reserva</label>
<select class="form-select" name="status">
  <option value="Ocupado">Ocupado</option>
  <option vlaue="Confirmado">Confirmado</option>
</select>
`;
    console.log("hay algo aqui");
  } else {
    stateReservationType.innerHTML = `
<label class="form-label">Estado de Reserva</label>
   <input class="form-control" name="status" value="Pendiente"
   ></input>
`;
    console.log("no hay nada");
  }

  console.log(pre_payment);
}
state_reservation_mode();
$("#pre_payment").on("input", function () {
  state_reservation_mode();
  load_data();
});

function create_reservation(form) {
  // --
  $("#btn_create_reservation").prop("disabled", true);
  // --
  let params = new FormData(form);
  // --

  $.ajax({
    url: BASE_URL + "Reception/create_reservation",
    type: "POST",
    data: params,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    success: function (data) {
      // --
      if (data.status === "OK") {
        form.reset();
        filtrarOpciones();
        load_data();
        // --
        $("#update_habitacion_modal").modal("hide");
        $("#btn_create_reservation").prop("disabled", false);
        functions.toast_message(data.type, data.msg, data.status);
      } else {
        $("#btn_create_reservation").prop("disabled", false);
        functions.toast_message(data.type, data.msg, data.status);
      }
    },
    error: function () {
      console.error("Fallo al obtener los datos.");
      functions.toast_message(data.type, data.msg, data.status);
      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
}

// ellla no te ama
var allPricesRoom = [];

function valDate(input_name, input_nameAux) {
  const valCheckin = $('input[name=checkin_date]').val() + " " + $('input[name=checkin_time]').val();
  const valCheckout = $('input[name=checkout_date]').val() + " " + $('input[name=checkout_time]').val();
  console.log(valCheckin + '-' + valCheckout);
  const valDateInitial = $('input[name=checkin_date]').val()
  $('input[name=checkout_date]').attr("min", valDateInitial);


  $('input[name=checkout_date]').attr("min", $('input[name=checkin_date]').val());
  $('input[name=checkin_date]').attr("max", $('input[name=checkout_date]').val());


  const valRoom = $('input[name=id_room]').val()
  console.log(valRoom);
  // const valReservation = $('input[name=id_reservation]').val()

  $.ajax({
    url: BASE_URL + 'Reception/date_reservation',
    cache: false,
    data: { id_room: valRoom, checkin_date: valCheckin, checkout_date: valCheckout },
    success: function (data) {
      const datas = data.data;
      console.log(datas)
      if (data.status == 'ERROR') {
        $('input[name=' + input_name + ']').addClass('is-invalid').attr('data-error', data.msg);
        functions.toast_message(data.type, data.msg, data.status);
      } else if (data.status == 'OK') {
        $('input[name=' + input_name + ']').removeClass('is-invalid').removeAttr('data-error');
        $('input[name=' + input_nameAux + ']').removeClass('is-invalid').removeAttr('data-error');
        paymentReservation(valCheckin, valCheckout, allPricesRoom, 1);
      }
    }
  });
}

$('input[name="checkin_date"]').on('change', () => { valDate("checkin_date", "checkin_time") });
$('input[name="checkin_time"]').on('change', () => { valDate("checkin_time") });
$('input[name="checkout_date"]').on('change', () => { valDate("checkout_date", "checkout_time") });
$('input[name="checkout_time"]').on('change', () => { valDate("checkout_time") });

function paymentReservation(dateIn, dateOut, prices) {
  let fechaInicio = new Date(dateIn);
  let fechaFin = new Date(dateOut);
  let milisegundosInicio = fechaInicio.getTime();
  let milisegundosFin = fechaFin.getTime();

  let minutes = (milisegundosFin - milisegundosInicio) / (1000 * 60);

  if (minutes <= 240) {
    $("input[name=payment_room]").val(prices[0]);
  } else if (minutes > 240 && minutes <= 720) {
    $("input[name=payment_room]").val(prices[1]);
  } else {
    let dias = Math.floor(minutes / 1440);
    let minutesRes = minutes % 1440;
    let payment = parseInt(prices[2]) * dias;
    let paymentMinutes = 0;

    // --
    if (minutesRes > 0 && minutesRes <= 240) {
      paymentMinutes = parseInt(prices[0]);
    } else if (minutesRes > 240 && minutesRes <= 720) {
      paymentMinutes = parseInt(prices[1]);
    } else {
      paymentMinutes = parseInt(prices[2]);
    }
    payment += paymentMinutes;

    return $("input[name=payment_room]").val(payment);
  }
}

// fin

function create_guest(form) {
  $("#btn_create_guest_reservation").prop("disabled", true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + "Reception/create_guest_reservation",
    type: "POST",
    data: params,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      console.log("Cargando...");
    },
    success: function (data) {
      functions.toast_message(data.type, data.msg, data.status);
      // --
      if (data.status === "OK") {
        // --
        $("#create_guest_reservation_modal").modal("hide");
        form.reset();
        $("#btn_create_guest_reservation").prop("disabled", false);
        filtrarOpciones();
        load_data();
      } else {
        // --
        // console.log('dsfsa');
        $("#btn_create_guest_reservation").prop("disabled", false);
      }
    },
  });
}

$(document).on("click", ".btn_timer", function () {
  // --
  let value = $(this).attr("data-process-key");
  // --
  let params = { id_room: value }; // Asegúrate de que coincida con el nombre correcto del parámetro

  // --
  $.ajax({
    url: BASE_URL + "Reception/get_room_by_id",
    type: "GET",
    data: params,
    dataType: "json",
    contentType: false,
    processData: true,
    cache: false,
    success: function (data) {
      // --
      // console.log(data);

      if (data.status === "OK") {
        // --
        let item = data.data;
        // --
        let id_timer_room = item.id_room
        listReservation(id_timer_room)
        $("#create_timer_form :input[name=id_room]").val(
          item.id_room,
        );
        $("#create_timer_form :input[name=room_number]").val(
          item.room_number,
        );
        $("#create_timer_form :input[name=room_status]").val(
          item.room_status,
        );
        $("#create_timer_form :input[name=type_name]").val(
          item.type_name,
        );
      }
    },
    error: function () {
      console.error("Fallo al obtener los datos.");

      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
  // --
  $("#timer_modal").modal("show");

});

// -- Validate form
$("#create_reservation_form").validate({
  // --
  submitHandler: function (form) {
    create_reservation(form);
    update_habitacion(form);
    load_data();
  },
});

// -- Funciones

function filtrarOpciones() {
  const client_document_type = $("#client_document_type").val();
  $.ajax({
    url: BASE_URL + "Reception/get_guest",
    type: "GET",
    data: { document_type: client_document_type },
    dataType: "json", // Espera una respuesta JSON
    cache: false,
    success: function (data) {
      if (data.status === "OK") {
        $(".opcionesSelect").empty();

        $.each(data.data, function (index, row) {
          // console.log(row.id_guest);
          const optionText =
            client_document_type === "DNI" && row.document_type === "DNI"
              ? `${row.first_names} ${row.last_names}`
              : row.company_name;
          $(".opcionesSelect").append(`
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
  });
}

// $('#document_number_reservation').on('keyup', function () {
//   filtrarOpciones();
// })

//--
$("#client_document_type").on("change", function () {
  // Llama a la función para cargar las opciones nuevamente cuando cambie el tipo de documento
  filtrarOpciones();
});





//--------------------------------




function listReservation(room_id) {
  let xd = room_id;
  console.log(xd);
  $.ajax({
    url: BASE_URL + "Reception/get_reservation_room",
    type: "GET",
    data: { id_room: xd },
    dataType: "json",
    cache: false,
    success: function (data) {
      console.log(data);
      if (data.status === "OK") {
        $.each(data.data, function (index, row) {
          const guestNames = row.first_names + ' ' + row.last_names;
          const condition = row.company_name ? row.company_name : guestNames;
          $(".optionReservation").append(`
            <option value=${row.id_reservation}>
            ${condition}
            </option>
            `);

        });

        functions.toast_message(data.type, data.msg, data.status);
      } else {
        $(".optionReservation").empty();
        // functions.toast_message(data.type, data.msg, data.status);
      }
    },
    error: function (xhr, status, error) {
      console.error("Fallo al obtener los datos." + error);
      console.log(xhr.responseText);
      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
}

// //--
// $("#client_document_type").on("change", function () {
//   // Llama a la función para cargar las opciones nuevamente cuando cambie el tipo de documento
//   listReservation();
// });




// function clean_rooms(params) {
//   // --
//   console.log(params + 'dhgfytc');
//   // --
//   $.ajax({
//     url: BASE_URL + 'Reception/clean_rooms',
//     type: 'POST',
//     data: {
//       id_room: 3
//     },
//     dataType: 'json',
//     contentType: false,
//     processData: false,
//     cache: false,
//     beforeSend: function () {
//       console.log('Cargando...');
//     },
//     success: function (data) {
//       // --
//       console.log(data);
//       // --

//       if (data.status === 'OK') {
//         // --
//         console.log('gooooooooooooooooooooooooool')
//       } else {
//         functions.toast_message(data.type, data.msg, data.status);
//         // --
//       }
//     },
//     error: function (xhr, status, error) {
//       console.log(status)
//       console.error("Fallo al obtener los datos." + error);
//       console.log(xhr.responseText);

//       console.error("Fallo al limpiar la habitación.");
//       functions.toast_message("error", "Error al limpiar la habitación", "Error");
//     },
//   })
// }

$(document).on("click", ".btn_clean", function () {
  let value = $(this).attr("data-process-key");
  // console.log(value);
  let params = value;
  $.ajax({
    url: BASE_URL + 'Reception/clean_rooms',
    type: 'POST',
    data: {
      id_room: value,
    },
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
      // --

      if (data.status === 'OK') {
        // --
        console.log('gooooooooooooooooooooooooool')
      } else {
        functions.toast_message(data.type, data.msg, data.status);
        // --
      }
    },
    error: function (xhr, status, error) {
      console.log(status)
      console.error("Fallo al obtener los datos." + error);
      console.log(xhr.responseText);

      console.error("Fallo al limpiar la habitación.");
      functions.toast_message("error", "Error al limpiar la habitación", "Error");
    },
  })
});














//------------------------------
$(document).on("click", ".btn_update", function () {
  // --
  let value = $(this).attr("data-process-key");
  // --
  let params = { id_room: value }; // Asegúrate de que coincida con el nombre correcto del parámetro

  // --
  $.ajax({
    url: BASE_URL + "Reception/get_room_by_id",
    type: "GET",
    data: params,
    dataType: "json",
    contentType: false,
    processData: true,
    cache: false,
    success: function (data) {
      // --
      // console.log(data);

      if (data.status === "OK") {
        // --
        let item = data.data;
        // --
        $("#create_reservation_form :input[name=room_number]").val(
          item.room_number,
        );
        $("#create_reservation_form :input[name=type_name]").val(
          item.type_name,
        );
        $("#create_reservation_form :input[name=person_limit]").val(
          item.person_limit,
        );
        $("#create_reservation_form :input[name=bed_type]").val(item.bed_type);
        // $('#create_reservation_form :input[name=room_status]').val(item.room_status);
        $("#create_reservation_form :input[name=price_temporary]").val(
          item.price_temporary,
        );
        $("#create_reservation_form :input[name=price_half]").val(
          item.price_half,
        );
        $("#create_reservation_form :input[name=price_day]").val(
          item.price_day,
        );
        $("#create_reservation_form :input[name=id_room]").val(item.id_room);
        // -- Otras asignaciones de valores para los campos de actualización
        allPricesRoom.push(item.price_temporary);
        allPricesRoom.push(item.price_half);
        allPricesRoom.push(item.price_day);
      }
    },
    error: function () {
      console.error("Fallo al obtener los datos.");

      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
  // --
  $("#update_habitacion_modal").modal("show");
});

// Agrega un controlador de eventos para el cambio en el select

function guestDocument() {
  const documentType = document.getElementById("client_document");
  // const document_number = document.getElementById('document_number');

  documentType.addEventListener("change", function () {
    const documentNumberInput = document.getElementById("document_number");
    const selectedDocumentType = this.value;

    if (selectedDocumentType === "DNI") {
      documentNumberInput.maxLength = 8;
    } else {
      documentNumberInput.maxLength = 11;
    }
  });

  document_number.addEventListener("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
}

function reservationDocument() {
  const documentType = document.getElementById("client_document_type");
  const document_number = document.getElementById(
    "document_number_reservation",
  );

  documentType.addEventListener("change", function () {
    const documentNumberInput = document.getElementById(
      "document_number_reservation",
    );
    const selectedDocumentType = this.value;
    // console.log(selectedDocumentType);

    if (selectedDocumentType === "DNI") {
      documentNumberInput.maxLength = 8;
    } else if (selectedDocumentType === "RUC") {
      documentNumberInput.maxLength = 11;
    } else {
      documentNumberInput.maxLength = 8;
    }
  });

  document_number.addEventListener("input", function () {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
}

// -- Reset forms
$(document).on("click", ".reset", function () {
  $("#create_reservation_form").validate().resetForm();
  // --
  $("#create_guest_reservation_form").validate().resetForm();
  $("#create_timer_form").validate().resetForm();

});

// -- Validate form
$("#create_guest_reservation_form").validate({
  // --
  submitHandler: function (form) {
    create_guest(form);
    load_data();
  },
});

$("#create_timer_form").validate({
  // --
  submitHandler: function (form) {
    update_state_timer(form)
    load_data();
  },
});
var inputFechaInicio = document.getElementById("fechaInicio");
var inputFechaFin = document.getElementById("fechaFin");

// Obtiene la fecha actual en el formato "YYYY-MM-DD"
var fechaActual = new Date().toISOString().split("T")[0];

// Establece el atributo "min" en la fecha actual para ambos inputs
inputFechaInicio.setAttribute("min", fechaActual);
inputFechaFin.setAttribute("min", fechaActual);

function get_api() {
  const number_document = document.getElementById("document_number").value;
  const guestDocumentType = document.getElementById("client_document").value;

  if (guestDocumentType === "DNI") {
    fetch("https://consultardoc.ceatec.com.pe/dni/" + number_document)
      .then((response) => response.json())
      .then(function (data) {
        let nombres = `${data.nombres}`;
        let apellidos = `${data.apellido_paterno} ${data.apellido_materno}`;
        const nombreDocument = document.getElementById("nombre");
        const apellidoDocument = document.getElementById("apellido");
        const razon_social = document.getElementById("razon_social");

        razon_social.value = " ";

        nombreDocument.value = nombres;
        apellidoDocument.value = apellidos;
        console.log(data);
      })
      .catch(function (error) {
        console.error("Ha ocurrido un error");
        console.error(error);
      });
  } else {
    fetch(
      "https://dniruc.apisperu.com/api/v1/ruc/" +
      number_document +
      "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImRlbm9ibzU2OThAbG9jYXdpbi5jb20ifQ.EyjRFR8bKyCk6kFslAqpFp4Lu4p7VdixEjZy8NEJDRI",
    )
      .then((response) => response.json())
      .then((data) => {
        const razonSocial = data.razonSocial;
        const direccionRuc = data.direccion;
        const razon_social = document.getElementById("razon_social");
        const direccion = document.getElementById("direccion");
        const nombreDocument = document.getElementById("nombre");
        const apellidoDocument = document.getElementById("apellido");

        nombreDocument.value = " ";
        apellidoDocument.value = " ";
        razon_social.value = razonSocial;
        direccion.value = direccionRuc;
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
}

document
  .getElementById("client_document")
  .addEventListener("change", function () {
    const guestDocumentType = document.getElementById("client_document").value;
    const div_razon_social = document.getElementById("div_razon_social");
    const div_nombre = document.getElementById("div_nombre");
    const div_apellido = document.getElementById("div_apellido");

    if (guestDocumentType === "DNI") {
      div_razon_social.style.display = "none";
      div_apellido.style.display = "block";
      div_nombre.style.display = "block";
    } else if (guestDocumentType === "RUC") {
      div_apellido.style.display = "none";
      div_nombre.style.display = "none";
      div_razon_social.style.display = "block";
    }

    get_api();
  });

$("#buscar_huesped").on("click", function (e) {
  e.preventDefault();
  get_api();
});

guestDocument();



load_data();