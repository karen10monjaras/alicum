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
                    <th>N. transacción</th>
                    <th>Fecha Compra</th>
                    <th>Proveedor</th>
                    <th>Responsable</th>
                    <th>Total compra($)</th>
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
              <span>Fecha compra</span>
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
              <span>Total compra ($)</span>
              <p id="total_compra"></p>
            </div>
            <div class='col-md-12'>
              <span>Insumos</span>
              <ul id="lista-productos" style="list-style: none; padding: 0; margin: 0;"></ul>
            </div>
					</div>
				</div>
			</div>
		</div>

    <script src="assets/js/historial_compras.js"></script>