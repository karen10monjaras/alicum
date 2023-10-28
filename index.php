<?php 
session_start(); 

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html>
<!-- <html lang="en"> -->

<head>
    <title>Alicum</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon">

    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/js/plugins/fontawesome-free/css/all.min.css">

    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
</head>

<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ Mobile header ] start -->
	<div class="pc-mob-header pc-header">
		<div class="pcm-logo">
			<img src="assets/images/logo.svg" alt="" class="logo logo-lg">
		</div>
		<div class="pcm-toolbar">
			<a href="#!" class="pc-head-link" id="mobile-collapse">
				<div class="hamburger hamburger--arrowturn">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
			</a>
			<a href="#!" class="pc-head-link" id="headerdrp-collapse">
				<i data-feather="align-right"></i>
			</a>
			<a href="#!" class="pc-head-link" id="header-collapse">
				<i data-feather="more-vertical"></i>
			</a>
		</div>
	</div>
	<!-- [ Mobile header ] End -->

	<!-- [ navigation menu ] start -->
	<nav class="pc-sidebar ">
		<div class="navbar-wrapper">
			<div class="m-header">
				<a href="#" class="b-brand">
					<!-- ========   change your logo hear   ============ -->
					<!-- <img src="assets/images/logo.svg" alt="" class="logo logo-lg"> -->
					<!-- <img src="assets/images/logo-sm.svg" alt="" class="logo logo-sm"> -->
                    <a href="#" class="brand-link">
                        <!-- <img src="assets/images/logo.svg" alt="Alicum Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                        <span class="brand-text font-weight-light h4 text-white">ALICUM</span>
                    </a>
				</a>
			</div>

    	    <!-- [ sidebar ] start -->
			<?php require_once "barra_lateral.php"; ?>
    	    <!-- [ sidebar ] end -->
		
        </div>
	</nav>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<header class="pc-header ">
		<div class="header-wrapper">
			<div class="ml-auto">
				<ul class="list-unstyled">
					<li class="dropdown pc-h-item">
						<a class="pc-head-link dropdown-toggle arrow-none mr-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="fa fas fa-lg fa-user p-2 border rounded mx-2"></span>
                            <span>
								<span class="user-name"><?php echo $_SESSION['nombre']; ?></span>
								<span class="user-desc">Administrator</span>
							</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right pc-h-dropdown">
							<a href="logout.php" class="dropdown-item">
								<i data-feather="log-out">chrome_reader_mode</i>
								<span>Cerrar sesión</span>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</header>
	<!-- [ Header ] end -->

<!-- [ Main Content ] start -->
<div class="pc-container">
    <div class="pcoded-content">
        <!-- [ Main Content ] start -->
        <div class="row">

            <!-- main-section start -->
            <?php require_once "contenido.php"; ?>
            <!-- main-section end -->
        
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- [ Main Content ] end -->

    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
    <script src="assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets/js/plugins/feather.min.js"></script>
    <script src="assets/js/pcoded.min.js"></script>
    <!-- <script src="assets/js/plugins/clipboard.min.js"></script> -->
    <!-- <script src="assets/js/uikit.min.js"></script> -->

<!-- Apex Chart -->
<!-- <script src="assets/js/plugins/apexcharts.min.js"></script> -->

<!-- custom-chart js -->
<!-- <script src="assets/js/pages/dashboard-sale.js"></script> -->

<!-- jquery js -->
<script src="assets/js/plugins/jquery/jquery.min.js"></script>

<script>
$(document).ready(function() {
    id_productos = [];
  
    $('#key').on('keyup', function() {
      var key = $(this).val();		
      var dataString = 'key='+key;
  
      $.ajax({
        type: "POST",
        url: "modulos/inicio/search.php",
        data: dataString,
        success: function(response) {
          $('#suggestions').fadeIn(1000).html(response);
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

			calcularTotal();
            $('#suggestions').fadeOut(1000);
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

	function enviarDatosAlServidor() {
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
                console.log(response)
				$("#tbl-productos").html("");
				$('#total-pagar').text("0.00");
			}
        });
    }

	$("#btn-sell").click(function() {
		enviarDatosAlServidor();
	});

  });
</script>

</body>
</html>
