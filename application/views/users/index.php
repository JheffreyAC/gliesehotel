    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Users Starts -->
                <section id="users">
           
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

                    <div class="row">
                        <div class="col-lg-4 col-sm-4">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="fw-bolder mb-75" id="total_users">0</h3>
                                        <span>Usuarios totales</span>
                                    </div>
                                    <div class="avatar bg-light-primary p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user" class="font-medium-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="fw-bolder mb-75" id="active_users">0</h3>
                                        <span>Usuarios activos</span>
                                    </div>
                                    <div class="avatar bg-light-success p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-check" class="font-medium-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <div class="card">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div>
                                        <h3 class="fw-bolder mb-75" id="inactive_users">0</h3>
                                        <span>Usuarios inactivos</span>
                                    </div>
                                    <div class="avatar bg-light-secondary p-50">
                                        <span class="avatar-content">
                                            <i data-feather="user-minus" class="font-medium-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table" id="datatables-users">
                                    <thead>
                                        <tr>
                                            <th>NOMBRES COMPLETOS</th>
                                            <th>ESTADO</th>
                                            <th>ACCIONES</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->


                    <!-- Create User Modal -->
                    <div class="modal fade" id="create_user_modal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Agregar nuevo usuario</h1>
                                        <!-- <p>Updating user details will receive a privacy audit.</p> -->
                                    </div>

                                    <form method="POST" enctype="multipart/form-data" id="create_user_form" class="row" onsubmit="return false">
                                        <!-- header section -->
                                        <!-- <div class="d-flex">
                                            <a href="#" class="me-25">
                                                <img src="<?php /*echo BASE_URL*/ ?>public/app-assets/images/portrait/small/avatar-s-11.jpg" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                            </a> -->
                                            <!-- upload and reset button -->
                                            <!-- <div class="d-flex align-items-end mt-75 ms-1">
                                                <div>
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                                    <input type="file" id="account-upload" hidden accept="image/*" />
                                                    <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                    <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                                </div>
                                            </div> -->
                                            <!--/ upload and reset button -->
                                        <!-- </div> -->
                                        <!--/ header section -->
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Nombres</label>
                                                <input type="text" name="first_name" class="form-control" placeholder="Nombres" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Apellidos</label>
                                                <input type="text" name="last_name" class="form-control" placeholder="Apellidos" data-msg="" required />
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

                                        <div class="mb-1 col-md-12">
                                            <div>
                                                <label class="form-label">Dirección</label>
                                                <input type="text" name="address" class="form-control" placeholder="Dirección" data-msg=""/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Usuario</label>
                                                <input type="text" name="user" class="form-control" placeholder="Usuario" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Contraseña</label>
                                                <input type="password" name="password" class="form-control" placeholder="Contraseña" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Rol</label>
                                                <select name="role" class="form-select select2" data-msg="" required>
                                                </select>
                                            </div>
                                        </div>
        
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Sedes | <span style="color: #7367f0;">(Puede seleccionar más de una sede)</span></label>
                                                <select class="select2 form-select" name="campus" data-msg=""  multiple required>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Teléfono</label>
                                                <input type="number" name="telephone" class="form-control" placeholder="Teléfono" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Email" data-msg="" required/>
                                            </div>
                                        </div>


                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button id="btn_create_user" type="submit" class="btn btn-primary me-1">Guardar</button>
                                            <button  type="reset" class="btn btn-outline-secondary reset" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Create User Modal -->


                     <!-- Update User Modal -->
                     <div class="modal fade" id="update_user_modal"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Actualizar usuario</h1>
                                        <!-- <p>Updating user details will receive a privacy audit.</p> -->
                                    </div>

                                    <form  method="POST" enctype="multipart/form-data" id="update_user_form" class="row" onsubmit="return false">
                                        <!-- header section -->
                                        <!-- <div class="d-flex">
                                            <a href="#" class="me-25">
                                                <img src="<?php /*echo BASE_URL*/ ?>public/app-assets/images/portrait/small/avatar-s-11.jpg" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                            </a> -->
                                            <!-- upload and reset button -->
                                            <!-- <div class="d-flex align-items-end mt-75 ms-1">
                                                <div>
                                                    <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                                    <input type="file" id="account-upload" hidden accept="image/*" />
                                                    <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                    <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                                </div>
                                            </div> -->
                                            <!--/ upload and reset button -->
                                        <!-- </div> -->
                                        <!--/ header section -->
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Nombres</label>
                                                <input type="text" name="first_name" class="form-control" placeholder="Nombres" data-msg="" required/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Apellidos</label>
                                                <input type="text" name="last_name" class="form-control" placeholder="Apellidos" data-msg="" required />
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

                                        <div class="mb-1 col-md-12">
                                            <div>
                                                <label class="form-label">Dirección</label>
                                                <input type="text" name="address" class="form-control" placeholder="Dirección" data-msg=""/>
                                            </div>
                                        </div>

                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Usuario</label>
                                                <input type="text" name="user" class="form-control" placeholder="Usuario" data-msg="" required/>
                                            </div>
                                        </div>

                                                
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Rol</label>
                                                <select name="role" class="form-select select2" data-msg="" required>
                                                </select>
                                            </div>
                                        </div>
        
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Sedes | <span style="color: #7367f0;">(Puede seleccionar más de una sede)</span></label>
                                                <select class="select2 form-select" name="campus" data-msg=""  multiple required>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-1 col-md-6">
                                            <div>
                                                <label class="form-label">Teléfono</label>
                                                <input type="number" name="telephone" class="form-control" placeholder="Teléfono" data-msg="" required/>
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
                                                <label class="form-label">Estado</label>
                                                <select name="active" class="form-select select2" data-msg="" required>
                                                    <option value="">Seleccionar</option>
                                                    <option value="1">ACTIVO</option>
                                                    <option value="0">INACTIVO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id_user">
  
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button id="btn_update_user" type="submit" class="btn btn-primary me-1">Guardar</button>
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