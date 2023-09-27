// --
function load_datatable() {
    // --
    // --
    let dataTable = $('#datatable-Food').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Food/get_food',
            cache: false,
        },
        columns: [
            { data: 'id_food' },
            { data: 'food_description' },
            { data: 'food_price' },
            { data: 'food_stock' },
            { data: 'tipo_food' },
            /**{ data: 'ts_start'},*/
            {
                class: 'center',
                render: function (data, type, row) {
                    // --

                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="' + row.id_food + '">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' +
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="' + row.id_food + '">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([2], '#create_food_modal'), // -- Number of columns
        language: {
            url: BASE_URL + 'public/assets/json/languaje-es.json'
        }
    })

    // --
    dataTable.on('xhr', function () {
        // --
        var data = dataTable.ajax.json();
        // --
        functions.toast_message(data.type, data.msg, data.status);
    });
}

// --

load_datatable();