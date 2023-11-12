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