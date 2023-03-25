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
                                    <label for="proveedor" class="form-label">Proveedor</label>
                                    <select class="form-select" id="proveedor" name="proveedor">
                                    <option value="" selected disabled>Seleccionar proveedor</option>
                                    <option value="proveedor1">Proveedor 1</option>
                                    <option value="proveedor2">Proveedor 2</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha">
                                </div>
                                <div class="col-md-4">
                                    <label for="tipo_comprobante" class="form-label">Tipo de Comprobante</label>
                                    <select class="form-select" id="tipo_comprobante" name="tipo_comprobante">
                                    <option value="" selected disabled>Seleccionar tipo de comprobante</option>
                                    <option value="factura">Factura</option>
                                    <option value="recibo">Recibo</option>
                                    </select>
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
                                    <label for="tipo_pago" class="form-label">Tipo de Pago</label>
                                    <select class="form-select" id="tipo_pago" name="tipo_pago">
                                    <option value="" selected disabled>Seleccionar tipo de pago</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="tarjeta">Tarjeta</option>
                                    </select>
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
</div>