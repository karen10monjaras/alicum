    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <h2 class="mb-3">Clientes</h2>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <button type='button' class='btn btn-sm btn-info btn-new' data-toggle='modal' data-target='#exampleModalLive'>
                  Nuevo cliente
                </button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID cliente</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Domicilio</th>
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
						<h5 class="modal-title" id="exampleModalLiveLabel">Datos de proveedor</h5>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row">
            <form action="" method='POST'>
              <div class="card-body row">
                <div class='form-group col-md-6'>
                  <label for='nombre_cliente'>Nombre</label>
                  <input type='hidden' class='form-control' id='id_cliente' name='id_cliente'>
                  <input type='text' class='form-control' id='nombre_cliente' name='nombre_cliente' required>
                </div>
                <div class='form-group col-md-6'>
                  <label for='telefono_cliente'>Teléfono</label>
                  <input type='tel' class='form-control' id='telefono_cliente' name='telefono_cliente'>
                </div>
                <div class='form-group col-md-6'>
                  <label for='domicilio_cliente'>Domicilio</label>
                  <input type='text' class='form-control' id='domicilio_cliente' name='domicilio_cliente' required>
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

    <script src="assets/js/clientes.js"></script>