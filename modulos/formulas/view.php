    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <h2 class="mb-3">Fórmulas de alimento</h2>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Alimento fabricado</th>
                      <th>En almácen</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Llenado dinámico -->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Agregar insumo<span class="text-right" id="nombre_insumo"></span></h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <div class='col-md-12 mb-2' style="overflow-x: auto;">
              <span>Fórmula preparación</span>
              <table class="table table-xs table-bordered border">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>En almácen</th>
                    <th>Cant. Fórmula</th>
                  </tr>
                </thead>
                <tbody id="lista_productos">
                  <!-- Se rellena dinámicamente -->
                </tbody>
              </table>
            </div>
            <div class="col-md-12 mb-2">
              <label for="cantidad_fabricacion">Cantidad preparación</label>
              <input type="number" class="form-control" id="cantidad_fabricacion" name="cantidad_fabricacion">
            </div>
            <div class="container-fluid">
              <div class='text-center my-3 float-center'>
                <button type='submit' class='btn btn-md btn-outline-primary' id="btn-prepare" data-dismiss='modal'>Continuar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="exampleModalLive2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Gestionar fórmula</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <!-- Main content -->
            <section class="content">
              <div class="row">
                <!-- [ stiped-table ] start -->
                <div class="col-xl-12">
                  <div class="card">
                    <div class="card-header">
                      <div class="form-outline">
                        <input type="search" name="key" id="key" class="form-control" placeholder="Buscar producto primario" aria-label="Search" />
                      </div>
                      <div id="suggestions"></div>
                    </div>
                    <div class="card-body table-border-style" style="max-height: 40vh !important; overflow-y: auto;">
                      <div class="table-responsive">
                        <table class="table table-striped table-xs">
                          <thead id="tbl-header">
                            <tr>
                              <th>Prod. Primario</th>
                              <th>Disponible</th>
                              <th>Cantidad fórmula</th>
                              <th>Remover</th>
                            </tr>
                          </thead>
                          <tbody id="tbl-productos">
                            <!-- Se rellena con los productos seleccionados para venta -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="container-fluid">
                      <div class='text-center mb-3 float-center'>
                        <button type='submit' class='btn btn-md btn-outline-success' id="btn-save" data-dismiss='modal'>Guardar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- [ stiped-table ] end -->
              </div>
              <!-- /.row -->
            </section>
            <!-- /.content -->
          </div>
        </div>
      </div>
    </div>

    <!-- Funciones para el modulo ventas -->
    <script src="assets/js/formulas.js"></script>