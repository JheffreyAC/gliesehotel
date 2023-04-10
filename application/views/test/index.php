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
                                            <select name="vt_description" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Serie</label>
                                        <input name="proof_series" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Numero De Serie</label>
                                        <input name="voucher_series" type="text" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <div>
                                            <label class="form-label">Tipo de Pago</label>
                                            <select name="pt_description" class="form-select select2" data-msg="" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                <div class="col-12">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_product_modal">Agregar productos</button>
                                </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="modal fade" id="create_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-product">
                                            <!-- Contenido del modal -->
                                            <div class="modal-content">
                                                <div class="modal-header bg-transparent pb-3">
                                                    <h2 class="modal-title text-center" style="position: relative; left: 380px; top: 50px;">Seleccione Producto</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body pb-5 px-sm-5 pt-50 text-center">
                                                    <div class="row mb-3" style="position: relative; top: 20px;">
                                                        <div class="col">
                                                            <input type="text" class="form-control" placeholder="Buscar">
                                                        </div>
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-primary">Buscar</button>
                                                        </div>
                                                    </div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Opciones</th>
                                                                <th>Nombre</th>
                                                                <th>U.Medida</th>
                                                                <th>Categoría</th>
                                                                <th>Código</th>
                                                                <th>Stock</th>
                                                                <th>Precio Venta</th>
                                                                <th>Afectación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary">✚</button>
                                                                </td>
                                                                <td>Producto 1</td>
                                                                <td>Pieza</td>
                                                                <td>Categoría 1</td>
                                                                <td>123456</td>
                                                                <td>50</td>
                                                                <td>100</td>
                                                                <td>Exento</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary">✚</button>
                                                                </td>
                                                                <td>Producto 2</td>
                                                                <td>Pieza</td>
                                                                <td>Categoría 1</td>
                                                                <td>123456</td>
                                                                <td>50</td>
                                                                <td>100</td>
                                                                <td>Exento</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary">✚</button>
                                                                </td>
                                                                <td>Producto 3</td>
                                                                <td>Pieza</td>
                                                                <td>Categoría 1</td>
                                                                <td>123456</td>
                                                                <td>50</td>
                                                                <td>100</td>
                                                                <td>Exento</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary">✚</button>
                                                                </td>
                                                                <td>Producto 4</td>
                                                                <td>Pieza</td>
                                                                <td>Categoría 1</td>
                                                                <td>123456</td>
                                                                <td>50</td>
                                                                <td>100</td>
                                                                <td>Exento</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary">✚</button>
                                                                </td>
                                                                <td>Producto 5</td>
                                                                <td>Pieza</td>
                                                                <td>Categoría 1</td>
                                                                <td>123456</td>
                                                                <td>50</td>
                                                                <td>100</td>
                                                                <td>Exento</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <nav aria-label="Page navigation">
                                                        <ul class="pagination justify-content-center my-2">
                                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Anterior</a></li>
                                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           
                                <!-- Table -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <table class="table" id="datatable-income">
                                                <thead>
                                                    <tr>
                                                        <th>Acciones</th>
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