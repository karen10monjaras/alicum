<?php
session_start();
require_once "modulos/database.php";

$user = mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['usuario'])))));
$pass = sha1(mysqli_real_escape_string($conn, stripslashes(strip_tags(htmlspecialchars(trim($_POST['contrasenia']))))));

$query_user_consult = "SELECT id_usuario, nombre, nombre_usuario FROM usuarios WHERE nombre_usuario = '$user' AND contrasenia = '$pass'";
$result_user_consult = mysqli_query($conn, $query_user_consult) or die('Error');
$rows = mysqli_num_rows($result_user_consult);

mysqli_close($conn);

$err_msg = "Usuario y/o contraseña incorrectos";
if ($rows > 0) {
    $row  = mysqli_fetch_assoc($result_user_consult);

	$_SESSION['id_usuario'] = $row['id_usuario'];
	$_SESSION['nombre'] = $row['nombre'];
	$_SESSION['nombre_usuario'] = $row['nombre_usuario'];
		
	header("Location: index.php?modulo=ventas");
} else {
	$_SESSION['err'] = ["err_msg" => $err_msg];
	header("Location: login.php");
}
?>