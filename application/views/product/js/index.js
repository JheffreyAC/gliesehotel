// --
function load_datatable() {
    // --
    // --
    let dataTable = $('#datatable-Product').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Product/get_Product',
            cache: false,
        },
        columns: [
            { data: 'product_sku'},
            { data: 'product_name'},
            { data: 'product_description'},
            { data: 'description'},
            { data: 'product_price'},
            { data: 'product_stock'},
            { data: 'expiration_date'},
            { data: 'status_expiration_date',
            render: function (data, type, row) {
                if (data === 1) {
                    return '<span class="badge rounded-pill badge-light-success" text-capitalized="">Vigente</span>';
                } else if (data === 0) {
                    return '<span class="badge rounded-pill badge-light-danger" text-capitalized="">Expirado</span>';
                }
                return '<span class="badge rounded-pill badge-light-success" text-capitalized="">Vigente</span>';
            }
        }, 
            /**{ data: 'ts_start'},*/
            {
                class: 'center',
                render: function (data, type, row) {
                    // --

                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="' + row.id_product + '">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' +
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="' + row.id_product + '">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([2], '#create_product_modal'), // -- Number of columns
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