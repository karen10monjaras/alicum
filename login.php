<?php 
session_start(); 

if (isset($_SESSION['id_usuario'])) {
    header("Location: index.php?modulo=ventas");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Inicio Sesión ALICUM</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />

	<!-- Favicon icon -->
	<link rel="icon" href="assets/images/favicon.svg" type="image/x-icon">

	<!-- font css -->
	<link rel="stylesheet" href="assets/fonts/feather.css">
	<link rel="stylesheet" href="assets/fonts/fontawesome.css">
	<link rel="stylesheet" href="assets/fonts/material.css">

	<!-- vendor css -->
	<link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
</head>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content">
		<div class="card">
			<div class="row align-items-center text-center">
				<div class="col-md-12">
					<div class="card-body">
						<form action="validar_login.php" method="POST">
							<h4 class="mb-3 f-w-400">Iniciar sesión</h4>
						<img src="assets/images/logoAlicum.jpg" alt="" class="img-fluid mb-4">
						<div class="input-group mb-3">
							<span class="input-group-text"><i data-feather="user"></i></span>
							<input type="text" class="form-control" name="usuario" placeholder="Usuario">
						</div>
						<div class="input-group mb-4">
							<span class="input-group-text"><i data-feather="lock"></i></span>
							<input type="password" class="form-control" name="contrasenia" placeholder="Contraseña">
						</div>
						<?php 
						if (isset($_SESSION['err'])) {
							$err = $_SESSION['err']['err_msg'];
							echo "<p class='text-center text-danger'>$err</p>";
							unset($_SESSION['err']);
						}
						?>
						<div class="mb-4">
							<input type="submit" class="btn btn-success" value="Continuar">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/js/plugins/bootstrap.min.js"></script>
<script src="assets/js/plugins/feather.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>

</body>

</html>

