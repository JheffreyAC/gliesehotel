


// --
function load_datatable() {
    // --
    // --
    let dataTable = $('#datatable-accessories').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Accessories/get_accessories',
            cache: false,
        },
        columns: [
            { data: 'id_accesory' },
            { data: 'accesory_description' },
            { data: 'accesory_price' }, 
            { data: 'accesory_stock' },         
         /**{ data: 'ts_start'},*/ 
            {
                class: 'center',
                render: function (data, type, row) {
                    // --
                    
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_accesory +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_accesory +'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([2], '#create_accessories_modal'), // -- Number of columns
        language: {
            url: BASE_URL + 'public/assets/json/languaje-es.json'
        }
    })

    // --
    dataTable.on('xhr', function() {
        // --
        var data = dataTable.ajax.json();
        // --
        functions.toast_message(data.type, data.msg, data.status);
    });
}

// --

load_datatable();