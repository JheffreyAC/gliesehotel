<!DOCTYPE html>
<html class="loading semi-dark-layout" lang="en" data-layout="semi-dark-layout" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="<?php echo BASE_URL ?>public/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/vendors/css/extensions/toastr.min.css">
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
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/pages/authentication.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>public/app-assets/css/plugins/extensions/ext-component-toastr.css">
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
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="index.html">
                            <svg xmlns="http://www.w3.org/2000/svg" height="50" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 160.11 28.02">
                                <defs>
                                    <style>
                                        .cls-1,
                                        .cls-3 {
                                            fill: #17223b;
                                        }

                                        .cls-2 {
                                            fill: url(#Degradado_sin_nombre);
                                        }

                                        .cls-3 {
                                            stroke: #17223b;
                                            stroke-miterlimit: 29.78;
                                            stroke-width: 0.25px;
                                        }
                                    </style>
                                    <linearGradient id="Degradado_sin_nombre" x1="948.58" y1="781.23" x2="948.58" y2="778.02" gradientTransform="matrix(3.93, 0, 0, -3.93, -3712.11, 3076.46)" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#6c5b7b" />
                                        <stop offset="1" stop-color="#ff6768" />
                                    </linearGradient>
                                </defs>
                                <g id="Capa_2" data-name="Capa 2">
                                    <g id="SvgjsSvg1857613">
                                        <g id="SvgjsG1857615">
                                            <g id="SvgjsG527778">
                                                <g id="SvgjsG527779">
                                                    <path class="cls-1" d="M0,0H28V28H0Z" />
                                                </g>
                                                <g id="SvgjsG527783">
                                                    <path class="cls-2" d="M18.93,13a.29.29,0,0,1-.14-.23v-3a.3.3,0,0,0-.13-.23l-3.1-1.79a.32.32,0,0,0-.27,0L12.72,9.22a.24.24,0,0,1-.26,0L9.89,7.74a.32.32,0,0,0-.27,0L6.52,9.53a.3.3,0,0,0-.13.23v3.58a.29.29,0,0,0,.13.23l2.57,1.49a.29.29,0,0,1,.13.23v3a.27.27,0,0,0,.14.23l3.1,1.8a.3.3,0,0,0,.26,0l2.57-1.49a.32.32,0,0,1,.27,0l2.57,1.49a.3.3,0,0,0,.26,0l3.11-1.8a.29.29,0,0,0,.13-.23V14.67a.32.32,0,0,0-.13-.23L18.93,13Zm-3.37,1.18a.32.32,0,0,1-.27,0l-1.5-.87a.09.09,0,0,1,0-.16l1.5-.87a.32.32,0,0,1,.27,0l1.5.87c.08.05.08.11,0,.16l-1.5.87Zm-3.1-.26a.3.3,0,0,1,.26,0l1.51.87a.08.08,0,0,1,0,.15l-1.51.87a.24.24,0,0,1-.26,0L11,14.9a.08.08,0,0,1,0-.15l1.51-.87ZM9.62,9a.32.32,0,0,1,.27,0l1.5.87c.08,0,.08.11,0,.15l-1.5.87a.32.32,0,0,1-.27,0L8.12,10c-.08,0-.08-.11,0-.15ZM7.45,11c0-.08.06-.12.14-.07l2,1.17a.32.32,0,0,0,.27,0L15.29,9a.32.32,0,0,1,.27,0l2,1.18a.29.29,0,0,1,.13.23v1.73c0,.09-.06.12-.13.08l-2-1.18a.32.32,0,0,0-.27,0l-5.4,3.13a.32.32,0,0,1-.27,0L7.59,13a.29.29,0,0,1-.14-.23Zm3,6.88a.3.3,0,0,1-.13-.23V15.9c0-.08.06-.12.13-.07l2,1.17a.3.3,0,0,0,.26,0l5.41-3.12a.3.3,0,0,1,.26,0l2,1.18a.26.26,0,0,1,.13.23V17c0,.08,0,.11-.13.07l-2-1.17a.26.26,0,0,0-.27,0l-5.41,3.12a.3.3,0,0,1-.26,0Zm6.2.31c-.07,0-.07-.11,0-.16l1.51-.87a.32.32,0,0,1,.27,0l1.5.87c.07.05.07.12,0,.16l-1.51.87a.3.3,0,0,1-.26,0l-1.51-.87Z" />
                                                </g>
                                                <rect id="SvgjsRect527784" class="cls-1" x="32.59" width="0.48" height="28.02" />
                                                <g id="SvgjsG527785">
                                                    <path class="cls-3" d="M44.36,4.16H37.65v.68h3v9.57h.7V4.84h3Zm8.77,0H46.81V14.41h6.52v-.68H47.51V9.59h5.06V8.91H47.51V4.84h5.62Zm9.22,10.12a4.85,4.85,0,0,0,1.43-.59V9.75h-3v.68h2.31v2.84a4,4,0,0,1-1.13.41,5.79,5.79,0,0,1-1.28.15,4.74,4.74,0,0,1-2.38-.58,4.13,4.13,0,0,1-1.6-1.61,4.67,4.67,0,0,1-.57-2.3A4.61,4.61,0,0,1,56.71,7a4.36,4.36,0,0,1,1.65-1.65A4.75,4.75,0,0,1,62,4.94a4.5,4.5,0,0,1,1.18.49l.26-.64A5.4,5.4,0,0,0,60.63,4,5.17,5.17,0,0,0,58,4.73a5.08,5.08,0,0,0-1.91,1.91,5.36,5.36,0,0,0-.71,2.75A5.22,5.22,0,0,0,56,12a4.79,4.79,0,0,0,1.86,1.85,5.55,5.55,0,0,0,2.77.68A6.17,6.17,0,0,0,62.35,14.28Z" />
                                                </g>
                                                <g id="SvgjsG527786">
                                                    <path class="cls-1" d="M41,18.73H37.65v.34h1.49v4.79h.36V19.07H41Zm4.39,0H42.23v5.13h3.26v-.34H42.58V21.44h2.53V21.1H42.58v-2h2.81Zm4.5,5.07a2.61,2.61,0,0,0,.63-.28l-.16-.32a2.36,2.36,0,0,1-2.42.07,2,2,0,0,1-.78-.82,2.43,2.43,0,0,1-.27-1.14,2.46,2.46,0,0,1,.29-1.16,2.18,2.18,0,0,1,.82-.83A2.07,2.07,0,0,1,49.11,19a2.32,2.32,0,0,1,1.24.37l.15-.32a2.64,2.64,0,0,0-1.4-.39,2.45,2.45,0,0,0-1.31.35,2.48,2.48,0,0,0-.94,1,2.79,2.79,0,0,0,0,2.65,2.47,2.47,0,0,0,.93.94,2.62,2.62,0,0,0,1.36.34A2.37,2.37,0,0,0,49.89,23.8Zm5.74.06V18.73h-.35v2.38h-3.1V18.73h-.35v5.13h.35V21.44h3.1v2.42Zm5.94-5.13h-.34V23.1l-3.94-4.48h0v5.24h.35V19.53L61.55,24h0ZM63.23,20a2.5,2.5,0,0,0-.35,1.31,2.56,2.56,0,0,0,.35,1.34,2.43,2.43,0,0,0,1,.93,2.54,2.54,0,0,0,1.31.34A2.6,2.6,0,0,0,67.76,20a2.6,2.6,0,0,0-1-1,2.56,2.56,0,0,0-2.62,0A2.73,2.73,0,0,0,63.23,20Zm.31,2.45a2.26,2.26,0,0,1-.3-1.14,2.3,2.3,0,0,1,.29-1.14,2.28,2.28,0,0,1,.82-.84A2.15,2.15,0,0,1,65.49,19a2.11,2.11,0,0,1,1.13.31,2.28,2.28,0,0,1,.83.83,2.3,2.3,0,0,1,.31,1.15,2.27,2.27,0,0,1-.31,1.14,2.18,2.18,0,0,1-.82.83,2.3,2.3,0,0,1-1.15.3,2.16,2.16,0,0,1-1.12-.3A2.25,2.25,0,0,1,63.54,22.44Zm6.24-3.71h-.35v5.13h3.16v-.34H69.78Zm4,1.26a2.6,2.6,0,0,0-.35,1.31,2.65,2.65,0,0,0,.35,1.34,2.5,2.5,0,0,0,.95.93,2.59,2.59,0,0,0,1.31.34,2.51,2.51,0,0,0,1.32-.35,2.57,2.57,0,0,0,1-.95,2.63,2.63,0,0,0,0-2.62,2.68,2.68,0,0,0-1-1A2.52,2.52,0,0,0,76,18.67a2.47,2.47,0,0,0-1.3.36A2.76,2.76,0,0,0,73.76,20Zm.32,2.45a2.17,2.17,0,0,1-.31-1.14,2.33,2.33,0,0,1,1.11-2,2.25,2.25,0,0,1,2.28,0,2.36,2.36,0,0,1,.83.83,2.3,2.3,0,0,1,.3,1.15,2.26,2.26,0,0,1-.3,1.14,2.2,2.2,0,0,1-.83.83,2.26,2.26,0,0,1-1.14.3,2.2,2.2,0,0,1-1.13-.3A2.3,2.3,0,0,1,74.08,22.44Zm9,1.35a2.26,2.26,0,0,0,.71-.3v-2H82.32v.34h1.16v1.42a1.89,1.89,0,0,1-.57.21,2.8,2.8,0,0,1-.64.08,2.36,2.36,0,0,1-1.19-.3,2.05,2.05,0,0,1-.8-.8,2.47,2.47,0,0,1,0-2.32,2.14,2.14,0,0,1,.83-.83,2.31,2.31,0,0,1,1.16-.3,2.77,2.77,0,0,1,1.25.34l.13-.32a2.85,2.85,0,0,0-1.41-.37A2.58,2.58,0,0,0,80,20a2.61,2.61,0,0,0-.35,1.37A2.73,2.73,0,0,0,80,22.65a2.35,2.35,0,0,0,.93.92,2.75,2.75,0,0,0,1.39.34A3.27,3.27,0,0,0,83.12,23.79Zm5.64-5.06h-.42l-1.66,2.9L85,18.73h-.44L86.5,22v1.83h.35V22Zm6.5,0H92.09v5.13h3.27v-.34H92.45V21.44H95V21.1H92.45v-2h2.81Zm5.75,0h-.33V23.1l-4-4.48h0v5.24h.35V19.53L101,24h0Zm4.79,5.06a2.33,2.33,0,0,0,.72-.3v-2H105v.34h1.15v1.42a1.93,1.93,0,0,1-.56.21,3,3,0,0,1-.64.08,2.31,2.31,0,0,1-1.19-.3,2,2,0,0,1-.8-.8,2.43,2.43,0,0,1,0-2.32,2.2,2.2,0,0,1,.83-.83A2.32,2.32,0,0,1,105,19a2.5,2.5,0,0,1,.65.1,2.43,2.43,0,0,1,.59.24l.13-.32a2.8,2.8,0,0,0-1.41-.37,2.58,2.58,0,0,0-2.27,1.3,2.71,2.71,0,0,0-.35,1.37,2.63,2.63,0,0,0,.33,1.31,2.35,2.35,0,0,0,.93.92,2.73,2.73,0,0,0,1.39.34A3.14,3.14,0,0,0,105.8,23.79Zm2.55-5.06H108v5.13h.35Zm5.94,0H114V23.1l-4-4.48h0v5.24h.35V19.53l4,4.45h0Zm4.79,0h-3.16v5.13h3.26v-.34h-2.91V21.44h2.53V21.1h-2.53v-2h2.81Zm4.62,0h-3.16v5.13h3.26v-.34h-2.91V21.44h2.53V21.1h-2.53v-2h2.81ZM128,23.86h.4l-1.38-2.28a1.28,1.28,0,0,0,.67-.55,1.66,1.66,0,0,0,.22-.85,1.35,1.35,0,0,0-.84-1.29,1.91,1.91,0,0,0-.78-.16h-1.17v5.13h.35V21.7h.8l.38,0ZM127.28,21a1.27,1.27,0,0,1-1,.34h-.78V19.07h.87a1.34,1.34,0,0,1,.64.15,1.1,1.1,0,0,1,.57,1A1.25,1.25,0,0,1,127.28,21Zm4.43-1.92a3.79,3.79,0,0,1,.57.2l.14-.27a2.83,2.83,0,0,0-.66-.24,3,3,0,0,0-.72-.09,1.74,1.74,0,0,0-.73.16,1.28,1.28,0,0,0-.51.43,1.17,1.17,0,0,0-.19.64,1,1,0,0,0,.19.62,1.53,1.53,0,0,0,.48.39,6.44,6.44,0,0,0,.71.31,4.66,4.66,0,0,1,.65.28,1.53,1.53,0,0,1,.43.37,1,1,0,0,1,.17.58,1.05,1.05,0,0,1-.19.61,1.15,1.15,0,0,1-.48.39,1.58,1.58,0,0,1-.61.12,2.1,2.1,0,0,1-.76-.15,2.91,2.91,0,0,1-.66-.35l-.17.29a3,3,0,0,0,1.62.52,1.92,1.92,0,0,0,.84-.18,1.32,1.32,0,0,0,.56-.51,1.37,1.37,0,0,0,.21-.75,1.29,1.29,0,0,0-.2-.74,1.47,1.47,0,0,0-.48-.45,5.06,5.06,0,0,0-.72-.32c-.26-.1-.48-.2-.65-.28a1.11,1.11,0,0,1-.41-.32.67.67,0,0,1-.17-.46.78.78,0,0,1,.31-.64,1.21,1.21,0,0,1,.81-.25A2.32,2.32,0,0,1,131.71,19.1Zm7.59,4.69a2.48,2.48,0,0,0,.71-.3v-2H138.5v.34h1.15v1.42a1.93,1.93,0,0,1-.56.21,3,3,0,0,1-.64.08,2.31,2.31,0,0,1-1.19-.3,2,2,0,0,1-.8-.8,2.43,2.43,0,0,1,0-2.32,2.2,2.2,0,0,1,.83-.83,2.32,2.32,0,0,1,1.17-.3,2.5,2.5,0,0,1,.65.1,2.6,2.6,0,0,1,.59.24l.13-.32a2.8,2.8,0,0,0-1.41-.37,2.56,2.56,0,0,0-1.31.34,2.6,2.6,0,0,0-1,1,2.71,2.71,0,0,0-.35,1.37,2.63,2.63,0,0,0,.33,1.31,2.35,2.35,0,0,0,.93.92,2.72,2.72,0,0,0,1.38.34A3.41,3.41,0,0,0,139.3,23.79Zm5.06.07h.41l-1.38-2.28a1.32,1.32,0,0,0,.67-.55,1.76,1.76,0,0,0,.21-.85,1.34,1.34,0,0,0-.23-.81,1.37,1.37,0,0,0-.61-.48,1.9,1.9,0,0,0-.77-.16h-1.17v5.13h.35V21.7h.79l.39,0ZM143.61,21a1.26,1.26,0,0,1-1,.34h-.77V19.07h.87a1.28,1.28,0,0,1,.63.15,1.13,1.13,0,0,1,.43.41,1.19,1.19,0,0,1,.14.56A1.25,1.25,0,0,1,143.61,21ZM146,20a2.51,2.51,0,0,0-.36,1.31,2.65,2.65,0,0,0,.35,1.34,2.57,2.57,0,0,0,.95.93,2.6,2.6,0,0,0,1.32.34,2.5,2.5,0,0,0,1.31-.35,2.57,2.57,0,0,0,1-.95,2.56,2.56,0,0,0,0-2.62,2.68,2.68,0,0,0-1-1,2.51,2.51,0,0,0-1.31-.36A2.48,2.48,0,0,0,147,19,2.65,2.65,0,0,0,146,20Zm.31,2.45A2.17,2.17,0,0,1,146,21.3a2.31,2.31,0,0,1,.3-1.14,2.28,2.28,0,0,1,.82-.84A2.12,2.12,0,0,1,148.3,19a2.16,2.16,0,0,1,1.13.31,2.36,2.36,0,0,1,.83.83,2.3,2.3,0,0,1,.31,1.15,2.27,2.27,0,0,1-.31,1.14,2.2,2.2,0,0,1-.83.83,2.3,2.3,0,0,1-2.27,0A2.3,2.3,0,0,1,146.35,22.44Zm6.39.45a1.57,1.57,0,0,1-.18-.77V18.73h-.35v3.41a1.88,1.88,0,0,0,.22.95,1.56,1.56,0,0,0,.64.61,1.87,1.87,0,0,0,.9.21,1.9,1.9,0,0,0,.9-.21,1.48,1.48,0,0,0,.63-.61,1.79,1.79,0,0,0,.24-.95V18.73h-.35v3.39a1.47,1.47,0,0,1-.19.77,1.29,1.29,0,0,1-.5.51,1.65,1.65,0,0,1-1.46,0A1.29,1.29,0,0,1,152.74,22.89Zm6.94-3.79a1.68,1.68,0,0,0-1.16-.37h-1.18v5.13h.35V21.7h.8a1.8,1.8,0,0,0,.91-.21,1.38,1.38,0,0,0,.54-.56,1.72,1.72,0,0,0,.17-.75A1.35,1.35,0,0,0,159.68,19.1Zm-.44,2.08a1.39,1.39,0,0,1-.75.18h-.8V19.07h.87a1.24,1.24,0,0,1,.89.3,1.09,1.09,0,0,1,.31.81,1.31,1.31,0,0,1-.11.54A1.12,1.12,0,0,1,159.24,21.18Z" />
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <!-- <h2 class="brand-text text-primary ms-1">Vuexy</h2> -->
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="<?php echo BASE_URL ?>public/app-assets/images/pages/login-v2.svg" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                <h2 class="card-title fw-bold mb-1">Bienvenido a Gliese! 👋</h2>
                                <p class="card-text mb-2">Inicie sesión con su cuenta y comience la aventura</p>
                                <div class="auth-login-form mt-2">
                                    <div class="mb-1">
                                        <label class="form-label">Usuario</label>
                                        <input class="form-control" id="login-user" type="text" placeholder="anonimo@example.com" autofocus="" tabindex="1" />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label">Contraseña</label><a href="#"><small>¿Olvido su contraseña?</small></a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" placeholder="············" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <div class="form-check">
                                            <input class="form-check-input" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="form-check-label" for="remember-me"> Recodar</label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary w-100" id="login-login" tabindex="4">Iniciar sesión</button>
                                </div>
                                <!-- <p class="text-center mt-2"><span>New on our platform?</span><a href="auth-register-cover.html"><span>&nbsp;Create an account</span></a></p> -->
                                <div class="divider my-4">
                                    <div class="divider-text"></div>
                                </div>
                                <!-- <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook" href="#"><i data-feather="facebook"></i></a><a class="btn btn-twitter white" href="#"><i data-feather="twitter"></i></a><a class="btn btn-google" href="#"><i data-feather="mail"></i></a><a class="btn btn-github" href="#"><i data-feather="github"></i></a></div> -->
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Functions JS-->
    <script src="<?php echo BASE_URL ?>application/core/Functions.js"></script>
    <!-- END Functions JS-->

    <!-- BEGIN: Config JS-->
    <script src="<?php echo BASE_URL ?>application/config/Config.js"></script>
    <!-- END Config JS-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/vendors.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/js/core/app-menu.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/js/core/app.js"></script>
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