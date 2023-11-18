// -- Events

// --
$("#login-login").click(function () {
  login();
});

// --
$("#login-password").keypress(function (e) {
  // --
  let code = e.keyCode ? e.keyCode : e.which;
  if (code === 13) {
    login();
  }
});

// -- Functions
// --
function login() {
  // --
  let user = $("#login-user").val();
  let password = $("#login-password").val();
  // --
  if (user === "" || password === "") {
    // -- https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-extensions.html#toastr
    // --
    toastr["warning"](
      "👋 Es necesario ingresar usuario y contraseña.",
      "Ups!",
      {
        closeButton: true,
        tapToDismiss: false,
      }
    );
  } else {
    // --
    let params = {
      user: user,
      password: password,
    };
    // --
    $.ajax({
      url: BASE_URL + "Login/login",
      type: "POST",
      data: params,
      dataType: "json",
      cache: false,
      success: function (data) {
        // --
        if (data.status === "OK") {
          // -- Redirect
          window.location.replace(BASE_URL + "Reservation");
        } else {
          // --
          toastr["error"](data.msg, "Ups!", {
            closeButton: true,
            tapToDismiss: false,
          });
        }
      },
    });
  }
}
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
        const company = document.getElementById("company");
        const company_name = document.getElementById("company_name");
        $.each(data.data, function (index, row) {
          company.innerHTML = `${row.company_name}, ${row.address}, RUC: ${row.ruc}`;
          company_name.textContent = `${row.company_name}`;
        });
        // functions.toast_message(data.type, data.msg, data.status);
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

load_data();
