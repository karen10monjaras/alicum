    <!-- Main content -->
    <section class="content">
        <div class="row">
          <!-- [ stiped-table ] start -->
          <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Venta</h2>
                        <div class="form-outline">
                            <input type="search" name="key" id="key" class="form-control" placeholder="Buscar por producto por nombre" aria-label="Search" />
                        </div>
                        <div id="suggestions"></div>
                        <div class="col-md-4 float-right d-flex align-items-center">
                            <label for="cliente" class="mt-1 mr-1 h5">Cliente</label>
                            <select class="form-control mt-1" name="cliente" id="cliente">
                                <!-- Se rellena dinámicamente -->
                            </select>
                        </div>
                    </div>
                    <div class="card-body table-border-style" style="max-height: 40vh !important; overflow-y: auto;">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead id="tbl-header">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio C/Unidad</th>
                                        <th>En almácen</th>
                                        <th>Cantidad</th>
                                        <th>Remover</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl-productos">
                                    <!-- Se rellena con los productos seleccionados para venta -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid border d-flex">
                        <div class="h3 m-4">TOTAL A PAGAR: $ <span id="total-pagar">0.00</span></div>
                        <button type='button' id="btn-confirm" class='btn btn-sm btn-outline-success my-3' data-toggle='modal' data-target='#exampleModalLive'>
                            Continuar
                        </button>
                    </div>
                </div>
            </div>
            <!-- [ stiped-table ] end -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

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
                                <input type='number' class='form-control' id='pago' name='pago'>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='total'>Total a pagar:</label>
                                <input type='text' class='form-control' id='total' name='total' disabled>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='descripcion_venta'>Descripción</label>
                                <textarea class="form-control" id="descripcion_venta" name="descripcion_venta" cols="2" placeholder="Ej. Pago en efectivo/crédito"></textarea>
                            </div>
                            <div class='form-group col-md-6'>
                                <label for='cambio'>Cambio a devolver:</label>
                                <input type='text' class='form-control' id='cambio' name='cambio' disabled>
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
    <script src="assets/js/ventas.js"></script>