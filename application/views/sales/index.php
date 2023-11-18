    <!-- BEGIN: Content-->
    <div class="app-content content ">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
          <!-- Header title -->
          <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
              <div class="row breadcrumbs-top">
                <div class="col-12">
                  <h2 class="content-header-title float-start mb-0">Ventas</h2>
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
        <div class="content-body">
          <!-- Campus Starts -->


          <!-- Header title -->

          <!-- /Header table-->

          <!-- Table -->
          <div class="col-12">
            <div class="card pb-3">
              <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-2" id="data-container">
                  <!-- Aquí se mostrarán tus datos -->
                </div>
              </div>
            </div>
          </div>
          <!-- /Table -->

          <!--/ Update Categories Modal -->




          <!--  -->

          <!--  -->
















          <div class="modal fade" id="sales_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
              <div class="modal-content mx-auto">
                <div class="modal-header bg-transparent">
                  <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 pb-5">
                  <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Detalles</button>
                      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Ventas</button>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                      <form method="POST" enctype="multipart/form-data" id="create_sales_form" class="row" onsubmit="return false">
                        <div class="text-center mb-2">
                          <h1 class="mb-1 mt-4">Datos de Reservas</h1>
                        </div>
                        <div class="col-12">
                          <label class="form-label">Número de Habitación</label>
                          <input type="text" name="room_number" class="form-control" data-msg="" required readonly />
                        </div>
                        <div class="col-12">
                          <label class="form-label">Tipo de Habitación</label>
                          <input type="text" name="type_name" class="form-control" data-msg="" required readonly />
                        </div>
                        <div class="col-12">
                          <label class="form-label">Tipo de Documento</label>
                          <input type="text" name="document_type" class="form-control" data-msg="" required readonly />
                        </div>
                        <div class="col-12">
                          <label class="form-label">Numero de Documento</label>
                          <input type="text" name="document_number" class="form-control" data-msg="" required readonly />
                        </div>
                        <div class="col-12" id="first_names">
                          <label class="form-label">Nombre</label>
                          <input type="text" name="first_names" class="form-control" readonly />
                        </div>
                        <div class="col-12" id="last_names">
                          <label class="form-label">Apellido</label>
                          <input type="text" name="last_names" class="form-control" data-msg="" readonly />
                        </div>
                        <div class="col-12">
                          <label class="form-label">Dirección</label>
                          <input type="text" name="address" class="form-control" data-msg="" readonly />
                        </div>
                        <div class="col-12" id="company_names">
                          <label class="form-label">Razón Social</label>
                          <input type="text" name="company_name" class="form-control" data-msg="" readonly />
                        </div>

                        <br>

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                      <div class="col-12 text-center">
                        <h1 class="mb-1 mt-4">Ventas</h1>
                        <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#create_income_product_modal">Agregar productos</button>
                      </div>
                      <div class="col-12">
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <table class="table p-2" id="add_products">
                                <thead>
                                  <tr>
                                    <th>Acciones</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tfoot style="font-size: 1.8rem;">
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th></th>
                                  <th>Total</th>
                                  <th>
                                    <span class="text-center" id="total-sales-price">
                                      S/ 00.00
                                    </span>
                                  </th>
                                </tfoot>
                              </table>
                              <!-- <span class="" id="total-sales-price"> -->
                              <!-- 00 -->
                              <!-- </span> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary mt-2 me-2" id="btn_create_guest_reservation" type="submit">Agregar Venta</button>
                        <button type="reset" class="btn btn-outline-secondary mt-2 reset" data-bs-dismiss="modal" aria-label="Close">
                          <span>Cancelar</span>
                        </button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Permissions ends -->




          <div class="modal fade" id="create_income_product_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered modal-edit-product">
              <div class="modal-content">
                <div class="modal-header bg-transparent">
                  <button type="reset" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 pb-5">
                  <div class="text-center mb-2">
                    <h1 class="mb-1">Selecionar Producto</h1>
                  </div>
                  <table class="table table-responsive" id="datatables-income-products">
                    <thead>
                      <tr>
                        <th>Acción</th>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Categoria</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>






        </div>
      </div>
    </div>
    <!-- END: Content-->