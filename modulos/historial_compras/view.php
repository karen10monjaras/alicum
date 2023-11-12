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
                    <th>Nota de compra</th>
                    <th>Fecha de Compra</th>
                    <th>Proveedor</th>
                    <th>Responsable</th>
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
						<h5 class="modal-title" id="exampleModalLiveLabel">Detalles de compra con número de nota: <span class="text-right" id="nota_compra"></span></h5>
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
            <div class='col-md-12'>
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

    <script src="assets/js/historial_compras.js"></script>