    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Roles Starts -->
                <section id="roles">
                    
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
                    <!-- /Header title-->

                    <!-- Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table" id="datatables-roles">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                           <!--  <th data-i18n="Created date">Created Date</th> -->
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->

                    <!-- Add Role Modal -->
                    <div class="modal fade" id="create_role_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-5 pb-5">
                                    <div class="text-center mb-4">
                                        <h1 class="role-title">Agregar nuevo rol</h1>
                                        <p>Establecer permisos del rol</p>
                                    </div>
                                    <!-- Add role form -->
                                    <form method="POST" enctype="multipart/form-data" id="create_role_form" class="row" onsubmit="return false">
                                        <div class="col-12">
                                            <label class="form-label">Descripción</label>
                                            <input type="text" name="description" class="form-control" placeholder="Descripción" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-12">
                                            <br>
                                            <!-- <h4 class="mt-2 pt-50" data-i18n="Role permissions">Role permissions</h4> -->
                                            <table class="table table-flush-spacing">
                                                <!-- tbody content -->
                                                <tr>
                                                    <td class="fw-bolder">
                                                        <label>ACCESO ADMINISTRADOR</label>
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Permite un acceso completo al sistema">
                                                            <i data-feather="info"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="form-check me-3 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="create_role_select_all" />
                                                            <label class="form-check-label">Seleccionar todo</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div class="col-12">
                                                <h5 class="mt-1 pt-10">Permisos</h5>
                                                <br>
                                                <div id="create_role_menu">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-12 text-center mt-2">
                                            <button id="btn_create_role" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                    <!--/ Add role form -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Add Role Modal -->

                    <!-- Update Permission Modal -->
                    <div class="modal fade" id="update_role_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Actualizar rol</h1>
                                        <p>Establecer permisos de rol</p>
                                    </div>

                                    <!-- Add role form -->
                                    <form method="POST" enctype="multipart/form-data" id="update_role_form" class="row" onsubmit="return false">
                                        <div class="col-12">
                                            <label class="form-label">Description</label>
                                            <input type="text" name="description" class="form-control" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-12">
                                            <br>
                                            <table class="table table-flush-spacing">
                                                <!-- tbody content -->
                                                <tr>
                                                    <td class="fw-bolder">
                                                        <label>ACCESO ADMINISTRADOR</label>
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                                            <i data-feather="info"></i>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="form-check me-3 me-lg-3">
                                                            <input class="form-check-input" type="checkbox" id="update_role_select_all" />
                                                            <label class="form-check-label">Seleccionar todo</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                          
                                            <div class="col-12">
                                                <h5 class="mt-1 pt-10">Permisos</h5>
                                                <br>
                                                <div id="update_role_menu">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <input type="hidden" name="id_role">
                                        <div class="col-12 text-center mt-2">
                                            <button id="btn_update_role" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                    <!--/ Add role form -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Update Permission Modal -->

                </section>
                <!-- Roles ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->