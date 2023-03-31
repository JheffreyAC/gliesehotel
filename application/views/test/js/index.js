// -- Functions

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
                $('#test :input[name=business_name]').html(html);
                $('#test :input[name=business_name]').html(html);
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
                $('#test :input[name=vt_description]').html(html);
                $('#test :input[name=vt_description]').html(html);
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
                $('#test :input[name=pt_description]').html(html);
                $('#test :input[name=pt_description]').html(html);
            }
        }
    })
}

// --
function create_income(form) {
    // --
    $('#btn_create_income').prop('disabled', true);
    // --
    let params = new FormData(form);
    // --
    $.ajax({
        url: BASE_URL + 'Test/create_income',
        type: 'POST',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            functions.toast_message(data.type, data.msg, data.status);
            // --
            if (data.status === 'OK') {
                // --
                $('#create_income_modal').modal('hide');
                form.reset();
                refresh_datatable();

            } else {
                // --
                $('#btn_create_income').prop('disabled', false);
            }
        }
    })
}

// -- Events

// -- Reset forms
$(document).on('click', '.reset', function() {
    // --
    $('#create_income_form').validate().resetForm();
})

// -- Validate form
$('#create_income_form').validate({
    // --
    submitHandler: function(form) {
        create_income(form);
    }
})

// -- Reset form on modal hidden
$('.modal').on('hidden.bs.modal', function () {
    // --
    $(this).find('form')[0].reset();
    // --
    $('#btn_create_income').prop('disabled', false);
});


get_payment_type();
get_business_name();
get_voucher_type();
// --