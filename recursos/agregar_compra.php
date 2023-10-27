<?php

include "conexion.php";

$id_producto = $_POST['id_producto'];
$fecha_compra = $_POST['fecha_compra'];
$metodo_pago = $_POST['metodo_pago'];

$sql = "INSERT INTO compras(id_compra, id_producto, fecha_compra, metodo_pago) VALUES(null, '$id_producto', '$fecha_compra', '$metodo_pago')";

$result = mysqli_query($conexion, $sql);
$result = true;

if ($result) {
    echo "Datos almacenados";
} else {
    echo "Se produjo un error" . " " . $id_producto . " " . $fecha_compra . " " . $metodo_pago;
}

mysqli_close($conexion);

?>
