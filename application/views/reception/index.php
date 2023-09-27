    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
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

            <!--Crear Reserva de habitaciones-->


            <div class="modal fade" id="update_habitacion_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 pb-5">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">Habitación</h1>
                            </div>
                            <form method="POST" enctype="multipart/form-data" id="update_habitacion_form" class="row" onsubmit="return false">
                                <div class="col-12">
                                    <label class="form-label">Tipo de Habitación</label>
                                    <input type="text" name="type_name" class="form-control" placeholder="Tipo de Habitación" autofocus data-msg="" disabled />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Límite de Personas</label>
                                    <input type="text" name="person_limit" class="form-control" placeholder="Límite de Personas" data-msg="" disabled />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Cama</label>
                                    <input type="text" name="bed_name" class="form-control" placeholder="Tipo de Cama" data-msg="" disabled />
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
                                    <label class="form-label">Tiempo de Hospedaje</label>
                                    <input type="text" name="bed_name" class="form-control" placeholder="Tiempo de Hospedaje" data-msg="" required />
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Fecha de Inicio</label>
                                    <input type="date" name="bed_name" class="form-control" placeholder="Dirección" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Fecha de Termino</label>
                                    <input type="date" name="bed_name" class="form-control" placeholder="Dirección" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Precio</label>
                                    <select name="room_status" class="form-select">
                                        <option value="Disponible">
                                            30,0
                                        </option>
                                        <option value="Ocupado">
                                            40,0
                                        </option>
                                        <option value="Reservado">
                                            50,0
                                        </option>
                                    </select>
                                </div>
                                <div class="text-center mb-2">
                                    <h1 class="mb-1 mt-4">Huespéd</h1>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Documento</label>
                                    <!-- <input type="text" name="type_name" class="form-control" placeholder="Tipo de Habitación" autofocus data-msg="" required /> -->
                                    <select name="room_status" class="form-select">
                                        <option value="Disponible">
                                            DNI
                                        </option>
                                        <option value="Ocupado">
                                            RUC
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Numero de Documento</label>
                                    <input type="text" name="person_limit" class="form-control" placeholder="Numero de Documento" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nombres</label>
                                    <input type="text" name="bed_name" class="form-control" placeholder="Nombres" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" name="bed_name" class="form-control" placeholder="Apellidos" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" name="bed_name" class="form-control" placeholder="Fecha de Nacimiento" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="bed_name" class="form-control" placeholder="Dirección" data-msg="" required />
                                </div>
                                <input type="hidden" name="id_room">
                                <br>
                                <div class="col-12 text-center">
                                    <button id="btn_update_habitacion" type="submit" class="btn btn-primary mt-2 me-1">Agregar Reserva</button>
                                    <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                        <span>Cancelar</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-body">
            </div>
        </div>
    </div>