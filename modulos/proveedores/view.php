    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <button type='button' class='btn btn-sm btn-info btn-new'  data-toggle='modal' data-target='#exampleModalLive'>
                  Nuevo proveedor
                </button>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID proveedor</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
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
                  <label for='nombre_usuario'>Nombre</label>
                  <input type='hidden' class='form-control' id='id_proveedor' name='id_proveedor'>
                  <input type='text' class='form-control' id='nombre_proveedor' name='nombre_proveedor' required>
                </div>
                <div class='form-group col-md-6'>
                  <label for='usuario'>Teléfono</label>
                  <input type='tel' class='form-control' id='telefono_proveedor' name='telefono_proveedor' required>
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
				url: "modulos/proveedores/table.php",
				dataSrc: ""
				},
				columns: [
          { data: "id_proveedor" },
          { data: "nombre_proveedor" },
          { data: "telefono_proveedor" },
          {
            data: "id_proveedor",
            render: function (data, type) {
              if (type === 'display') {
                template = `
                <button type='button' id='${data}' class='btn btn-sm btn-success btn-edit' data-toggle='modal' data-target='#exampleModalLive'>
                  <i class='fas fa-edit'></i>
                </button>
                <button id='${data}' class='btn btn-sm btn-danger btn-delete'>
                  <i class='fas fa-trash'></i>
                </button>`;
              }
              return template;
            }
          }
        ],
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

      $("form").submit(function(e){
        e.preventDefault();
      });

      // Reiniciar formulario 
      function resetForm() {
        $("#id_proveedor").val("");
        $("#nombre_proveedor").val("");
        $("#telefono_proveedor").val("");
        $(".btn-continue").attr("act", "insertar");
      }

      // Reiniciar formulario al abrir modal
      $(".btn-new").click(function() {
        resetForm();
      });

      // Mostrar datos a actualizar
      $(document).on('click', '.btn-continue', function() {
        let action = $(this).attr("act");

        let formData = new FormData(document.querySelector("form"));
        formData.append('action', action);
    
        $.ajax({
          url: "modulos/proveedores/model.php",
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            console.log(response);
          },
          complete: function() {
            resetForm();
            table.ajax.reload();
          }
        });
      });

      // Mostrar datos a actualizar
      $(document).on('click', '.btn-edit', function() {
        var edit_id = $(this).attr("id");

        $.ajax({
          url: "modulos/proveedores/model.php",
          method: "POST",
          data: {
            edit_id
          },
          success: function(response) {
            let data = JSON.parse(response);

            $("#id_proveedor").val(data[0].id_proveedor);
            $("#nombre_proveedor").val(data[0].nombre_proveedor);
            $("#telefono_proveedor").val(data[0].telefono_proveedor);
            $(".btn-continue").attr("act", "actualizar");
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
              url: "modulos/proveedores/model.php",
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