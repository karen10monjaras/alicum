$(document).ready(function() {
    id_productos = [];

    // Cargar lista de clientes en el select
    $.ajax({
        type: "POST",
        url: "modulos/compras/model.php",
        data: { proveedores: true },
        success: function (response) {
            $("#proveedor").append(response);
        },
        error: function (response) {
            console.log(response);
        }
    });

    // Funcion que habilita el boton de venta cuando hay productos en la tabla 
    function habilitar_compra() {
        var existingRows = $('#tbl-productos tr');
        if (existingRows.length > 0) {
            $("#tbl-header").removeAttr("hidden");
	        $("#btn-buy").removeAttr("disabled");
            
            if (parseFloat($('#total-pagar').text()) > 0){
                $("#btn-buy").fadeIn(50);
            } else {
                $("#btn-buy").attr("disabled", true);
                $("#btn-buy").fadeOut(50);
            }

        } else {
            $("#tbl-header").attr("hidden", true);
            $("#btn-buy").attr("disabled", true);
            $("#btn-buy").fadeOut(50);
        }
    }

    habilitar_compra();

    $('#key').on('keyup', function() {
      var key = $(this).val();		
      var dataString = 'key='+key;
  
      $.ajax({
        type: "POST",
        url: "modulos/compras/search.php",
        data: dataString,
        success: function(response) {
          $('#suggestions').fadeIn(100).html(response);
          $('.suggest-element').on('click', function(){
            var id = $(this).attr('id');
            var precio = $(this).attr('precio');
            var producto = $(this).text();
  
			var existingRow = $('#tbl-productos tr[data-id="' + id + '"]');
            if (existingRow.length > 0) {
                var cantidadInput = existingRow.find('.cantidad');
                var cantidad = parseInt(cantidadInput.val());
                cantidadInput.val(cantidad + 1);
            } else {
                template = `
                <tr data-id="${id}">
                    <td>${producto}</td>
                    <td>
                        <div class="form-outline">
                            <input type="number" class="form-control precio" value="${precio}"/>
                        </div>
                    </td>
                    <td>
                        <div class="form-outline">
                            <input type="number" class="form-control cantidad" value="1"/>
                        </div>
                    </td>
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
            var cantidad = parseInt($(this).find('.cantidad').val());
            var precio = parseFloat($(this).find('.precio').val());
            
            if (cantidad <= 0) $(this).find('.cantidad').val("1");
            
            if (isNaN(cantidad)) cantidad = 0;

            var subtotal = cantidad * precio;
            total += subtotal;
        });

        $('#total-pagar').text(total.toLocaleString('es-MX', { minimumFractionDigits: 2 }));
        habilitar_compra();

		return total;
    }

	$("#btn-buy").click(function() {
		var total  = calcularTotal();
        var dataToSend = [];

        $('#tbl-productos tr').each(function () {
            var id = $(this).data('id');
            var cantidad = parseFloat($(this).find('.cantidad').val());
            var precio = parseFloat($(this).find('.precio').val());
            dataToSend.push({ precio: precio, id: id, cantidad: cantidad });
        });

		// Agrega el total al objeto JSON
		dataToSend.push({ total: total });
		dataToSend.push({ proveedor: $("#proveedor").val() });

        // Enviar los datos al servidor como un objeto JSON
        $.ajax({
            type: "POST",
            url: "modulos/compras/model.php",
            data: { productos: JSON.stringify(dataToSend) },
            success: function (response) {
                console.log(JSON.stringify(dataToSend))
                Swal.fire({
                    icon: "success",
                    title: "Compra de insumos registrada exitosamente",
                    showConfirmButton: false,
                    timer: 1500
                });
			},
            complete: function() {
                $("#tbl-productos").html("");
				$('#total-pagar').text("0.00");
                habilitar_compra();
            }
        });
	});

  });