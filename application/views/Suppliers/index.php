    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Campus Starts -->
                <section id="products">

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
                                <table class="table" id="datatable-suppliers">
                                    <thead>
                                        <tr>
                                            <th>Razon Social</th>
                                            <th>Encargado</th>
                                            <th>Documento</th>          
                                            <th>Nº De Documento</th>  
                                            <th>Email</th> 
                                            <th>Telefono</th> 
                                            <th>Direccion</th>
                                            <th>Acciones</th>  
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->

                   
                    <!-- Create Supplier Modal -->
                    <div class="modal fade" id="create_supplier_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <!--  aria-hidden="true" -->
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Agregar nuevo proveedor</h1>
                                        <!-- <p data-i18n="Add new campus description">Permissions you may use and assign to your users.</p> -->
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="create_supplier_form" class="row" onsubmit="return false">
                                        <div class="col-6">
                                            <label class="form-label">Razón Social</label>
                                            <input type="text" name="business_name" class="form-control" placeholder="Razón social" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Encargado</label>
                                            <input type="text" name="name" class="form-control" placeholder="Encargado" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Tipo de documento</label>
                                                <select name="document_type" class="form-select select2" data-msg="" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Nº De Documento</label>
                                            <input type="number" name="document_number" class="form-control" placeholder="Nº De Documento" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Email</label>
                                                <input type="email" name="Email" class="form-control" placeholder="user@example.com" data-msg="" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Teléfono</label>
                                                <input type="phone" name="phone" class="form-control" placeholder="Teléfono" data-msg="" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Dirección</label>
                                                <input type="address" name="address" class="form-control" placeholder="Dirección" data-msg="" />
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button id="btn_create_supplier" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Create Supplier Modal -->


                    
                    <!-- Update Supplier Modal -->
                    <div class="modal fade" id="update_supplier_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <!--  aria-hidden="true" -->
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Actualizar Proveedor</h1>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="update_supplier_form" class="row" onsubmit="return false">
                                        <div class="col-6">
                                            <label class="form-label">Razón Social</label>
                                            <input type="text" name="business_name" class="form-control" placeholder="Razón Social" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Encargado</label>
                                            <input type="text" name="name" class="form-control" placeholder="Encargado" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Tipo de documento</label>
                                                <select name="document_type" class="form-select select2" data-msg="" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Nº De Documento</label>
                                            <input type="number" name="document_number" class="form-control" placeholder="Nº De Documento" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="user@example.com" data-msg="" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Teléfono</label>
                                                <input type="phone" name="phone" class="form-control" placeholder="Teléfono" data-msg="" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label class="form-label">Dirección</label>
                                                <input type="address" name="address" class="form-control" placeholder="Dirección" data-msg="" />
                                            </div>
                                        </div>
                                        
                                        <input type="hidden" name="id_supplier">
                                       
                                        <div class="col-12 text-center">
                                            <button id="btn_update_supplier" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Update Supplier Modal -->

                </section>
                <!-- Permissions ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->