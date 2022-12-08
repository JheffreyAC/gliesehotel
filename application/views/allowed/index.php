<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-layout="dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Gliese | Sin acceso</title>
    <link rel="apple-touch-icon" href="<?php echo BASE_URL ?>public/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12 p-4">
                        <div class="div-center">
                            <h2>Lo sentimos, usted no tiene los permisos necesarios para este módulo :(</h2>
                        </div>
                        <br>
                        <div class="div-center">
                            <h3><strong style="color: #7367f0;">Comuniquese con su administrador</strong> </h3> 
                        </div>
                    </div>
                    <div class="div-center">
                        <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_vU6KP7/Astronaut/astronaout.json"  background="transparent"  speed="1"  style="width: 600px; height: 600px;"  loop autoplay></lottie-player>
                    </div>
                    <div class="div-center" style="margin-top:50px;">
                        <button id="btn_return" type="button" class="btn btn-outline-primary waves-effect">Regresar al menú principal</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Functions JS-->
    <script src="<?php echo BASE_URL ?>application/core/Functions.js"></script>
    <!-- END Functions JS-->

    <!-- BEGIN: Config JS-->
    <script src="<?php echo BASE_URL ?>application/config/Config.js"></script>
    <!-- END Config JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/js/core/app.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- END: Theme JS-->

    <!-- BEGIN: Index JS -->
    <?php 
    if (isset($params['js']) && count($params['js'])) {
        foreach ($params['js'] as $js) { ?>
            <script src="<?php echo  $js; ?>"></script>
        <?php
        }
    }
    ?>
    <!-- END: Index JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>