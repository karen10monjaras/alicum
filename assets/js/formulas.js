$(document).ready(function () {
  var table;

  table = $("#example1").DataTable({
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    ordering: false,
    pageLength: 5,
    buttons: [
      {
        extend: "collection",
        text: "Exportar",
        buttons: [
          {
            extend: "pdf",
            text: "Generar PDF",
            pageSize: "LEGAL",
          },
          {
            extend: "excel",
            text: "Generar Excel",
          },
          {
            extend: "print",
            text: "Imprimir",
          },
        ],
      },
      {
        extend: "colvis",
        text: "Visor de columnas",
      },
    ],
    ajax: {
      url: "modulos/formulas/table.php",
      dataSrc: "",
    },
    columns: [
      { data: "id_producto" },
      { data: "nombre_producto" },
      { data: "stock" },
      {
        data: "id_producto",
        render: function (data, type) {
          if (type === "display") {
            template = `
            <button type='button' id='${data}' class='btn btn-sm btn-primary btn-add' data-toggle='modal' data-target='#exampleModalLive'>
              <i class='fas fa-plus'></i>
            </button>
            <button id='${data}' class='btn btn-sm btn-success btn-edit' data-toggle='modal' data-target='#exampleModalLive2'>
              <i class='fas fa-edit'></i>
            </button>`;
          }
          return template;
        },
      },
    ],
    language: {
      emptyTable: "No hay registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
      infoEmpty: "Mostrando 0 a 0 de 0 resultados",
      infoFiltered: "(Filtrado de _MAX_ entradas totales)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ resultados",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });

  // Funcion para limpiar el formulario
  function resetForm() {
    $("#key").val("");
    $("#tbl-productos").empty();
    $("#cantidad_fabricacion").val("");
    $("#lista_productos").empty();
    id_productos_primarios = [];
  }

  // Agregamos los productos a la tabla tbl-productos
  $(document).on("click", ".btn-add", function () {
    id_producto = $(this).attr("id");
    $("#lista_productos").empty();

    $.ajax({
      url: "modulos/formulas/model.php",
      method: "POST",
      data: {
        edit_id: id_producto,
      },
      success: function (response) {
        let data = JSON.parse(response);
        if (data.length == 0) return;

        // Iterar sobre los datos y agregar filas a la tabla
        $.each(data, function (index, item) {
          $.each(item.extra, function (extraIndex, extraItem) {
            var template = `
              <tr data-id="${item.id_producto}">
                <td>${extraItem.nombre_producto}</td>
                <td class='text-center' old_stock='${extraItem.stock}'>${extraItem.stock}</td>
                <td class='text-center cant-formula'>${item.cantidad_producto}</td>
              </tr>`;
            $("#lista_productos").append(template);
          });
        });
      },
      complete: function () {
        refrescarExistencias();
      }
    });
  });

  function refrescarExistencias() {
    cantidad = parseInt($("#cantidad_fabricacion").val());

    // Ternario para habilitar o deshabilitar el boton de preparar
    $("#btn-prepare").attr("disabled", cantidad >= 1 ? false : true);

    // habilitar o deshabilitar el boton de preparar si hay formula
    $("#err").attr("hidden", $("#lista_productos tr").length == 0 ? false : true);
    $("#cantidad_fabricacion").attr("disabled", $("#lista_productos tr").length == 0 ? true : false);

    if (cantidad <= 0) $("#cantidad_fabricacion").val("");
    if (isNaN(cantidad)) cantidad = 0;

    $("#lista_productos tr").each(function () {
      var cant_formula = parseInt($(this).find("td:eq(2)").text());
      var stockCell = $(this).find("td:eq(1)");
      var old_stock = parseInt(stockCell.attr("old_stock"));
      var stock = parseInt(stockCell.text());

      // Ternario para cambiar el color de la celda de stock
      stockCell.toggleClass("text-danger", stock <= 10);

      // Asegurarse de que el stock original esté guardado en la primera iteración
      if (isNaN(old_stock)) {
        stockCell.attr("old_stock", stock);
        old_stock = stock;
      }

      // Obtener el nuevo stock
      var nuevo_stock = old_stock - cantidad * cant_formula;

      // Si el stock supera el limite de existencias, mostrar un mensaje de error
      if (nuevo_stock < 0) {
        nuevo_stock = 0;
        $("#cantidad_fabricacion").val(parseInt(old_stock / cant_formula));
        refrescarExistencias();
      }

      // Actualizar el stock visualmente en la tabla
      stockCell.text(nuevo_stock);
    });
  }

  $(document).on(
    "change input keyup",
    "#cantidad_fabricacion",
    refrescarExistencias
  );

  // Guardar la preparación de alimento en el server
  $("#btn-prepare").click(function () {
    var dataToSend = [];

    $("#lista_productos tr").each(function () {
      var id = $(this).data("id");
      var cantidad = parseFloat($(this).find("td:eq(1)").text());
      dataToSend.push({ id: id, cantidad: cantidad });
    });

    dataToSend.push({ id_producto: id_producto });
    dataToSend.push({ cantidad_generada: $("#cantidad_fabricacion").val() });

    // Enviar los datos al servidor como un objeto JSON
    $.ajax({
      type: "POST",
      url: "modulos/formulas/model.php",
      data: {
        preparar_alimento: true,
        productos: JSON.stringify(dataToSend),
      },
      success: function (response) {
        Swal.fire({
          icon: "success",
          title: "Insumos registrados",
          showConfirmButton: false,
          timer: 700,
        });
      },
      complete: function () {
        table.ajax.reload();
        resetForm();
      },
    });
  });

  // -----------------------------------------------------------

  // Agregamos los productos a la tabla tbl-productos
  $(document).on("click", ".btn-edit", function () {
    id_producto = $(this).attr("id");
    $("#tbl-productos").empty();

    $.ajax({
      url: "modulos/formulas/model.php",
      method: "POST",
      data: {
        edit_id: id_producto,
      },
      success: function (response) {
        // console.log(response); return;
        let data = JSON.parse(response);
        if (data.length == 0) return;

        // Iterar sobre los datos y agregar filas a la tabla
        $.each(data, function (index, item) {
          $.each(item.extra, function (extraIndex, extraItem) {
            var template = `
              <tr data-id="${item.id_producto}">
                <td>${extraItem.nombre_producto}</td>
                <td old_stock='${extraItem.stock}'>${extraItem.stock}</td>
                <td>
                  <div class="form-outline">
                    <input type="number" class="form-control" value="${item.cantidad_producto}"/>
                  </div>
                </td>
                <td>
                  <button id="${item.id_producto}" class="btn btn-sm btn-outline-danger delete-product" data-id="${item.id_producto}">
                    <i class="fa fas fa-trash"></i>
                  </button>
                </td>
              </tr>`;
            $("#tbl-productos").append(template);
          });
        });
      },
      complete: function () {
        refrescarStock();
      }
    });
  });

  id_productos_primarios = [];

  $("#key").on("keyup", function () {
    var key = $(this).val();
    var dataString = "key=" + key;

    $.ajax({
      type: "POST",
      url: "modulos/formulas/search.php",
      data: dataString,
      success: function (response) {
        $("#suggestions").fadeIn(100).html(response);
        $(".suggest-element").on("click", function () {
          var id = $(this).attr("id");
          var existencias = $(this).attr("stock");
          var producto = $(this).text();

          var existingRow = $('#tbl-productos tr[data-id="' + id + '"]');
          if (existingRow.length > 0) {
            var cantidadInput = existingRow.find('input[type="number"]');
            var cantidad = parseInt(cantidadInput.val());
            cantidadInput.val(cantidad + 1);
          } else {
            template = `
                <tr data-id="${id}">
                    <td>${producto}</td>
                    <td old_stock='${existencias}'>${existencias}</td>
                    <td>
                        <div class="form-outline">
                            <input type="number" class="form-control" value="1"/>
                        </div>
                    </td>
                    <td>
                      <button id="${id}" class="btn btn-sm btn-outline-danger delete-product" data-id="${id}">
                        <i class="fa fas fa-trash"></i>
                      </button>
					          </td>
                </tr>`;
            $("#tbl-productos").append(template);
          }
          id_productos_primarios.push(id);

          refrescarStock();
          $("#suggestions").fadeOut(100);
          $("#key").val("");
          return false;
        });
      }
    });
  });

  // Manejador de eventos para eliminar productos
  $("#tbl-productos").on("click", ".delete-product", function () {
    var id = $(this).data("id");

    // Eliminar el producto de la tabla
    $(this).closest("tr").remove();

    // Eliminar el producto del arreglo
    var index = id_productos_primarios.indexOf(id);
    if (index !== -1) {
      id_productos_primarios.splice(index, 1);
    }

    refrescarStock();
  });

  function refrescarStock() {
    $("#tbl-productos tr").each(function () {
      var cantidad = parseInt($(this).find('input[type="number"]').val());
      var stockCell = $(this).find("td:eq(1)");
      var old_stock = parseInt(stockCell.attr("old_stock"));
      var stock = parseInt(stockCell.text());

      if (cantidad <= 0) $(this).find('input[type="number"]').val("1");
      if (isNaN(cantidad)) cantidad = 0;

      // Asegurarse de que el stock original esté guardado en la primera iteración
      if (isNaN(old_stock)) {
        stockCell.attr("old_stock", stock);
        old_stock = stock;
      }

      var nuevo_stock = old_stock - cantidad;

      // Si el stock supera el limite de existencias, mostrar un mensaje de error
      if (nuevo_stock < 0) nuevo_stock = 0;

      // Actualizar el stock visualmente en la tabla
      stockCell.text(nuevo_stock);
    });
  }

  // Actualizar total a pagar cuando se modifica la cantidad de producto
  $("#tbl-productos").on("keyup", "input[type='number']", refrescarStock);
  $("#tbl-productos").on("change", "input[type='number']", refrescarStock);

  $("#tbl-productos tr").on("change", 'input[type="number"]', function () {
    var cantidad = parseInt($(this).val());
    var stockCell = $(this).closest("tr").find("td:eq(2)");
    var old_stock = parseInt(stockCell.attr("old_stock"));

    if (!isNaN(old_stock)) {
      // Restaurar el stock original visualmente si la cantidad se reduce
      stockCell.text(old_stock - cantidad);
    }
  });

  // Enviar los datos al servidor cuando se hace click en el boton de vender
  $("#btn-save").click(function () {
    var dataToSend = [];

    $("#tbl-productos tr").each(function () {
      var id = $(this).data("id");
      var cantidad = parseFloat($(this).find('input[type="number"]').val());
      dataToSend.push({ id: id, cantidad: cantidad });
    });

    dataToSend.push({ id_producto: id_producto });

    // Enviar los datos al servidor como un objeto JSON
    $.ajax({
      type: "POST",
      url: "modulos/formulas/model.php",
      data: {
        guardar_formula: true,
        productos: JSON.stringify(dataToSend),
      },
      success: function (response) {
        // console.log(response)
        Swal.fire({
          icon: "success",
          title: "Fórmula actualizada",
          showConfirmButton: false,
          timer: 1500,
        });
      },
      complete: function () {
        resetForm();
      },
    });
  });
});
