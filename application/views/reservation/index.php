
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Reservations Starts -->
                <section id="reservations">
                    
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
                            <div class="card p-2">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->

                    <!-- Update Permission Modal -->
                    <div class="modal fade" id="update_reservation_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 pb-5">
                                <div class="row breadcrumbs-top"> 
                                    <div class="col-12 d-flex aling-items-end justify-content-between">
                                        <h4 class="content-header-title">Reserva</h2>
                                        <span id="idReservation"></span>
                                    </div>
                                </div>
                                <!-- ROOM -->
                                <div class="col-12 mb-2 d-flex flex-wrap justify-content-center">
                                    <h1 class="text-center mb-1">Habitación <span class="fs-4" id="numRoom"></span></h1>        
                                </div>
                                <!--  -->
                                <form method="POST" enctype="multipart/form-data" id="update_reservation_form" class="row" onsubmit="return false">
                                    <div class="col-4">
                                        <label class="form-label">Tipo de Habitación</label>
                                        <input type="text" name="type_room" class="form-control" placeholder="Tipo de Habitación" autofocus data-msg="" disabled />
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Tipo de Cama</label>
                                        <input type="text" name="bed_name" class="form-control" placeholder="Tipo de Cama" data-msg="" disabled />
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Límite de Personas</label>
                                        <input type="text" name="person_limit" class="form-control" placeholder="Límite de Personas" data-msg="" disabled />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Fecha de Inicio</label>
                                        <input type="date" name="checkin_date" class="form-control" placeholder="Fecha Inicio" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Fecha de Termino</label>
                                        <input type="date" name="checkout_date" class="form-control" placeholder="Fecha Final" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Hora de Inicio</label>
                                        <input type="time" name="checkin_time" class="form-control" placeholder="Fecha Inicio" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Hora de Termino</label>
                                        <input type="time" name="checkout_time" class="form-control" placeholder="Fecha Final" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Estado de Habitación</label>
                                        <select name="room_status" id="mySelect" class="form-select">
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
                                    <div class="col-6">
                                        <label class="form-label">Precio</label>
                                        <input type="text" name="price_room" class="form-control" placeholder="Precio" data-msg="" disabled required/>
                                    </div>


                                    <!-- GUEST -->
                                    <div class="text-center mb-1">
                                        <h1 class="mb-1 mt-2">Huespéd</h1>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Tipo de Documento</label>
                                        <!-- <input type="text" name="type_name" class="form-control" placeholder="Tipo de Habitación" autofocus data-msg="" required /> -->
                                        <select name="" class="form-select">
                                            <option value="Disponible">
                                                DNI
                                            </option>
                                            <option value="Ocupado">
                                                RUC
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Numero de Documento</label>
                                        <input type="text" name="document_number" class="form-control" placeholder="Numero de Documento" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Nombres</label>
                                        <input type="text" name="first_names" class="form-control" placeholder="Nombres" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" name="last_names" class="form-control" placeholder="Apellidos" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Dirección</label>
                                        <input type="text" name="address" class="form-control" placeholder="Dirección" data-msg="" required />
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Empresa</label>
                                        <input type="text" name="" class="form-control" placeholder="Empresa" data-msg="" required />
                                    </div>

                                    <!-- VENTAS -->
                                    <div class="col-12">
                                        <div class="text-center">
                                            <h1 class="mt-2">Ventas</h1>
                                        </div>
                                        <div class="col-12 d-flex">
                                            <div class="col-6 p-1">
                                                <div class="text-center mb-1">
                                                    <h1 class="">Alimentos</h1>
                                                </div>
                                                <table class="table" id="datatable-sales-food">
                                                    <thead>
                                                        <tr>
                                                            <th>Descripción</th>          
                                                            <th>Cantidad</th>  
                                                            <th>Precio</th> 
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="col-6 p-1">
                                                <div class="text-center mb-1">
                                                    <h1 class="">Accesorios</h1>
                                                </div>
                                                <table class="table" id="datatable-sales-accessory">
                                                    <thead>
                                                        <tr>
                                                            <th>Descripción</th>          
                                                            <th>Cantidad</th>  
                                                            <th>Precio</th> 
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <!-- PAYMENT  -->
                                    <div class="col-12">
                                        <div class="text-center mb-1">
                                            <h1 class="mb-1 mt-2">Salida</h1>
                                        </div>
                                        <div class="col-12 d-flex flex-wrap justify-content-cente align-items-end">
                                            <div class="col-5 p-1">
                                                <label class="form-label">Fecha Salida</label>
                                                <input type="date" name="departure_date" class="form-control" placeholder="Fecha Final" data-msg=""   />
                                            </div>
                                            <div class="col-5 p-1">
                                                <label class="form-label">Hora Salida</label>
                                                <input type="time" name="departure_time" class="form-control" placeholder="Fecha Inicio" data-msg=""   />
                                            </div>
                                            <div class="col-2 p-1">
                                                <button id="departure_btn" type="button" class="btn btn-secondary mt-2 me-1">Salida</button>
                                            </div>
                                            <div class="col-6 p-1">
                                                <label class="form-label">Monto total</label>
                                                <input type="number" name="price_all" class="form-control" placeholder="Total" data-msg=""  />
                                            </div>
                                            <div class="col-6 p-1 form-group">
                                                <label class="form-label">Considerar monto extra</label>
                                                <input type="checkbox" class="form-check-input" data-toggle="toggle" id="myCheckbox" name="myCheckbox" style="width: 13px; height: 13px; margin-top: 5px;">

                                                <input type="number" name="price_extra" class="form-control" placeholder="Extra" data-msg=""  />
                                            </div>
                                        </div>

                                    </div>

                                    <!--  -->
                                    <input type="hidden" name="id_reservation">
                                    <input type="hidden" name="id_room">
                                    <input type="hidden" name="id_guest">
                                    <br>
                                    <div class="col-12 text-center mt-2">
                                        <button id="btn_update_reservation" type="submit" class="btn btn-primary mt-2 me-1">Guardar Reserva</button>
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
                <!-- Reservations ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->