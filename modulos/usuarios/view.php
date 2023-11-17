    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <h2 class="mb-3">Usuarios</h2>
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <button type='button' class='btn btn-sm btn-info btn-new'  data-toggle='modal' data-target='#exampleModalLive'>
                  Crear perfil
                </button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID Usuario</th>
                      <th>Nombre</th>
                      <th>Usuario</th>
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
						<h5 class="modal-title" id="exampleModalLiveLabel">Datos de usuario</h5>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row">
            <form action="" method='POST'>
              <div class="card-body row">
                <div class='form-group col-md-6'>
                  <label for='nombre_usuario'>Nombre completo</label>
                  <input type='text' class='form-control' id='nombre' name='nombre' required>
                </div>
                <div class='form-group col-md-6'>
                  <label for='usuario'>Nombre de usuario</label>
                  <input type='hidden' class='form-control' id='id_usuario' name='id_usuario'>
                  <input type='text' class='form-control' id='nombre_usuario' name='nombre_usuario' required>
                </div>
                <div class='form-group col-md-6'>
                  <label for='contrasenia' id='pass-label'>Contraseña</label>
                  <input type='password' class='form-control' id='contrasenia' name='contrasenia' required>
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

    <script src="assets/js/usuarios.js"></script>