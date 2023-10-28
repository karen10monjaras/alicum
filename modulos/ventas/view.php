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
                    <th>Fecha Venta</th>
                    <th>Cliente</th>
                    <th>Responsable</th>
                    <th>Total venta($)</th>
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
						<h5 class="modal-title" id="exampleModalLiveLabel">Detalles de venta</h5>
						<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body row">
						<div class="col-md-6">
              <span>Nota venta</span>
              <p id="nota_venta"></p>
            </div>
            <div class="col-md-6">
              <span>Fecha venta</span>
              <p id="fecha_venta"></p>
            </div>
            <div class="col-md-6">
              <span>Cliente</span>
              <p id="nombre_cliente"></p>
            </div>
            <div class="col-md-6">
              <span>Responsable</span>
              <p id="responsable"></p>
            </div>
            <div class="col-md-6">
              <span>Total venta ($)</span>
              <p id="total_venta"></p>
            </div>
            <div class='col-md-6'>
              <span>Productos</span>
              <ul id="lista-productos" style="list-style: none; padding: 0;"></ul>
            </div>
					</div>
				</div>
			</div>
		</div>

    <script>
		$(document).ready(function() {
			var table;
			
			table = $("#example1").DataTable({
				"responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, 
				pageLength: 5,
				buttons: [
				{
					extend: 'collection',
					text: 'Exportar',
					buttons: [
					{
						extend: 'pdf',
						text: "Generar PDF",
						pageSize: 'LEGAL'
					},
					{
						extend: 'excel',
						text: 'Generar Excel'
					},
					{
						extend: 'print',
						text: "Imprimir"
					}
					]
				},
				{
					extend: 'colvis',
					text: 'Visor de columnas',
				}
				],
				ajax: {
				url: "modulos/ventas/table.php",
				dataSrc: ""
				},
				columns: [
        { data: "id_transaccion" },
        { data: "fecha_venta" },
        { data: "nombre_cliente" },
        { data: "nombre_usuario" },
        { data: "total_venta" },
        {
          data: "id_transaccion",
          render: function (data, type) {
            if (type === 'display') {
              template = `
		          <button type='button' id='${data}' class='btn btn-sm btn-success btn-view' data-toggle='modal' data-target='#exampleModalLive'>
                <i class='fas fa-eye'></i>
              </button>
              <button id='${data}' class='btn btn-sm btn-danger btn-delete'>
                <i class='fas fa-trash'></i>
              </button>
              `;
            }
            return template;
          }
        }],
				language: {
				"emptyTable": "No hay registros",
				"info": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
				"infoEmpty": "Mostrando 0 a 0 de 0 resultados",
				"infoFiltered": "(Filtrado de _MAX_ entradas totales)",
				"infoPostFix": "",
				"thousands": ",",
				"lengthMenu": "Mostrar _MENU_ resultados",
				"loadingRecords": "Cargando...",
				"processing": "Procesando...",
				"search": "Buscar:",
				"zeroRecords": "Sin resultados encontrados",
				"paginate": {
					"first": "Primero",
					"last": "Ultimo",
					"next": "Siguiente",
					"previous": "Anterior"
				}
				}
			});

      // Mostrar transaccion
      $(document).on('click', '.btn-view', function() {
      var transaction_id = $(this).attr("id");
      $('#lista-productos').html("");

      $.ajax({
        url: "modulos/ventas/model.php",
        method: "POST",
        data: {
          transaction_id
        },
        success: function(response) {
          let data = JSON.parse(response);

          $("#nota_venta").text(data.transaccion_data[0].id_transaccion);
          $("#fecha_venta").text(data.transaccion_data[0].fecha_venta);
          $("#nombre_cliente").text(data.transaccion_data[0].nombre_cliente);
          $("#responsable").text(data.transaccion_data[0].nombre_usuario);
          $("#total_venta").text(data.transaccion_data[0].total_venta);
              
          var productosData = data.productos_data;
          var listaProductos = $('#lista-productos');
              
          $.each(productosData, function(index, producto) {
            var li = $('<li class="d-inline-flex m-1" style="list-style: none !important;"><span class="bg-info p-2 rounded">' + producto.cantidad_producto + " - " + producto.nombre_producto + '</span></li>');
            listaProductos.append(li);
          });
        }
      });
    });

    // Eliminar registro
    $(document).on('click', '.btn-delete', function() {
      var delete_id = $(this).attr("id");

      Swal.fire({
          title: `¿Seguro que desea eliminar el registro ${delete_id}?`,
          icon: 'error',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Si, continuar!',
          cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "modulos/ventas/model.php",
            method: "POST",
            data: {
              delete_id
            },
            success: function(response) {
              Swal.fire({
                icon: "success",
                title: response,
                showConfirmButton: false,
                timer: 2000
              });
            },
            complete: function() {
              table.ajax.reload();
            }
          });
        }
      });
    });

	});
	</script>