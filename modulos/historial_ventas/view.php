    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nota de venta</th>
                    <th>Fecha de venta</th>
                    <th>Cliente</th>
                    <th>Atendió</th>
                    <th>Total ($)</th>
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
						<h5 class="modal-title" id="exampleModalLiveLabel">Nota de venta: <span class="text-right" id="nota_venta"></span></h5>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row">
            <div class="col-md-12">
              <p class="h6 border-bottom mb-4">Fecha de venta: <span id="fecha_venta"></span></p>
            </div>
            <div class="col-md-6">
              <p class="h6 border-bottom mb-4">Atendió: <span id="responsable"></span></p>
            </div>
            <div class="col-md-6">
              <p class="h6 border-bottom mb-4">Cliente: <span id="nombre_cliente"></span></p>
            </div>
            <div class="col-md-6">
              <p class="h6 border-bottom mb-4">Descripción: <span id="descripcion_venta"></span></p>
            </div>
            <div class='col-md-12' style="overflow-x: auto;">
              <table class="table table-sm table-bordered border responsive">
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

    <script src="assets/js/historial_ventas.js"></script>