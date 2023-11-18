// --
function load_datatable() {
    // --
    // --
    let dataTable = $('#datatable-meal').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Meal/get_meal',
            cache: false,
        },
        columns: [
            { data: 'meal_sku' },
            { data: 'meal_name' },  
            { data: 'meal_description' },
            { data: 'description' }, 
            { data: 'meal_price' },          
         /**{ data: 'ts_start'},*/ 
            {
                class: 'center',
                render: function (data, type, row) {
                    // --
                    
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_update" data-process-key="'+ row.id_meal +'">' +
                        feather.icons['edit'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                        + ' ' + 
                        '<button  class="btn btn-sm btn-danger btn-round btn-icon btn_delete" data-process-key="'+ row.id_meal+'">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                },
                error: function () {
                    console.error('Fallo al obtener los datos.');
              
                    functions.toast_message('error', 'Error al obtener los datos', 'Error');
                  }
                
            }, 
        ],
        dom: functions.head_datatable(),
        buttons: functions.custom_buttons_datatable([2], '#create_meal_modal'), // -- Number of columns
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
load_datatable();  