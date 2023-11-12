    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <button type='button' class='btn btn-sm btn-info btn-new'  data-toggle='modal' data-target='#exampleModalLive'>
                  Nuevo producto
                </button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID producto</th>
                      <th>Producto</th>
                      <th>Precio C/Unidad</th>
                      <th>Stock</th>
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
						<h5 class="modal-title" id="exampleModalLiveLabel">Datos de producto</h5>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row">
            <form action="" method='POST'>
              <div class="card-body row">
                <div class='form-group col-md-6'>
                  <label for='nombre_producto'>Nombre del producto</label>
                  <input type='hidden' class='form-control' id='id_producto' name='id_producto'>
                  <input type='text' class='form-control' id='nombre_producto' name='nombre_producto' required>
                </div>
                <div class='form-group col-md-6'>
                  <label for='precio_producto'>Precio por unidad</label>
                  <input type='number' class='form-control' id='precio_producto' name='precio_producto' required>
                </div>
              </div>
              <!-- /.card-body -->
              <div class='text-center mb-4'>
                <button type='submit' class='btn btn-outline-success btn-continue' act='insertar' data-dismiss='modal'>Guardar</button>
              </div>
            </form>
					</div>
				</div>
			</div>
		</div>

    <script src="assets/js/almacen.js"></script>