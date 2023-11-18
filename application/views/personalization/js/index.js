function load_data() {
  // Realiza una solicitud AJAX para obtener los datos desde el servidor
  $.ajax({
    url: BASE_URL + "Personalization/get_company_profile",
    type: "GET",
    dataType: "json", // Espera una respuesta JSON
    cache: false,
    success: function (data) {
      if (data.status === "OK") {
        // Borra el contenido anterior del contenedor
        // const company = document.getElementById("company");
        const company_name = document.getElementById("company_name_form");
        const company_address = document.getElementById("company_address_form");
        const company_ruc = document.getElementById("company_ruc_form");
        $.each(data.data, function (index, row) {
          company_name.value = row.company_name;
          company_address.value = row.address;
          company_ruc.value = row.ruc;
        });
      } else {
        // Muestra un mensaje de tostada en caso de error
        // functions.toast_message(data.type, data.msg, data.status);
      }
    },
    // error: function () {
    //   console.error("Fallo al obtener los datos.");
    //   functions.toast_message("error", "Error al obtener los datos", "Error");
    // },
  });
}

function create_company_profile(form) {
  // --
  // $('#btn_create_habitacion').prop('disabled', true);
  // --
  let params = new FormData(form);
  // --
  $.ajax({
    url: BASE_URL + "Personalization/create_company_profile", // Reemplaza 'create_habitacion' con la ruta correcta de creación de habitaciones
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
      functions.toast_message(data.type, data.msg, data.status);
      // --
      const company_name = document.getElementById("company_name_form");
      const company_address = document.getElementById("company_address_form");
      const company_ruc = document.getElementById("company_ruc_form");
      const company_logo = document.getElementById("company_logo_form");
      if (data.status === "OK") {
        load_data();
      } else {
        // $("#btn_create_habitacion").prop("disabled", false);
      }
      company_name.disabled = true;
      company_address.disabled = true;
      company_ruc.disabled = true;
      company_logo.disabled = true;
    },
  });
}
$("#personalization_form").validate({
  // --
  submitHandler: function (form) {
    create_company_profile(form);
  },
});

// function enable_personalization() {
//   const company_name = document.getElementById("company_name_form");
//   const company_address = document.getElementById("company_address_form");
//   const company_ruc = document.getElementById("company_ruc_form");
//   const company_logo = document.getElementById("company_logo_form");
//   company_name.disabled = false;
//   company_address.disabled = false;
//   company_ruc.disabled = false;
//   company_logo.disabled = false;
// }

// $("#edit_personalization").on("click", function () {
//   enable_personalization();
// });

load_data();
