    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Campus Starts -->
                

                    <!-- Header title -->
                    
                    <!-- /Header table-->

                    <!-- Table -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table" id="datatable-accessories">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descripcion</th>
                                            <th>Precio</th>          
                                            <th>Stock</th>
                                            <!-- <th>Expiration Date</th>  -->
                                            <th>Acciones</th> 
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Table -->

                    <!--/ Update Categories Modal -->
<!-- Create Product Modal -->
<div class="modal fade" id="create_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"> <!--  aria-hidden="true" -->
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 pb-5">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Agregar nuevo producto</h1>
                                        <!-- <p data-i18n="Add new campus description">Permissions you may use and assign to your users.</p> -->
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="create_product_form" class="row" onsubmit="return false">
                                        <div class="col-6">
                                            <label class="form-label">Descripción</label>
                                            <input type="text" name="accesory_description" class="form-control" placeholder="Descripcion" autofocus data-msg="" required />
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">Precio</label>
                                            <input type="text" name="accesory_price" class="form-control" placeholder="Precio" autofocus data-msg="" required />
                                        </div>
                                        
                                        <div class="col-12">
                                            <label class="form-label">Stock
                                            </label>
                                            <input type="text" name="accesory_stock" class="form-control" placeholder="Stock" autofocus data-msg="" required />
                                        </div>
                                        
                                        <div class="col-12 text-center">
                                            <button id="btn_create_product" type="submit" class="btn btn-primary mt-2 me-1">Guardar</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                                                <span>Cancelar</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                
                <!-- Permissions ends -->

            </div>
        </div>
    </div>

                        