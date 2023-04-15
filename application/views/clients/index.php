    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Users Starts -->
                <section id="clients"> 
           
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
                                <table class="table" id="datatable-clients">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo de documento</th>.
                                            <th>Nº de documento</th>            
                                            <th>Telefono</th>
                                            <th>Direccion</th>
                                            <th>Email</th>
                                            <th>Razon social</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->
                    
                    <!-- Create Supplier Modal -->
                    <div class="modal fade" id="create_clients_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <!--  aria-hidden="true" -->
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Agregar nuevo cliente</h1>
                                        <!-- <p data-i18n="Add new campus description">Permissions you may use and assign to your users.</p> -->
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="create_clients_form" class="row" onsubmit="return false">
                                        <div class="col-6">
                                            <label class="form-label">Razón Social</label>
                                            <input type="text" name="business_name" class="form-control" placeholder="Razón social" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Nombre</label>
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
                                        <div class="col-12 text-center">
                                            <button id="btn_create_clients" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
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


                    <!-- Update User Modal -->
                        <div class="modal fade" id="update_clients_modal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                         <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-clients">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Actualizar cliente</h1>
                                        <!-- <p>Updating clients details will receive a privacy audit.</p> -->
                                    </div>

                                    <form  method="POST" enctype="multipart/form-data" id="update_clients_form" class="row" onsubmit="return false">
                                       
                                        <!--/ header section -->
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Nombres</label>
                                                <input type="text" name="name" class="form-control" placeholder="Nombres" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Tipo de documento</label>
                                                <select name="document_type" class="form-select select2" data-msg="" required>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Número de documento</label>
                                                <input type="number" name="document_number" class="form-control" placeholder="Número de documento" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Teléfono</label>
                                                <input type="number" name="phone" class="form-control" placeholder="Teléfono" data-msg="" required/>
                                            </div>
                                        </div>


                                        <div class="mb-1 col-md-12">
                                            <div>
                                                <label class="form-label">Dirección</label>
                                                <input type="text" name="address" class="form-control" placeholder="Dirección" data-msg=""/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Email" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Razon social</label>
                                                <input type="text" name="business_name" class="form-control" placeholder="Razon social" data-msg="" required/>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_clients">
  
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button id="btn_update_clients" type="submit" class="btn btn-primary me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary reset" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Update User Modal -->

                </section>
                <!-- Users ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->