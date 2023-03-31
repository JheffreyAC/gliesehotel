// -- Functions

// --
function get_social_reason() {
    // --
    $.ajax({
        url: BASE_URL + 'Suppliers/get_social_reason',
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
                $('#test :input[name=v_description]').html(html);
                $('#test :input[name=v_description]').html(html);
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
                $('#test :input[name=p_description]').html(html);
                $('#test :input[name=p_description]').html(html);
            }
        }
    })
}

get_payment_type();
get_social_reason();
get_voucher_type();
// --