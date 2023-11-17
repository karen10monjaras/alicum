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
            <h5 class="modal-title" id="exampleModalLiveLabel">Nota de compra: <span class="text-right" id="nota_compra"></span></h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <div class="col-md-6">
              <span>Fecha de compra</span>
              <p id="fecha_compra"></p>
            </div>
            <div class="col-md-6">
              <span>Proveedor</span>
              <p id="nombre_proveedor"></p>
            </div>
            <div class="col-md-6">
              <span>Responsable</span>
              <p id="responsable"></p>
            </div>
            <div class="col-md-6">
              <span>Descripción</span>
              <p id="descripcion_compra"></p>
            </div>
            <div class='col-md-12' style="overflow-x: auto;">
              <table class="table table-sm table-bordered border">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>Precio U.</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody id="lista_productos">
                  <!-- Se rellena dinámicamente -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="exampleModalLive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLiveLabel">Confirmar venta</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body row">
            <form action="" method='POST'>
              <div class="card-body row">
                <div class='form-group col-md-6'>
                  <label for='pago'>Pago con:</label>
                  <input type='number' class='form-control' id='pago'>
                </div>
                <div class='form-group col-md-6'>
                  <label for='total'>Total a pagar:</label>
                  <p class='form-control'>$ <span id='total'></span></p>
                </div>
                <div class='form-group col-md-6'>
                  <label for='descripcion_venta'>Descripción</label>
                  <textarea class="form-control" id="descripcion_venta" name="descripcion_venta" cols="2" placeholder="Ej. Pago en efectivo/crédito"></textarea>
                </div>
                <div class='form-group col-md-6'>
                  <label for='cambio'>Cambio a devolver:</label>
                  <p class='form-control'>$ <span id='cambio'></span></p>
                </div>
              </div>
              <!-- /.card-body -->
              <div class='text-center mb-4'>
                <button type='submit' id="btn-sell" class='btn btn-outline-success btn-continue' act='insertar' data-dismiss='modal'>Confirmar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Funciones para el modulo ventas -->
    <script src="assets/js/formulas.js"></script>