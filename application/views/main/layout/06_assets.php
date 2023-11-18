    <!-- BEGIN: Functions JS-->
    <script src="<?php echo BASE_URL ?>application/core/Functions.js"></script>
    <!-- END Functions JS-->

    <!-- BEGIN: Config JS-->
    <script src="<?php echo BASE_URL ?>application/config/Config.js"></script>
    <!-- END Config JS-->

    <!-- BEGIN: Vendor JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/lottie/lottie-player.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="<?php echo BASE_URL ?>public/app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>
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

    <!-- BEGIN: Main JS-->
    <script src="<?php echo BASE_URL ?>application/views/main/js/index.js"></script>
    <!-- END: Main JS-->

    <!-- BEGIN: Lenguajes JS-->
    <script src="<?php echo BASE_URL ?>public/app-assets/js/scripts/lenguajes.js"></script>
    <!-- END: Lenguajes JS-->

    <!-- -->
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
            // --
        })
    </script>

    <script src="<?php echo BASE_URL ?>public/app-assets/js/scripts/calendar/index.global.js"></script>

    <!-- -->
    </body>
    <!-- END: Body-->

    </html>