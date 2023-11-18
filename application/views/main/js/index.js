// -- Functions
$(".main-loading").addClass("hidden-loading");

/**
 * Initialize all selectors with class select2
 */
function initializeSelectors() {
  // --
  var select = $(".select2");
  // --
  select.each(function () {
    // --
    var $this = $(this);
    // --
    $this
      .select2({
        // --
        placeholder: "Seleccionar",
        language: {
          noResults: function (params) {
            return "No se encontraron resultados";
          },
        },
        dropdownParent: $this.parent(),
        allowClear: true,
        width: "100%",
      })
      .change(function () {
        $(this).valid();
      });
  });
  // --
  $(".select2-search__field").css("width", "100%");
}

// -- Events

/**
 * Logout
 */
// --
$(document).on("click", "#dropdown-logout", function () {
  // --
  logout();
});

// --
function logout() {
  // --
  $.ajax({
    url: BASE_URL + "Main/close_session",
    type: "POST",
    dataType: "json",
    cache: false,
    beforeSend: function () {
      console.log("Cargando...");
    },
    success: function (data) {
      // --
      if (data.status === "OK") {
        // --
        localStorage.clear();
        window.location.replace(BASE_URL + "Login");
      }
    },
  });
}

// --
initializeSelectors();
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
