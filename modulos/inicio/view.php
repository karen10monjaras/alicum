<style>
    #suggestions {
      box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
      height: auto;
      position: absolute;
      top: 110px;
      z-index: 9999;
      width: auto;
      max-height: 250px;
      overflow-y: auto;
    }
    
    #suggestions .suggest-element {
      background-color: #EEEEEE;
      border-top: 1px solid #d6d4d4;
      cursor: pointer;
      padding: 8px;
      width: 100%;
      float: left;
    }
</style>

<!-- Main content -->
    <section class="content">
        <div class="row">
          <!-- [ stiped-table ] start -->
          <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Venta</h2>
                        <div class="form-outline">
                            <input type="search" name="key" id="key" class="form-control" placeholder="Buscar por producto o código de barra" aria-label="Search" />
                        </div>
                        <div id="suggestions"></div>
                    </div>
                    <div class="card-body table-border-style" style="max-height: 40vh !important; overflow-y: auto;">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Producto</th>
                                        <th>Precio Unidad</th>
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
                        <div class="h3 m-4">TOTAL A PAGAR: $ <span id="total-pagar"></span></div>
                        <button class="btn btn-sm btn-outline-success my-3">Realizar venta</button>
                    </div>
                </div>
            </div>
            <!-- [ stiped-table ] end -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->