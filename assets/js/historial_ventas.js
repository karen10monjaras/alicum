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
        url: "modulos/historial_ventas/table.php",
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
      </button>`;
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
url: "modulos/historial_ventas/model.php",
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
  $("#descripcion_venta").text(data.transaccion_data[0].descripcion_venta);
      
  var productosData = data.productos_data;
  var listaProductos = $('#lista-productos');
      
  $.each(productosData, function(index, producto) {
    var nombre_producto = producto.nombre_producto;
    var cantidad_producto = producto.cantidad_producto;
    var precio_venta = producto.precio_venta;
    var total_venta = cantidad_producto * precio_venta;

    var li = `
    <li>
      ${nombre_producto} x ${cantidad_producto} unidades a $ ${precio_venta} = $ ${total_venta}
    </li>`;
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
    url: "modulos/historial_ventas/model.php",
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