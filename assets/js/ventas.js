$(document).ready(function() {
    id_productos = [];

    // Cargar lista de clientes en el select
    $.ajax({
        type: "POST",
        url: "modulos/ventas/model.php",
        data: { clientes: true },
        success: function (response) {
            $("#cliente").append(response);
        },
        error: function (response) {
            console.log(response);
        }
    });

    // Funcion que habilita el boton de venta cuando hay productos en la tabla 
    function habilitar_venta() {
        var existingRows = $('#tbl-productos tr');
        if (existingRows.length > 0){
            $("#tbl-header").removeAttr("hidden");
	        $("#btn-sell").removeAttr("disabled");

            if (parseFloat($('#total-pagar').text()) > 0) {
                $("#btn-sell").fadeIn(500);
            } else {
                $("#btn-sell").attr("disabled", true);
                $("#btn-sell").fadeOut(500);
            }
        } else {
            $("#tbl-header").attr("hidden", true);
            $("#btn-sell").attr("disabled", true);
            $("#btn-sell").fadeOut(500);
        }
    }

    habilitar_venta();

    $('#key').on('keyup', function() {
      var key = $(this).val();		
      var dataString = 'key='+key;
  
      $.ajax({
        type: "POST",
        url: "modulos/ventas/search.php",
        data: dataString,
        success: function(response) {
          $('#suggestions').fadeIn(100).html(response);
          $('.suggest-element').on('click', function(){
            var id = $(this).attr('id');
            var precio = parseFloat($(this).attr('precio')).toLocaleString('es-MX', { minimumFractionDigits: 2 });
            var existencias = $(this).attr('stock');
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
                    <td>$ <span class='precio'>${precio}</span></td>
                    <td old_stock='${existencias}'>${existencias}</td>
                    <td>
                        <div class="form-outline">
                            <input type="number" class="form-control" value="1"/>
                        </div>
                    </td>
                    <td>$ <span class='subtotal'>${precio}</span></td>
                    <td>
						<button id="${id}" class="btn btn-sm btn-outline-danger delete-product" data-id="${id}">
							<i class="fa fas fa-trash"></i>
						</button>
					</td>
                </tr>`;
				$('#tbl-productos').append(template);
            }
            id_productos.push(id);

			calcularTotal();
            $('#suggestions').fadeOut(100);
            $("#key").val("");
            return false;
        });
        }
      });
    });

    // Actualizar total a pagar cuando se modifica la cantidad de producto
    $("#tbl-productos").on("keyup", "input[type='number']", calcularTotal);
    $("#tbl-productos").on("change", "input[type='number']", calcularTotal);

	// Manejador de eventos para eliminar productos
    $('#tbl-productos').on('click', '.delete-product', function () {
        var id = $(this).data('id');

        // Eliminar el producto de la tabla
        $(this).closest('tr').remove();

        // Eliminar el producto del arreglo
        var index = id_productos.indexOf(id);
        if (index !== -1) {
            id_productos.splice(index, 1);
        }

        calcularTotal();
    });

    function calcularTotal() {
        var total = 0;
        $('#tbl-productos tr').each(function () {
            var cantidad = parseInt($(this).find('input[type="number"]').val());
            var precio = parseFloat($(this).find('.precio').text().replace(/,/g, ''));
            var stockCell = $(this).find('td:eq(2)');
            var old_stock = parseInt(stockCell.attr("old_stock"));
            var stock = parseInt(stockCell.text());
            
            if (cantidad <= 0) $(this).find('input[type="number"]').val("1");
            if (isNaN(cantidad)) cantidad = 0;
            
            $(this).find('.subtotal').text((cantidad * precio).toLocaleString('es-MX', { minimumFractionDigits: 2 }));
            
            var subtotal = cantidad * precio;
            total += subtotal;
        
            // Asegurarse de que el stock original esté guardado en la primera iteración
            if (isNaN(old_stock)) {
                stockCell.attr("old_stock", stock);
                old_stock = stock;
            }
        
            var nuevo_stock = old_stock - cantidad;

            // Si el stock supera el limite de existencias, mostrar un mensaje de error
            if (nuevo_stock < 0) {
                Swal.fire({
                    icon: "error",
                    title: "No hay suficientes existencias",
                    showConfirmButton: false,
                    timer: 1500
                });
                nuevo_stock = 0;
                $(this).find('input[type="number"]').val(old_stock);
            }
        
            // Actualizar el stock visualmente en la tabla
            stockCell.text(nuevo_stock);
        });

        $('#total-pagar').text(total.toLocaleString('es-MX', { minimumFractionDigits: 2 }));
        $('#total').text(total.toLocaleString('es-MX', { minimumFractionDigits: 2 }));
        habilitar_venta();

		return total;
    }

    $('#tbl-productos tr').on('change', 'input[type="number"]', function () {
        var cantidad = parseInt($(this).val());
        var stockCell = $(this).closest('tr').find('td:eq(2)');
        var old_stock = parseInt(stockCell.attr("old_stock"));
    
        if (!isNaN(old_stock)) {
            // Restaurar el stock original visualmente si la cantidad se reduce
            stockCell.text(old_stock - cantidad);
        }
    });

    // Función para calcular y actualizar el cambio
    function calcularCambio() {
        var pago = parseFloat($("#pago").val());
        var total = parseFloat($('#total-pagar').text().replace(/,/g, ''));
        var cambio = pago - total;
        if (cambio < 0) cambio = 0;
        $('#cambio').text(cambio.toLocaleString('es-MX', { minimumFractionDigits: 2 }));
    }

    // Llamar a la función cuando se modifica el dinero recibido
    $("#pago").on("keyup", function() {
        calcularCambio();
    });

    $("#btn-confirm").on("click", function() {
        calcularCambio();
    });

    // Funcion para limpiar el formulario
    function resetForm() {
        $("#descripcion_venta").val("");
        $("#pago").val("");
        $("#cambio").val("");
        $("#key").val("");
        $("#tbl-productos").empty();
        $("#total-pagar").text("0.00");
        $("#tbl-header").attr("hidden", true);
        $("#btn-sell").attr("disabled", true);
        $("#btn-sell").fadeOut(500);
        id_productos = [];
    }
    
    // Enviar los datos al servidor cuando se hace click en el boton de vender
	$("#btn-sell").click(function() {
		var total  = calcularTotal();
        var dataToSend = [];

        $('#tbl-productos tr').each(function () {
            var id = $(this).data('id');
            var cantidad = parseInt($(this).find('input[type="number"]').val());
            var precio = parseFloat($(this).find('.precio').text().replace(/,/g, ''));
            dataToSend.push({ precio: precio, id: id, cantidad: cantidad });
        });

		// Agrega el total al objeto JSON
		dataToSend.push({ descripcion: $("#descripcion_venta").val() });
		dataToSend.push({ total: total });
		dataToSend.push({ cliente: $("#cliente").val() });

        // Enviar los datos al servidor como un objeto JSON
        $.ajax({
            type: "POST",
            url: "modulos/ventas/model.php",
            data: { productos: JSON.stringify(dataToSend) },
            success: function (response) {
                Swal.fire({
                    icon: "success",
                    title: "Venta realizada",
                    showConfirmButton: false,
                    timer: 1500
                });
			},
            complete: function() {
                resetForm();
            }
        });
	});

  });