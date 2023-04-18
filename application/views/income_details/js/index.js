// -- Functions
// --
function destroy_datatable_income() {
    // --
    $('#datatables-income').dataTable().fnDestroy();
}

// --
function refresh_datatable_income() {
    // --
    $('#datatables-income').DataTable().ajax.reload();
}

// --
function load_datatable_income() {
    // --
    destroy_datatable_income();
    // --
    let dataTable = $('#datatables-income').DataTable({
        // --
        ajax: {
            url: BASE_URL + '',
            cache: false,
        },
        columns: [
            { data: 'first_name' },
        ],
        // dom: functions.head_datatable(),
        // buttons: functions.custom_buttons_datatable([0,1], '#create_user_modal'), // -- Number of columns
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
function destroy_datatable_income_products() {
    // --
    $('#datatables-income-products').dataTable().fnDestroy();
}

// --
function refresh_datatable_income_products() {
    // --
    $('#datatables-income-products').DataTable().ajax.reload();
}

// --
function load_datatable_income_products() {
    // --
    destroy_datatable_income_products();
    // --
    let dataTable = $('#datatables-income-products').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Products/get_products',
            cache: false,
        },
        columns: [
            {
                class: 'center',
                render: function (data, type, row) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_add" data-process-key="'+ row.id_product +'">' +
                        feather.icons['plus'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
            { data: 'code' },
            { data: 'category' },
            { data: 'description' },      
            { data: 'stock' },
            
        ],
        // dom: functions.head_datatable(),
        // buttons: functions.custom_buttons_datatable([2], '#create_product_modal'), // -- Number of columns
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
function get_business_name() {
    // --
    $.ajax({
        url: BASE_URL + 'Suppliers/get_business_name',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.business_name +'</option>';
                });
                // -- Set values for select
                $('#create_income_details_form :input[name=business_name]').html(html);
            }
        }
    })
}

// --
function get_voucher_type() {
    // --
    $.ajax({
        url: BASE_URL + 'Main/get_voucher_type',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.description +'</option>';
                });
                // -- Set values for select
                $('#create_income_details_form :input[name=vt_description]').html(html);
            }
        }
    })
}

// --
function get_payment_type() {
    // --
    $.ajax({
        url: BASE_URL + 'Main/get_payment_type',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.description +'</option>';
                });
                // -- Set values for select
                $('#create_income_details_form :input[name=pt_description]').html(html);
            }
        }
    })
}

// --
function get_series() {
    // --
    $.ajax({
        url: BASE_URL + 'Income/get_series',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                let series = data.data[0]
                // -- Set values for select
                $('#create_income_details_form :input[name=proof_series]').val(series.proof_series);
                $('#create_income_details_form :input[name=voucher_series]').val(series.voucher_series);
            }
        }
    })
}

// -- Events

//--
//--
$(document).on('click', '.btn_add', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_product': value}
    // --
    $.ajax({
        url: BASE_URL + 'Products/get_product_by_id',
        type: 'GET',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: true,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // Get reference to the products table in the main window
                var table = $('#add_products');
                
                let item = data.data
                // Add a new row to the table with the data of the selected product
                table.append(getHtml(item));
                calcularSubtotal();
            }
        }
    })
});

function getHtml(item) {
    var stock=1;
    var purchase_price=1;
    var sale_price=1;
    return ` <tr>
    <td><button class="btn btn-danger btn-delete-product">X</button></td>
    <td>${item.description}</td>
    <td><input type="number" step="1" name="stock[]" id="stock'+cont+'" value="${+stock}" min=1 class="form-control"></td>
    <td><input type="number" step="1" name="purchase_price[]" id="purchase_price'+cont+'" value="${purchase_price}" min=1 class="form-control"></td>
    ${getPor()}
    <td><input type="number" step="1" name="sale_price[]" value="${sale_price}" min=1 class="form-control" ></td>
    <td><span name="subtotal" id="subtotal'+cont+'">aun falta</span></td>
</tr>`
}

function getPor() {
    return `
    <td>
        <select name="price_percentage[]" id="price_percentage'+cont+'" class="form-control">
            '<option value="10">10%</option>'+
            '<option value="15">15%</option>'+
            '<option value="20">20%</option>'+
            '<option value="25">25%</option>'+
            '<option value="30">30%</option>'+
           
            '<option value="40">40%</option>'+
           
            '<option value="50">50%</option>'+
        </select>
    </td>`
}

function calcularSubtotal() {
    $('#add_products tr').each(function(i, row) {
        var stock = parseInt($(row).find('input[name="stock[]"]').val());
        var purchasePrice = parseInt($(row).find('input[name="purchase_price[]"]').val());
        var subtotal = (stock * purchasePrice);
        $(row).find('span[name="subtotal"]').text(subtotal);
      });
  }
  

$(document).on('click', '.btn-delete-product', function() {
    // Delete the row corresponding to the button "x" clicked
    $(this).closest('tr').remove();
});


load_datatable_income();
load_datatable_income_products();
get_payment_type();
get_business_name();
get_voucher_type();
get_series();
