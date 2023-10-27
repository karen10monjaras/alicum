<?php

require "conexion.php";

$id = $_POST['id'];
$id_producto = $_POST['id_producto'];
$fecha_venta = $_POST['fecha_venta'];
$cantidad_venta = $_POST['cantidad_venta'];

$sql = "UPDATE ventas SET id_producto = $id_producto, fecha_venta = '$fecha_venta', cantidad_venta = $cantidad_venta WHERE id_venta = $id";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "Datos actualizados";
} else {
    echo "Error, Intentelo mas tarde";
}

mysqli_close($conexion);

?>