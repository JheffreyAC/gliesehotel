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
                  <h2 class="content-header-title float-start mb-0">Personalización</h2>
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
          <div class="col-12">
            <div class="card pb-3">
              <!-- <div class="card-header flex justify-content-end align-items-center">
                        <button class="btn btn-primary w-10 mb-2 mx-2 btn_create_guest" type="button" data-bs-toggle="modal" data-bs-target="#create_guest_reservation_modal">
                            <span>Agregar Cliente</span>
                            <i class="fa-solid fa-person"></i>
                        </button>
                    </div> -->
              <div class="card-body">
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-2" id="data-container">
                  <!-- Aquí se mostrarán tus datos -->
                  <div class="col-12">
                    <form class="mt-2 mb-2" id="personalization_form">
                      <div class="form-row w-100">
                        <div class="col-md-4 mb-1 w-100">
                          <label for="validationDefault01">Nombre de la Empresa</label>
                          <input type="text" class="form-control w-100" id="company_name_form" name="company_name" placeholder="Nombre de la Empresa" required>
                        </div>
                        <div class="col-md-4 mb-1 w-100">
                          <label for="validationDefault02">RUC</label>
                          <input type="text" class="form-control w-100" name="ruc" id="company_ruc_form" placeholder="RUC" required>
                        </div>
                      </div>
                      <div class="form-row w-100">
                        <div class="col-md-6 mb-1 w-100">
                          <label for="validationDefault03">Dirección</label>
                          <input type="text" class="form-control" id="company_address_form" name="address" placeholder="Dirección" required>
                        </div>
                        <div class="form-row w-100">
                          <div class="mb-3">
                            <label for="formFile" class="form-label">Logo de la Empresa</label>
                            <input class="form-control" name="logo" type="file" id="company_logo_form">
                          </div>
                        </div>
                      </div>
                      <div class="w-100 d-flex justify-content-center gap-1">
                        <button class="btn btn-primary" type="submit" id="save_personalization">
                          Guardar Configuración
                        </button>
                        <button class="btn btn-primary" type="button" id="edit_personalization">
                          Editar Configuración
                        </button>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Header table-->

          <!-- Table -->

          <!-- /Table -->

          <!--/ Update Categories Modal -->



          <!-- Permissions ends -->

        </div>
      </div>
    </div>
    <!-- END: Content-->