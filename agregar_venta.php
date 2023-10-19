<?php

include "conexion.php";

$id_producto = $_POST['id_producto'];
$fecha_venta = $_POST['fecha_venta'];
$cantidad_venta = $_POST['cantidad_venta'];

$sql = "INSERT INTO ventas(id_venta, id_producto, fecha_venta, cantidad_venta) VALUES(null, '$id_producto', '$fecha_venta', '$cantidad_venta')";

$result = mysqli_query($conexion, $sql);
$result = true;

if ($result) {
    echo "Datos almacenados";
} else {
    echo "Se produjo un error" . " " . $id_producto . " " . $fecha_venta . " " . $cantidad_venta;
}

mysqli_close($conexion);

?>
