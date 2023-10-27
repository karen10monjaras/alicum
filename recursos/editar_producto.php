<?php

require "conexion.php";

$id = $_POST['id'];
$nombre = $_POST['nombre_producto'];
$volumen = $_POST['volumen'];
$precio = $_POST['precio'];
$id_proveedor = $_POST['id_proveedor'];

$sql = "UPDATE productos SET nombre_producto = '$nombre', volumen = '$volumen', precio = '$precio', id_proveedor = '$id_proveedor' WHERE id_producto = '$id'";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "Datos actualizados";
} else {
    echo "Error, Intentelo mas tarde";
}

mysqli_close($conexion);

?>