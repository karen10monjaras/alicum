    <!-- Main content -->
    <section class="content">
        <div class="row">
          <h2 class="mb-3">Compra de insumos</h2>
          <!-- [ stiped-table ] start -->
          <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div class="form-outline">
                            <input type="search" name="key" id="key" class="form-control" placeholder="Buscar producto por nombre" aria-label="Search" />
                        </div>
                        <div id="suggestions"></div>
                        <div class="col-md-4 float-right d-flex align-items-center">
                            <label for="proveedor" class="mt-1 mr-1 h5">Proveedor</label>
                            <select class="form-control mt-1" name="proveedor" id="proveedor">
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
                                        <th>Precio compra (C/U)</th>
                                        <th>Cantidad compra</th>
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
                        <button id="btn-buy" class="btn btn-sm btn-outline-info my-3">Confirmar compra</button>
                    </div>
                </div>
            </div>
            <!-- [ stiped-table ] end -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <script src="assets/js/compras.js"></script>