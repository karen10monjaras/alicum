$(document).ready(function() {
    id_productos = [];

    function habilitar_venta() {
        var existingRows = $('#tbl-productos tr');
        if (existingRows.length > 0) {
            $("#tbl-header").removeAttr("hidden");
	        $("#btn-sell").removeAttr("disabled");
            $("#btn-sell").fadeIn(500);

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
        url: "modulos/inicio/search.php",
        data: dataString,
        success: function(response) {
          $('#suggestions').fadeIn(100).html(response);
          $('.suggest-element').on('click', function(){
            var id = $(this).attr('id');
            var precio = $(this).attr('precio');
            var producto = $(this).text();
  
			var existingRow = $('#tbl-productos tr[data-id="' + id + '"]');
            if (existingRow.length > 0) {
                var cantidadInput = existingRow.find('input[type="number"]');
                var cantidad = parseInt(cantidadInput.val());
                cantidadInput.val(cantidad + 1);
            } else {
                template = `
                <tr data-id="${id}">
                    <td>8923716472</td>
                    <td>${producto}</td>
                    <td>$ ${precio}</td>
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
				$('#tbl-productos').append(template);
            }
            id_productos.push(id);

            habilitar_venta();
			calcularTotal();
            
            $('#suggestions').fadeOut(100);
            $("#key").val("");
            return false;
        });
        }
      });
    });

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

        habilitar_venta();
        calcularTotal();
    });

    function calcularTotal() {
        var total = 0;
        $('#tbl-productos tr').each(function () {
            var cantidad = parseInt($(this).find('input[type="number"]').val());
            var precio = parseFloat($(this).find('td:eq(2)').text().replace('$', ''));
            var subtotal = cantidad * precio;
            total += subtotal;
        });

		total = total.toFixed(2);
        $('#total-pagar').text(total);
		
		return total;
    }

	$("#btn-sell").click(function() {
		var total  = calcularTotal();
        var dataToSend = [];

        $('#tbl-productos tr').each(function () {
            var id = $(this).data('id');
            var cantidad = parseInt($(this).find('input[type="number"]').val());
            dataToSend.push({ id: id, cantidad: cantidad });
        });

		// Agrega el total al objeto JSON
		dataToSend.push({ total: total });

        // Enviar los datos al servidor como un objeto JSON
        $.ajax({
            type: "POST",
            url: "modulos/inicio/model.php",
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
                $("#tbl-productos").html("");
				$('#total-pagar').text("0.00");
                habilitar_venta();
            }
        });
	});

  });