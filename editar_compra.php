<?php

require "conexion.php";

$id = $_POST['id'];
$id_producto = $_POST['id_producto'];
$fecha_compra = $_POST['fecha_compra'];
$metodo_pago = $_POST['metodo_pago'];

$sql = "UPDATE compras SET id_producto = '$id_producto', fecha_compra = '$fecha_compra', metodo_pago = '$metodo_pago' WHERE id_compra = '$id'";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "Datos actualizados";
} else {
    echo "Error, Intentelo mas tarde";
}

mysqli_close($conexion);

?>