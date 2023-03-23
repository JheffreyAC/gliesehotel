// -- Class Functions
class Functions {

    /**
     * Decrypt code in hexadecimal and base64
     * @param {*} string 
     */
    decrypt_hex64JS(string) {
        // --
        let i = 0
        let l = string.length - 1
        let bytes = []
        // --
        for (i; i < l; i += 2) {
          bytes.push(parseInt(string.substr(i, 2), 16))
        }
        // --
        let code = String.fromCharCode.apply(String, bytes)
        code = atob(code)
        // -- 
        return code
    }


    /**
     * Encrypt code in hexadecimal and base64
     * @param {*} string 
     */
    encrypt_hex64JS(string) {
        // --
        let i = 0
        let l = string.length
        let chr
        let hex = ''
        // --
        for (i; i < l; i++) {
            // --
            chr = string.charCodeAt(i).toString(16);
            hex += chr.length < 2 ? '0' + chr : chr;
        }
        // --
        let code = btoa(hex);
        // --
        return code
    }
    
    /**
     * Toast message
     * @param {*} type 
     * @param {*} message 
     * @param {*} title 
     */
    toast_message(type, message, title) {
        // --
        toastr[type](message, title, {
            positionClass: 'toast-bottom-right'
        });
    }

    /**
     * 
     * @returns 
     */
    head_datatable() {
        // --
        let dom = '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>';
        return dom;
    }


   
    /**
     * Verified if you have the permissions for this view
     * @param {*} view 
     * @returns 
     */
    verified_permission(view) {
        // --
        let permissions = localStorage.getItem('permissions');
        let arrayPermissions = permissions.split(',');
        // --
        var statusPermission = false;
        // --
        arrayPermissions.forEach(item => {
            if (item === view) {
                statusPermission = true;
            }
        })
        // --
        if (!statusPermission) {
            // --
            this.toast_message('error', 'No tiene permiso para esta vista :(', 'ERROR');
            // --
            $('.app-content').hide();
            $('.lottie-content').show();
        }
        // --
        return statusPermission;
    }

    /**
     * Custom buttons for datatable
     * @param {*} columns
     * @param {*} modal // -- ID 
     */
    custom_buttons_datatable(columns, modal) {
        // --
        let buttons = [
            {
                extend: 'collection',
                className: 'btn btn-outline-secondary dropdown-toggle me-2',
                text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + '<span>Exportar</span>',
                buttons: [
                {
                    extend: 'print',
                    text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
                    className: 'dropdown-item',
                    exportOptions: { columns: columns }
                },
                {
                    extend: 'csv',
                    text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
                    className: 'dropdown-item',
                    exportOptions: { columns: columns }
                },
                {
                    extend: 'excel',
                    text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
                    className: 'dropdown-item',
                    exportOptions: { columns: columns }
                },
                {
                    extend: 'pdf',
                    text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
                    className: 'dropdown-item',
                    exportOptions: { columns: columns }
                },
                {
                    extend: 'copy',
                    text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
                    className: 'dropdown-item',
                    exportOptions: { columns: columns }
                }
                ],
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                    $(node).parent().removeClass('btn-group');
                    setTimeout(function () {
                        $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                    }, 50);
                }
            },
            {
                text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + '<span>Agregar</span>',
                className: 'create-new btn btn-primary',
                attr: {
                    'data-bs-toggle': 'modal',
                    'data-bs-target': modal
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }
        ];
        // --
        return buttons;
    }

    /**
    * Custom buttons for data table tabs
    * @param {*} eyelash // -- Pestañas
    */ 
    custom_tab_button_data_table(eyelash) {
        // --
        let buttons = [
            {
                text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + '<span>Agregar</span>',
                className: 'create-new btn btn-primary',
                attr: {
                    'data-bs-toggle': 'eyelash',
                    'data-bs-target': eyelash
                },
                init: function (api, node, config) {
                    $(node).removeClass('btn-secondary');
                }
            }
        ];
        // --
        return buttons;
    }

    /**
     * @param String name
     * @return String
     */
    get_parameter_by_name(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

}