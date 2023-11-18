let colorsRooms = {
  Disponible: "success",
  Ocupado: "danger",
  Limpieza: "info",
  Reservado: "warning",
};

function load_data() {
  // Realiza una solicitud AJAX para obtener los datos desde el servidor
  $.ajax({
    url: BASE_URL + "Reservation/get_reservations",
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
          $(
            "#data-container"
          ).append(`<div class="card bg-${bgClass} text-light" style="width: 18rem; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 10px;">
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
                <button class="btn bg-light text-dark btn-icon btn-md btn_sales" data-process-key="${row.id_reservation}"  >
                 <i class="fa-solid fa-cart-shopping"></i>
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
      console.error("Fallo al obtener los datos.");
      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
}

//--

$(document).on("click", ".btn_add", function () {
  let value = $(this).attr("data-process-key");
  let params = { id_product: value };

  $.ajax({
    url: BASE_URL + "Product/get_product_by_id",
    type: "GET",
    data: params,
    dataType: "json",
    contentType: false,
    processData: true,
    cache: false,
    beforeSend: function () {
      console.log("Cargando...");
    },
    success: function (data) {
      if (data.status === "OK") {
        var table = $("#add_products");
        let item = data.data;
        table.append(getHtml(item));
        calcularSubtotal();
      }
    },
  });
});

function getHtml(item) {
  var cont = $(".btn_add").length + 1;
  return `
    <tr class="text-center">
      <td><button class="btn btn-danger btn-delete-product"><i class="fa fa-x"></i></button></td>
      <td>${item.product_name}</td>
      <td><input type="number" name="stock[]" value="1" class="form-control" oninput="calcularSubtotal(this)"></td>
      <td><input type="number" step="0.1" name="purchase_price[]" value="1" min="0.1" class="form-control" oninput="calcularSubtotal(this)"></td>
      ${getPercentage(cont)}
      <td><span class="subtotal" data-value="1">S/ 1.00</span></td>
    </tr>`;
}

function calcularSubtotal(element) {
  var row = $(element).closest("tr");
  var stock = parseInt(row.find('input[name="stock[]"]').val());
  var purchasePrice = parseFloat(
    row.find('input[name="purchase_price[]"]').val()
  );
  var percentage = parseInt(
    row.find('select[name="price_percentage[]"]').val()
  );
  var subtotal = stock * purchasePrice;
  var discountAmount = (subtotal * percentage) / 100;
  var discountedSubtotal = subtotal - discountAmount;
  var soles = discountedSubtotal.toLocaleString("es-PE", {
    style: "currency",
    currency: "PEN",
  });
  row.find("span.subtotal").text(soles);
  calcularTotal();
}

function calcularTotal() {
  var total = 0;
  $(".subtotal").each(function () {
    var subtotalValue = parseFloat(
      $(this).text().replace("S/", "").replace(",", "")
    );
    total += isNaN(subtotalValue) ? 0 : subtotalValue;
  });
  var totalFormatted = total.toLocaleString("es-PE", {
    style: "currency",
    currency: "PEN",
  });
  $("#total-sales-price").text(totalFormatted);
}

function getPercentage(cont) {
  return `
    <td>
      <select name="price_percentage[]" class="form-control" onchange="calcularSubtotal($(this).closest('tr'))">
        <option value="0">0%</option>
        <option value="10">10%</option>
        <option value="15">15%</option>
        <option value="20">20%</option>
        <option value="25">25%</option>
        <option value="30">30%</option>
        <option value="40">40%</option>
        <option value="50">50%</option>
      </select>
    </td>`;
}

function destroy_datatable_income_products() {
  // --
  $("#datatables-income-products").dataTable().fnDestroy();
}

function load_datatable_income_products() {
  // --
  destroy_datatable_income_products();
  // --
  let dataTable = $("#datatables-income-products").DataTable({
    // --
    ajax: {
      url: BASE_URL + "Product/get_product",
      cache: false,
    },
    columns: [
      {
        class: "center",
        render: function (data, type, row) {
          // --
          return (
            '<button class="btn btn-sm btn-info btn-round btn-icon btn_add" data-process-key="' +
            row.id_product +
            '">' +
            feather.icons["plus"].toSvg({ class: "font-small-4" }) +
            "</button>"
          );
        },
      },
      { data: "product_sku" },
      { data: "product_name" },
      { data: "product_description" },
      { data: "description" },
    ],
    // dom: functions.head_datatable(),
    // buttons: functions.custom_buttons_datatable([2], '#create_product_modal'), // -- Number of columns
    language: {
      url: BASE_URL + "public/assets/json/languaje-es.json",
    },
  });

  // --
  dataTable.on("xhr", function () {
    // --
    var data = dataTable.ajax.json();
    // --
    functions.toast_message(data.type, data.msg, data.status);
  });
}
load_datatable_income_products();

$(document).on("click", ".btn_sales", function () {
  // --
  let value = $(this).attr("data-process-key");
  // --
  console.log(value);
  // --
  $.ajax({
    url: BASE_URL + "Reservation/get_reservation",
    type: "GET",
    data: { id_reservation: value },
    dataType: "json",
    contentType: false,
    processData: true,
    cache: false,
    success: function (data) {
      // --
      console.log(data);

      if (data.status === "OK") {
        // console.log(data + "fdgxd");
        // // --
        let item = data.data;
        // // --
        console.log(data.data);
        // console.log(item);
        $("#create_sales_form :input[name=room_number]").val(item.room_number);
        $("#create_sales_form :input[name=type_name]").val(item.type_name);
        $("#create_sales_form :input[name=document_type]").val(
          item.document_type
        );
        $("#create_sales_form :input[name=document_number]").val(
          item.document_number
        );
        if (item.document_type === "DNI") {
          $("#company_names").hide();
          $("#first_names").show();
          $("#last_names").show();
          $("#create_sales_form :input[name=first_names]").val(
            item.first_names
          );
          $("#create_sales_form :input[name=last_names]").val(item.last_names);
          $("#create_sales_form :input[name=address]").val(item.address);
        } else {
          $("#company_names").show();
          $("#first_names").hide();
          $("#last_names").hide();
          $("#create_sales_form :input[name=address]").val(item.address);
          $("#create_sales_form :input[name=company_name]").val(
            item.company_name
          );
        }
        // hola mundo xd
        // $("#create_sales_form :input[name=id_room]").val(item.id_room);
        // -- Otras asignaciones de valores para los campos de actualización
      }
    },
    error: function () {
      console.error("Fallo al obtener los datos.");

      functions.toast_message("error", "Error al obtener los datos", "Error");
    },
  });
  // --
  $("#sales_modal").modal("show");
});
$(document).on("click", ".btn-delete-product", function () {
  // Delete the row corresponding to the button "x" clicked
  $(this).closest("tr").remove();
});

function sayHi(){
  console.log('Hola mundo!');
}

sayHi()

load_data();
