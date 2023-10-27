<?php
include 'conexion.php';
$usu_usuario = $_POST['usuario'];
$usu_password = $_POST['password'];

$sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE nombre=? AND password=?");
$sentencia->bind_param('ss', $usu_usuario, $usu_password);
$sentencia->execute();

$resultado = $sentencia->get_result();
if ($fila = $resultado->fetch_assoc()){
    $respuesta = array("estado" => "success");
} else {
    $respuesta = array("estado" => "failure");
}

echo json_encode($respuesta);
$sentencia->close();
$conexion->close();