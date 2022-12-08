    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Permissions Starts -->
                <section id="permissions">

                    <!-- Header title -->
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                    <h2 class="content-header-title float-start mb-0">Lista de <?php echo strtolower($selected_sub_menu); ?></h2>
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
                    <!-- /Header table-->

                    <!-- Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table" id="datatable-permissions">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- /Table -->


                    <!-- Create Permission Modal -->
                    <div class="modal fade" id="create_permission_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Agregar nuevo permiso</h1>
                                        <p>Permisos que puede usar y asignar a sus usuarios.</p>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="create_permission_form" class="row" onsubmit="return false">
                                        <div class="col-12">
                                            <label class="form-label">Descripción</label>
                                            <input type="text" name="description" class="form-control" placeholder="Descripción" autofocus data-msg="" required />
                                        </div>
                                        <br>
                                        <div class="col-12 text-center">
                                            <button id="btn_create_permission" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Create Permission Modal -->

                     <!-- Update Permission Modal -->
                     <div class="modal fade" id="update_permission_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Actualizar permiso</h1>
                                        <p>Permisos que puede usar y asignar a sus usuarios.</p>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="update_permission_form" class="row" onsubmit="return false">
                                        <div class="col-12">
                                            <label class="form-label">Descripción</label>
                                            <input type="text" name="description" class="form-control" placeholder="Descripción" autofocus data-msg="" required />
                                        </div>
                                        <input type="hidden" name="id_permission">
                                        <br>
                                        <div class="col-12 text-center">
                                            <button id="btn_update_permission" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Update Permission Modal -->


                </section>
                <!-- Permissions ends -->



            </div>
        </div>
    </div>
    <!-- END: Content-->