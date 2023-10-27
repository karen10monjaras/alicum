    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios Administradores</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Tabla que muestra los usuarios traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class='container-fluid mb-3'>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#modal-default' onclick='reset_user_data()'>
              Nuevo usuario
            </button>
          </div>
          <div class='modal fade' id='modal-default' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Datos de usuario</h4>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <form method='POST' id='form' action='modules/usuarios/model.php'>
                    <div class='card-body row'>
                      <div class='form-group col-md-6'>
                        <label for='usuario'>Nombre de usuario</label>
                        <input type='hidden' class='form-control' id='id_usuario' name='id_usuario'>
                        <input type='text' class='form-control' id='usuario' name='usuario' pattern='^([\w]){6,}$' title='Ingrese nombre de usuario mayor a 5 carácteres y sin espacios' placeholder='Nombre corto (sin espacios)' required>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='contrasenia' id='pass-label'>Contraseña</label>
                        <input type='password' class='form-control' id='contrasenia' name='contrasenia' pattern='^([\w]){6,}$' title='Ingrese una contraseña mayor a 5 carácteres' required>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='nombre_usuario'>Nombre completo</label>
                        <input type='text' class='form-control' id='nombre_usuario' name='nombre_usuario' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Pedro...' required>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='telefono_usuario'>Teléfono</label>
                        <input type='text' class='form-control' id='telefono_usuario' name='telefono_usuario' data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder='(999) 999-9999'>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='correo_usuario'>Correo</label>
                        <input type='email' class='form-control' id='correo_usuario' name='correo_usuario' placeholder='usuario@gmail.com'>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='rol_usuario'>Rol de usuario</label>
                        <select class='form-control' id='rol_usuario' name='rol_usuario'>
                          <option value='Usuario'>Usuario</option>
                          <option value='Admin'>Admin</option>
                        </select>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='rol_usuario'>Estatus</label>
                        <select class='form-control' id='estado_usuario' name='estado_usuario' disabled>
                          <option value='Activo'>Activo</option>
                          <option value='Suspendido'>Suspendido</option>
                        </select>
                      </div>
                    </div>
                        <!-- /.card-body -->
        
                    <div class='text-center mb-4'>
                      <button type='reset' class='btn btn-outline-danger' data-dismiss='modal'>Cancelar</button>
                      <button type='submit' mod='usuarios' class='btn btn-outline-success btn-next' action='insert' data-dismiss='modal'>Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->
          
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Creación de cuenta</th>
                    <th>Estatus</th>
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
    <!-- /.table -->
