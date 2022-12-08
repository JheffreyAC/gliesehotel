// -- Events

// -- Functions

function check_session() {
    // --
    // let token = localStorage.getItem('token');
    // --
    $.ajax({
        url: BASE_URL + 'Dashboards/get_dashboard',
        type: 'GET',
        dataType:'json',
        cache: false,
        success: function(data) { 
            // --
            // if (data.status === 'TOKEN_ERROR') {
            //     window.location.replace(BASE_URL + 'Login');
            // }
            console.log(data)
        }				
    })
}
check_session()
// -- Init
// let statusPermission = functions.verified_permission('dashboards');