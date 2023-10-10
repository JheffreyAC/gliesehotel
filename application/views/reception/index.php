    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Lista de Reservas</h2>
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
            <!--Mostrar numero de habitaciones-->
            <div class="col-12">
                <div class="card py-3">
                    <div class="d-flex flex-wrap justify-content-center align-items-center gap-2" id="data-container">
                        <!-- Aquí se mostrarán tus datos -->
                    </div>
                </div>
            </div>
            <!--Crear Reserva de habitaciones-->

            <!-- Header title -->
            <div class="modal fade" id="update_habitacion_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 pb-5">
                            <form method="POST" enctype="multipart/form-data" id="create_reservation_form" class="row" onsubmit="return false">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Habitación</h1>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Numero de Habitación</label>
                                    <input type="text" name="room_number" class="form-control" placeholder="Numero de Habitación" autofocus data-msg="" disabled />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Habitación</label>
                                    <input type="text" name="type_name" id="type_name" class="form-control" placeholder="Tipo de Habitación" autofocus data-msg="" disabled />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Límite de Personas</label>
                                    <input type="text" name="person_limit" class="form-control" placeholder="Límite de Personas" data-msg="" disabled />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Cama</label>
                                    <input type="text" name="bed_type" class="form-control" placeholder="Tipo de Cama" data-msg="" disabled />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Estado de Habitación</label>
                                    <select name="room_status" class="form-select">
                                        <option value="Disponible">
                                            Disponible
                                        </option>
                                        <option value="Ocupado">
                                            Ocupado
                                        </option>
                                        <option value="Reservado">
                                            Reservado
                                        </option>
                                        <option value="Limpieza">
                                            Limpieza
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Documento</label>
                                    <select class="form-select" id="client_document_type">
                                        <option value="DNI" selected>
                                            DNI
                                        </option>
                                        <option value="RUC">
                                            RUC
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12" id="searchForm">
                                    <label>Cliente:</label>
                                    <input type="text" placeholder="Ingrese el número de DNI" class="form-control" id="document_number_reservation">
                                    <select class="form-select mt-1 opcionesSelect" name="id_guest">
                                        <option value="0">Seleccionar un resultado</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Fecha de Inicio</label>
                                    <input type="date" name="checkin_date" class="form-control" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Hora de Inicio</label>
                                    <input type="time" name="checkin_time" class="form-control" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Fecha de Termino</label>
                                    <input type="date" name="checkout_date" class="form-control" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Hora de Termino</label>
                                    <input type="time" name="checkout_time" class="form-control" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tarifas</label>
                                    <select id="room_rate" class="form-select">
                                        <option value="0" selected>
                                            Seleccione el precio
                                        </option>
                                        <option value="Simple">
                                            Simple
                                        </option>
                                        <option value="Doble">
                                            Doble
                                        </option>
                                        <option value="Triple">
                                            Triple
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tarifas</label>
                                    <select class="form-select" id="priceSelectOption" name="payment_room">
                                        <option value="0" selected>
                                            Seleccione el precio
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label">Precio Total</label>
                                    <input type="text" name="payment_all" class="form-control" data-msg="" id="payment_all">
                                </div>
                                <input type="hidden" name="id_room">
                                <div class="col-12">
                                    <button class="btn btn-primary mt-2 me-2" id="btn_create_reservation" type="submit">Agregar Reserva</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                        <span>Cancelar</span>
                                    </button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Crear Reserva de habitaciones-->



            <!-- Header title -->
            <div class="modal fade" id="create_guest_reservation_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 pb-5">
                            <form method="POST" enctype="multipart/form-data" id="create_guest_reservation_form" class="row" onsubmit="return false">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1 mt-4">Huespéd</h1>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Documento</label>
                                    <select name="document_type" class="form-select" id="client_document" required>
                                        <option value="0" selected>
                                            Seleccione el tipo de documento
                                        </option>
                                        <option value="DNI">
                                            DNI
                                        </option>
                                        <option value="RUC">
                                            RUC
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Numero de Documento</label>
                                    <input type="text" name="document_number" class="form-control" placeholder="Busca el numero de documento" data-msg="" id="document_number" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="first_names" class="form-control" placeholder="Nombre" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Apellido</label>
                                    <input type="text" name="last_names" class="form-control" placeholder="Apellido" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="address" class="form-control" placeholder="Dirección" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Razón Social</label>
                                    <input type="text" name="company_name" class="form-control" placeholder="Razón Social" data-msg="" />
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary mt-2 me-2" id="btn_create_guest_reservation" type="submit">Agregar Huespéd</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                        <span>Cancelar</span>
                                    </button>
                                </div>
                                <br>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!--Crear Reserva de habitaciones-->

            <div class="content-body">
            </div>
        </div>
    </div>