
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
                            <div id="container_calendar" class="card p-2">
                                <div id='calendar'></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->

                    <!-- Update Permission Modal -->
                    <div class="modal fade" id="update_reservation_modal" data-bs-backdrop="static" data-bs-target="#" data-bs-keyboard="false" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content mx-auto">
                            <div class="modal-header bg-transparent">
                                <div aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">Reserva</li>
                                        <li class="breadcrumb-item active" id="idReservation" aria-current="page"></li>
                                    </ol>
                                </div>

                                <button type="reset" class="btn-close reset" style="margin-bottom: 2px;" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 pb-5">
                            
                                <!-- Pestañas -->
                                <ul class="nav nav-tabs" id="tabContenido">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#modal-detalles">Detalles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#modal-modificacon">Modificación</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#modal-salida">Salida y pago</a>
                                </li>
                                </ul>

                                <!-- Contenido de las pestañas -->
                                <div class="tab-content">

                                    <!-- Cont 1 -->
                                    <div class="tab-pane fade show active" id="modal-detalles">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-header">Datos hospedaje</div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Entrada:</h5>
                                                        <p class="card-text detalle-entrada"></p>
                                                        <h5 class="card-title">Salida:</h5>
                                                        <p class="card-text detalle-salida"></p>
                                                        <h5 class="card-title">Tiempo estimado:</h5>
                                                        <p class="card-text detalle-tiempo"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-header">Información de la habitación</div>
                                                    <div class="card-body">
                                                        <h5 class="card-title">Número de habitación:</h5>
                                                        <p class="card-text detalle-numH"></p>
                                                        <h5 class="card-title">Tipo de habitación:</h5>
                                                        <p class="card-text detalle-tipoH"></p>
                                                        <h5 class="card-title">Tipo cama:</h5>
                                                        <p class="card-text detalle-tipoC"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">Información del huésped</div>
                                                    <div class="card-body d-flex">
                                                        <div class="col-6">
                                                            <h5 class="card-title">Nombres:</h5>
                                                            <p class="card-text detalle-nombres"></p>
                                                            <h5 class="card-title">Apellidos:</h5>
                                                            <p class="card-text detalle-apellidos"></p>
                                                            <h5 class="card-title">Tipo documento:</h5>
                                                            <p class="card-text detalle-tipoDoc"></p>
                                                        </div>
                                                        <div class="col-6">
                                                            <h5 class="card-title">Número de documento:</h5>
                                                            <p class="card-text detalle-numDoc"></p>
                                                            <h5 class="card-title">Dirección:</h5>
                                                            <p class="card-text detalle-direccion"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cont 2 -->
                                    <div class="tab-pane fade" id="modal-modificacon">
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
                                                <label class="form-label">Precio Habitación</label>
                                                <input type="number" name="payment_room" class="form-control" placeholder="Precio" data-msg="" required/>
                                            </div>

                                            <!--  -->
                                            <input type="hidden" name="id_payment">
                                            <input type="hidden" name="id_reservation">
                                            <input type="hidden" name="id_room">
                                            <br>
                                            <div class="col-12 text-center mt-2">
                                                <button id="btn_update_reservation" type="submit" class="btn btn-primary mt-2 me-1">Guardar Reserva</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                    <span>Cancelar</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Cont 3 -->
                                    <div class="tab-pane fade" id="modal-salida">
                                        <form method="POST" enctype="multipart/form-data" id="departure_reservation_form" class="row" onsubmit="return false">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="card">
                                                            <div class="card-header">Datos hospedaje</div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Entrada:</h5>
                                                                <p class="card-text detalle-entrada"></p>
                                                                <h5 class="card-title">Salida:</h5>
                                                                <p class="card-text detalle-salida"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="card">
                                                            <div class="card-header">Información de la habitación</div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Número:</h5>
                                                                <p class="card-text detalle-numH"></p>
                                                                <h5 class="card-title">Tipo:</h5>
                                                                <p class="card-text detalle-tipoH"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="card">
                                                            <div class="card-header">Información del huésped</div>
                                                            <div class="card-body">
                                                                <h5 class="card-title">Nombre completo:</h5>
                                                                <p class="card-text detalle-nombresComp">
                                                                <h5 class="card-title">Número de documento:</h5>
                                                                <p class="card-text detalle-numDoc"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <!--  -->
                                                <div class="row">
                                                    <div class="card p-1">
                                                        <div class="col-12">
                                                                <p>Costo de las ventas</p>
                                                                <table class="table mb-2" id="datatable-sales">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Descripción</th> 
                                                                            <th>Precio Unitario</th>         
                                                                            <th>Cantidad</th>
                                                                            <th>Estado</th> 
                                                                            <th>Total</th> 
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tbody-sales">
                                                                        <tr>
                                                                            <td>Agua</td>
                                                                            <td>S/ 1,20</td>
                                                                            <td>2</td>
                                                                            <td class="text-success">Pagado</td>
                                                                            <td>S/ 2,40</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4"><b>Total</b></td>
                                                                            <td><b>S/ 2,40</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>Costo de alojamiento</p>
                                                                <table class="table table-bordered mb-1">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Monto haitación</th>
                                                                            <th>Monto extra</th>
                                                                            <th>Sub total</th>
                                                                            <th>Descuento</th>
                                                                            <th>Cancelado</th>
                                                                            <th>Falta pagar</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><input type="number" name="payment_room" class="form-control" placeholder="00" data-msg="" disabled required/></td>
                                                                            <td><input type="number" name="payment_extra" class="form-control" placeholder="00" data-msg="" required/></td>
                                                                            <td><input type="number" name="payment_subTotal" class="form-control" placeholder="00" data-msg="" required/></td>
                                                                            <td><input type="number" name="payment_discount" class="form-control" placeholder="00" data-msg="" required/></td>
                                                                            <td><input type="number" name="payment_cancelled" class="form-control" placeholder="00" data-msg="" required/></td>
                                                                            <td><input type="number" name="payment_total" class="form-control" placeholder="00" data-msg="" required/></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        <div class="col-12 mt-2">
                                                            <div class="col-12 d-flex flex-wrap justify-content-cente align-items-end">
                                                                <div class="col-10 d-flex">
                                                                    <div class="col-3 p-1">
                                                                        <button id="departure_btn" type="button" class="btn btn-secondary mt-2 me-1">Marcar salida</button>
                                                                    </div>
                                                                    <div class="col-3 p-1">
                                                                        <label class="form-label">Fecha Salida</label>
                                                                        <input type="date" name="departure_date" class="form-control" placeholder="Fecha Final" data-msg=""/>
                                                                    </div>
                                                                    <div class="col-3 p-1">
                                                                        <label class="form-label">Hora Salida</label>
                                                                        <input type="time" name="departure_time" class="form-control" placeholder="Fecha Inicio" data-msg=""/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-2 p-1 text-end">
                                                                    <label class="form-label">Total a pagar</label>
                                                                    <input type="number" name="payment_total" class="form-control text-end" data-msg=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  -->
                                            <input type="hidden" name="id_payment">
                                            <div class="col-12 text-center mt-2">
                                                <button id="btn_update_payment" type="submit" class="btn btn-primary mt-2 me-1">Guardar cambios</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                    <span>Cancelar</span>
                                                </button>
                                                <button id="btn_finish_reservation" type="submit" class="btn btn-danger mt-2 mx-1">Finalizar Reserva</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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