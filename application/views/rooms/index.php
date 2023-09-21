    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <table class="table w-100 table-responsive" id="datatable-rooms">
                            <thead>
                                <tr>
                                    <th>N. HABITACIÓN</th>
                                    <th>TIPO HABITACIÓN</th>
                                    <th>AFORO</th>
                                    <th>TIPO CAMA</th>
                                    <th>ESTADO</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!---Create room form-->
            <!-- Create Habitacion Modal -->
            <div class="modal fade" id="create_habitacion_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body px-sm-5 pb-5">
                            <div class="text-center mb-2">
                                <h1 class="mb-1">Agregar nueva habitación</h1>
                            </div>
                            <form method="POST" enctype="multipart/form-data" id="create_habitacion_form" class="row" onsubmit="return false">
                                <div class="col-12">
                                    <label class="form-label">Número de Habitación</label>
                                    <input type="text" name="room_number" class="form-control" placeholder="Número de Habitación" data-msg="" required />
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Tipo de Habitación</label>
                                    <select name="id_type" class="form-select">
                                        <option value="1">
                                            Simple
                                        </option>
                                        <option value="2">
                                            Doble
                                        </option>
                                        <option value="3">
                                            Triple
                                        </option>
                                    </select>
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
                                <br>
                                <div class="col-12 text-center">
                                    <button id="btn_create_habitacion" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
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