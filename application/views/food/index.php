    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <!-- Header title -->
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Lista de Alimentos</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><?php echo $selected_menu; ?></a>
                                        </li>
                                        <li class="breadcrumb-item active"><span><?php echo $selected_sub_menu; ?></span>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Campus Starts -->


                <!-- Header title -->

                <!-- /Header table-->

                <!-- Table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="table" id="datatable-Food">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th>Tipo alimento</th>
                                        <!-- <th>Expiration Date</th>  -->
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /Table -->

                <!--/ Update Categories Modal -->



                <!-- Permissions ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->