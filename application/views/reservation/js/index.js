
var events_calendar = [];
// --
document.addEventListener('DOMContentLoaded', upload_calendar());


async function upload_calendar() { 
    await load_data(); 
    // --
    function load_data() {
        return new Promise(function(resolve, reject) {
            $.ajax({
                url: BASE_URL + 'Reservation/get_reservations',
                cache: false,
                success: function (data) {
                    let datas = data.data;
                    console.log(datas);
                    for (const element of datas) {
                        // --

                        let colorEvents;
                        if(element.room_status == 'Disponible'){
                            colorEvents = '#28ca6a';
                        }else if(element.room_status == 'Ocupado'){
                            colorEvents = '#ea5455';
                        }else if(element.room_status == 'Limpieza'){
                            colorEvents = '#25a0fd';
                        }else if(element.room_status == 'Reservado'){
                            colorEvents = '#ff9f43';
                        }

                        // --
                        if(!(element.room_status == 'Disponible')){
                            let new_element = {
                                id: `${element.id_reservation}`,
                                title: `${element.room_number} - ${element.type_name} | Huesped: ${element.first_names} ${element.last_names}`,
                                start: element.checkin_date + " " + element.checkin_time,
                                end: element.checkout_date + " " + element.checkin_time,  
                                color: colorEvents
                            };
                            events_calendar.push(new_element);
                        }
                }
                resolve();
            }
        });
    });
}
    let today = new Date();
    let day = today.getDate();
    let formattedPreviousDay = `${today.getFullYear()}-${(today.getMonth() + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;

    // --
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        nextDayThreshold: '00:00:00',
        displayEventTime: false,
        eventDisplay: 'block',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek'
        },
        initialDate: formattedPreviousDay,
        navLinks: true, // can click day/week names to navigate views
        editable: false,
        nowIndicator: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: events_calendar,
        eventClick: function form_information(info) {
            const modal = document.getElementById('update_reservation_modal');
            const modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();
            for (let key in allTotalPrice) {
                allTotalPrice[key] = 0;
            }

            var eventObj = info.event;
            if (eventObj.id) {
                // $.ajax({
                //     url: BASE_URL + 'Reservation/get_sales_food',
                //     cache: false,
                //     data: {id_reservation: eventObj.id},
                //     success: function (data){
                //         let all_food_price = 0;
                //         $('#tbody-food').empty();
                //         for (let element of data.data) {
                //             let price_amount = element.food_price * element.amount_fd;
                //             $('#tbody-food').append('<tr><td>' + element.food_description + '</td><td> S/' + element.food_price.toLocaleString("es-ES", {minimumFractionDigits: 2, maximumFractionDigits: 2})   + '</td><td>' + element.amount_fd + '</td><td> S/ ' + price_amount.toLocaleString("es-ES", {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</td></tr>');
                //             all_food_price+= price_amount;
                //         }
                //         allTotalPrice.sales = parseFloat(all_food_price);
                //         $('#tbody-food').append('<tr><td class="fw-bold">Total</td> <td></td><td></td> <td class="fw-bold"> S/ ' + all_food_price.toLocaleString("es-ES", {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</td></tr>');
                //     },
                //     error: function (jqXHR, textStatus, errorThrown) {
                //         console.log("AJAX error: " + textStatus + " : " + errorThrown);
                //     }
                // });
                // $.ajax({
                //     url: BASE_URL + 'Reservation/get_sales_accessory',
                //     cache: false,
                //     data: {id_reservation: eventObj.id},
                //     success: function (data){
                //         let all_accessory_price = 0;
                //         $('#tbody-accessory').empty();
                //         for (let element of data.data) {
                //             let price_amount = element.accessory_price * element.amount_ac;
                //             $('#tbody-accessory').append('<tr><td>' + element.accessory_description + '</td><td> S/' + element.accessory_price.toLocaleString("es-ES", {minimumFractionDigits: 2, maximumFractionDigits: 2})   + '</td><td>' + element.amount_ac + '</td><td> S/ ' + price_amount.toLocaleString("es-ES", {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</td></tr>');
                //             all_accessory_price+= price_amount
                //         }
                //         allTotalPrice.sales += parseFloat(all_accessory_price);
                //         $('#tbody-accessory').append('<tr><td class="fw-bold">Total</td> <td></td><td></td> <td class="fw-bold"> S/ ' + all_accessory_price.toLocaleString("es-ES", {minimumFractionDigits: 2, maximumFractionDigits: 2}) + '</td></tr>');
                //     },
                //     error: function (jqXHR, textStatus, errorThrown) {
                //         console.log("AJAX error: " + textStatus + " : " + errorThrown);
                //     }
                // });
                $.ajax({
                    url: BASE_URL + 'Reservation/get_reservation',
                    cache: false,
                    data: {id_reservation : eventObj.id},
                    success: function (data){
                        let element = data.data;
                        console.log(element)
                        let numReservation = element.id_reservation.toString().padStart(2, '0');
                        // --
                        
                        $('input[name=id_reservation]').val(element.id_reservation);
                        $('#idReservation').text(numReservation);

                        // --
                        $('input[name=id_room]').val(element.id_room);
                        $('#numRoom').text(element.room_number);
                        $('input[name=type_room]').val(element.type_name);
                        $('input[name=bed_name]').val(element.bed_type);
                        $('input[name=person_limit]').val(element.person_limit);
                        $('.detalle-numH').text(element.room_number);
                        $('.detalle-tipoH').text(element.type_name);
                        $('.detalle-tipoC').text(element.bed_type);

                        // --
                        $('input[name=checkin_date]').val(element.checkin_date);
                        $('input[name=checkin_time]').val(element.checkin_time);
                        $('input[name=checkout_date]').val(element.checkout_date);
                        $('input[name=checkout_time]').val(element.checkout_time);
                        $('input[name=checkout_date]').attr("min", element.checkin_date);
                        $('input[name=checkin_date]').attr("max", element.checkout_date);
                        $('.detalle-entrada').text(`${element.checkin_date}  ${element.checkin_time}`);
                        $('.detalle-salida').text(`${element.checkout_date}  ${element.checkout_time}`);
                        
                        // --
                        $('.detalle-nombres').text(element.first_names);
                        $('.detalle-apellidos').text(element.last_names);
                        $('.detalle-nombresComp').text(element.first_names + " " + element.last_names)
                        $('.detalle-tipoDoc').text(element.document_type);
                        $('.detalle-numDoc').text(element.document_number);
                        $('.detalle-direccion').text(element.address);


                        var select = $("#mySelect");
                        if(element.room_status == "Disponible"){
                            select.prop("selectedIndex", 0);
                        }else if(element.room_status == "Ocupado"){
                            select.prop("selectedIndex", 1);
                        }else if(element.room_status == "Reservado"){
                            select.prop("selectedIndex", 2);
                        }else if(element.room_status == "Limpieza"){
                            select.prop("selectedIndex", 3);
                        }

                        allPricesRoom = [];
                        allPricesRoom.push(element.price_temporary);
                        allPricesRoom.push(element.price_half);
                        allPricesRoom.push(element.price_day);
                        paymentReservation(element.checkin_date + " " + element.checkin_time, element.checkout_date + " " + element.checkout_time, allPricesRoom, 0)
                        
                        element.payment_room == null || element.payment_room < 1 ? paymentReservation(element.checkin_date + " " + element.checkin_time, element.checkout_date + " " + element.checkout_time, allPricesRoom, 1) : ($('input[name=payment_room]').val(element.payment_room), allTotalPrice.room = parseFloat(element.payment_room));
                        
                        $('input[name=id_payment').val(element.id_payment);
                        element.payment_discount == null || element.payment_discount < 1 ? "" : $('input[name=payment_discount').val(element.payment_discount);
                        element.pre_payment == null || element.pre_payment < 1 ? "" : ($('input[name=payment_cancelled').val(element.pre_payment), allTotalPrice.cancelled = element.pre_payment);
                        element.payment_total == null || element.payment_total < 1 ? "" : $('input[name=payment_total').val(element.payment_total);
                        paymentAuto();
                    }
                })
            }
        }

        });

    calendar.render();
};

// --

var allPricesRoom = [];
var allTotalPrice = {
    room: 0,
    extra: 0,
    subTotal : 0,
    sales: 0,
    discount: 0,
    cancelled: 0,
}; 

function paymentReservation(dateIn, dateOut, prices, type){
    const fechaInicio = new Date(dateIn);
    const fechaFin = new Date(dateOut);
    const milisegundosInicio = fechaInicio.getTime();
    const milisegundosFin = fechaFin.getTime();

    let minutes = (milisegundosFin - milisegundosInicio) / (1000 * 60);
    let days = Math.floor(minutes / 1440);
    let minutesRes = minutes % 1440;
    let hours = Math.floor(minutesRes / 60);
    let minutesLeft = minutesRes % 60;

    let paymentRoom = 0;

    if (minutes <= 240) {
        paymentRoom = parseFloat(prices[0]);
        $('.detalle-tiempo').text(`
            ${hours < 1 ? ' ' : (hours == 1 ? hours + ' hora' : hours + ' horas')}
            ${minutesLeft < 1 ? ' ' : (minutesLeft == 1 ? minutesLeft + ' minuto' : minutesLeft + ' minutos')}
        `);
    } else if (minutes > 240 && minutes <= 720) {
        paymentRoom = parseFloat(prices[1]);
        $('.detalle-tiempo').text(`
            ${hours < 1 ? ' ' : (hours == 1 ? hours + ' hora' : hours + ' horas')}
            ${minutesLeft < 1 ? ' ' : (minutesLeft == 1 ? minutesLeft + ' minuto' : minutesLeft + ' minutos')}
        `);
    } else {
        let payment = parseInt(prices[2]) * days;
        let paymentMinutes = 0;
    
        // --
        if (minutesRes > 0 && minutesRes <= 240) {
            paymentMinutes = parseInt(prices[0]);
        } else if (minutesRes > 240 && minutesRes <= 720) {
            paymentMinutes = parseInt(prices[1]);
        } else {
            paymentMinutes = parseInt(prices[2]);
        }
        payment += paymentMinutes;

        paymentRoom = parseFloat(payment);
        $('.detalle-tiempo').text(`
            ${(days + '').padStart(2, '0')} ${days == 1 ? 'día' : 'días'}
            ${hours < 1 ? ' ' : (hours == 1 ? hours + ' hora' : hours + ' horas')}
            ${minutesLeft < 1 ? ' ' : (minutesLeft == 1 ? minutesLeft + ' minuto' : minutesLeft + ' minutos')}
        `);
    }

    if(type == 1){
        allTotalPrice.room = paymentRoom;
        $('input[name=payment_room]').val(parseFloat(paymentRoom));
    }else if(type == 2){    
        let price_extra = 0;
        $.ajax({
            url: BASE_URL + 'Reservation/get_payment_extra',
            cache: false,
            success: function(data){
                for(let value of data.data){
                    const minutes_define = (parseInt(value.extra_time.split(":")[0], 10) * 60) + parseInt(value.extra_time.split(":")[1], 10);
    
                    if(minutes > minutes_define){
                        price_extra = value.price_extra;
                    }
                }
                allTotalPrice.extra = parseFloat(price_extra);
                $('input[name=payment_extra]').val(parseFloat(price_extra));

                paymentAuto()
            }
        })
    }
} 

function paymentAuto(){
    let payment_subTotal = allTotalPrice.room + allTotalPrice.extra;
    allTotalPrice.subTotal = payment_subTotal;
    $('input[name=payment_subTotal]').val(payment_subTotal);


    let payment_total = (allTotalPrice.subTotal + allTotalPrice.sales) - (allTotalPrice.discount + allTotalPrice.cancelled);
    $('input[name=payment_total]').val(payment_total);
}

$('#departure_btn').on('click', function(){
    // --
    let today = new Date();
    let day = today.getDate();
    let formattedPreviousDay = `${today.getFullYear()}-${(today.getMonth() + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
    let previousTime = today.toString();
    let formattedPreviousTime = previousTime.split(" ");

    $('input[name=departure_date]').val(formattedPreviousDay);
    $('input[name=departure_time]').val(formattedPreviousTime[4].substring(0, 5));

    // --
    // $('#departure_btn').attr('disabled', false);
    let valCheckout= $('input[name=checkout_date]').val() + " " + $('input[name=checkout_time]').val();
    let valDepurate = formattedPreviousDay + " " +  formattedPreviousTime[4].substring(0, 5);

    paymentReservation(valCheckout, valDepurate, allPricesRoom, 2);
})

// --

function valDate (){
    let valCheckin = $('input[name=checkin_date]').val() + " " + $('input[name=checkin_time]').val();
    let valCheckout= $('input[name=checkout_date]').val() + " " + $('input[name=checkout_time]').val();

    let valDateInitial = $('input[name=checkin_date]').val()
    $('input[name=checkout_date]').attr("min", valDateInitial);
    

    $('input[name=checkout_date]').attr("min", $('input[name=checkin_date]').val());
    $('input[name=checkin_date]').attr("max", $('input[name=checkout_date]').val());

    paymentReservation(valCheckin, valCheckout, allPricesRoom, 1);
}

$('input[name="checkin_date"]').on('change', ()=>{ valDate() });
$('input[name="checkin_time"]').on('change', ()=>{ valDate() });
$('input[name="checkout_date"]').on('change', ()=>{ valDate() });
$('input[name="checkout_time"]').on('change', ()=>{ valDate() });


$('input[name=payment_discount]').on('input', function (){
    let discount = $('input[name=payment_discount]').val()
    allTotalPrice.discount = discount;
    paymentAuto();
})

$('input[name=payment_extra]').on('input', function (){
    let extra = $('input[name=payment_extra]').val()
    allTotalPrice.extra = extra;
    paymentAuto();
})



//--
function update_reservation(form) {
    // --
    $('#update_reservation_form').prop('disabled', true);
    // --
    let params = new FormData(form);
    console.log(form);
    // --
    $.ajax({
        url: BASE_URL + 'Reservation/update_reservation',
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
                $('#update_reservation_modal').modal('hide');
                events_calendar = [];
                upload_calendar();

            } else {
                // --
                $('#btn_update_reservation').prop('disabled', false);
            }
        }
    })
}

// -- Validate form
$('#update_reservation_form').validate({
    // --
    submitHandler: function(form) {
        update_reservation(form);
        
    }
})

$(document).on('click', '#btn_finish_reservation', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    // let params = {'id_role': value}
    // --
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Una vez finalizada la reserva, no se podrán realizar cambios en la misma. Los detalles de la reserva se podrán consultar en cualquier momento.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Si, finalizar!',
        customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-1'
        },
        buttonsStyling: false,
        preConfirm: _ => {
            return $.ajax({
                // url: BASE_URL + 'Roles/delete_role',
                // type: 'POST',
                // data: params,
                // dataType: 'json',
                // cache: false,
                // success: function(data) {
                //     // --
                //     functions.toast_message(data.type, data.msg, data.status);
                //     // --
                //     if (data.status === 'OK') {
                //         // --
                //         refresh_datatable();
                //     }
                // }
            })
        }
    }).then(result => {
        if (result.isConfirmed) {
        }
    });
})