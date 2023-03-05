// -- Events

// --
$("#login-login").click(function() {
    login();
});

// -- 
$("#login-password").keypress(function(e) {
    // -- 
    let code = (e.keyCode ? e.keyCode : e.which);
    if (code === 13) {
        login();
    }
})


// -- Functions
// --
function login() {
    // --
    let user = $('#login-user').val();
    let password = $('#login-password').val();
    // -- 
    if (user === '' || password === '') {
        // -- https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/documentation/documentation-extensions.html#toastr
        // --
        toastr['warning']('👋 Es necesario ingresar usuario y contraseña.', 'Ups!', {
            closeButton: true,
            tapToDismiss: false
        });

    } else {
        // --
        let params = {
            'user': user,
            'password': password,
        }
        // --
        $.ajax({
            url: BASE_URL + 'Login/login',
            type: 'POST',
            data: params,
            dataType:'json',
            cache: false,
            success: function(data) { 
                // --
                if (data.status === 'OK') {
                    // -- Redirect
                    window.location.replace(BASE_URL + 'Dashboards');
                } else {
                    // --
                    toastr['error'](data.msg, 'Ups!', {
                        closeButton: true,
                        tapToDismiss: false,
                    });
                }
            }				
        })
    }   
}

    