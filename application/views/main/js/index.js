
// -- Functions
$('.main-loading').addClass('hidden-loading');


/**
 * Initialize all selectors with class select2
 */
function initializeSelectors() {
    // --
    var select = $('.select2');
    // -- 
    select.each(function () {
        // --
        var $this = $(this);
        // --
        $this.select2({
            // --
            placeholder: 'Seleccionar',
            language: {
                noResults: function (params) {
                  return 'No se encontraron resultados';
                }
            },
            dropdownParent: $this.parent(),
            allowClear: true,
            width: '100%'
        })
        .change(function () {
            $(this).valid();
        });
    });
    // --
    $('.select2-search__field').css('width', '100%');
}


// -- Events


/**
 * Logout
 */
// --
$(document).on('click', '#dropdown-logout', function() {
    // --
    logout()
})

// --
function logout() {
    // --
    $.ajax({
        url: BASE_URL + 'Main/close_session',
        type: 'POST',
        dataType:'json',
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                localStorage.clear();
                window.location.replace(BASE_URL + 'Login');
            }
        }
    })
}

// --
initializeSelectors();
