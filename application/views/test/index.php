    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Campus Starts -->
                <section id="test">

                    <!-- Header title -->
                    <div class="content-header row">
                        <div class="content-header-left col-md-9 col-12 mb-2">
                            <div class="row breadcrumbs-top">
                                <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Lista de ingresos productos</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Header table-->

                    <!-- Container for adding products -->
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div>
                                            <label class="form-label">Proveedor</label>
                                            <select name="business_name" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Fecha</label>
                                        <input name="proof_date" type="date" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label class="form-label">Tipo de Comprobante</label>
                                            <select name="v_description" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="serie" class="form-label">Serie</label>
                                        <input type="text" class="form-control" id="serie" name="serie">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="numero" class="form-label">Número</label>
                                        <input type="text" class="form-control" id="numero" name="numero">
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label class="form-label">Tipo de Pago</label>
                                            <select name="p_description" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button class="btn btn-primary">Agregar productos</button>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <table class="table" id="datatable-income">
                                                <thead>
                                                    <tr>
                                                        <th>Opcion</th>
                                                        <th>Articulo</th>
                                                        <th>Cantidad</th>
                                                        <th>Precio compra</th>
                                                        <th>IGV</th>
                                                        <th>Precio venta</th>
                                                        <th>Sub total</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Table -->

                                <button type="button" class="btn btn-secondary" onclick="window.location.href='Income/index.php'">Cancelar</button>
                            </form> 
                        </div>
                    </div>
                    <!-- End Container to add products -->

                </section>   
                <!-- Permissions ends -->       
            </div>
        </div> 
    </div>
    <!-- END: Content-->