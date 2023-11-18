// -- Functions

// --
function destroy_datatable() {
  // --
  $("#datatable-kardex").dataTable().fnDestroy();
}

// --
function refresh_datatable() {
  // --
  $("#datatable-kardex").DataTable().ajax.reload();
}

function load_datatable() {
  // --
  destroy_datatable();
  let dataTable = $("#datatable-kardex").DataTable({
    ajax: {
      url: BASE_URL + "Kardex/get_kardex",
      cache: false,
    },
    columns: [
      { data: "code" },
      { data: "product" },
      { data: "category" },
      { data: "entry" },
      { data: "exit" },
      { data: "balance" },
      {
        class: "center",
        render: function (data, type, row) {
          // --
          return `
            <div>
              <button class="btn btn-error">${row.code}</button>
              <button class="btn btn-danger">${row.code}</button>
            </div>`;
        },
      },
    ],
    dom: functions.head_datatable(),
    buttons: functions.custom_buttons_datatable([2]),
    language: {
      url: BASE_URL + "public/assets/json/languaje-es.json",
    },
  });

  //
  dataTable.on("xhr", function () {
    //
    var data = dataTable.ajax.json();
    functions.toast_message(data.type, data.msg, data.status);
  });
}

load_datatable();
