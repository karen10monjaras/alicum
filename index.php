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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon icon -->
    <!-- <link rel="icon" href="assets/images/favicon.svg" type="image/x-icon"> -->
    <!-- font css -->
    <link rel="stylesheet" href="assets/fonts/feather.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome.css">
    <link rel="stylesheet" href="assets/fonts/material.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/js/plugins/fontawesome-free/css/all.min.css">
    <!-- vendor css -->
    <link rel="stylesheet" href="assets/css/style.css" id="main-style-link">
	<!-- Styles for DataTables -->
	<link rel="stylesheet" href="assets/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/js/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="assets/js/plugins/sweetalert2/sweetalert2.min.css">
	
	<!-- Required Js -->
	<script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/js/plugins/feather.min.js"></script>
	<script src="assets/js/pcoded.min.js"></script>
	<!-- jquery js -->
	<script src="assets/js/plugins/jquery/jquery.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="assets/js/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<script src="assets/js/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
	<script src="assets/js/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
	<script src="assets/js/plugins/jszip/jszip.min.js"></script>
	<script src="assets/js/plugins/pdfmake/pdfmake.min.js"></script>
	<script src="assets/js/plugins/pdfmake/vfs_fonts.js"></script>
	<script src="assets/js/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
	<script src="assets/js/plugins/datatables-buttons/js/buttons.print.min.js"></script>
	<script src="assets/js/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
	<!-- Toast (SweetAlert2) -->
	<script src="assets/js/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- Bootstrap CSS -->
	<script src="assets/js/plugins/bootstrap.min.js"></script>

	<style>
		#suggestions {
		box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
		height: auto;
		position: absolute;
		top: 110px;
		z-index: 9999;
		width: auto;
		max-height: 250px;
		overflow-y: auto;
		}
		
		#suggestions .suggest-element {
		background-color: #EEEEEE;
		border-top: 1px solid #d6d4d4;
		cursor: pointer;
		padding: 8px;
		width: 100%;
		float: left;
		}
	</style>
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
			<img src="assets/images/logoAlicum.jpg" alt="" class="logo logo-lg">
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

</body>
</html>
