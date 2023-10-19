<?php

include "conexion.php";

$nombre_producto = $_POST['nombre_producto'];
$volumen = $_POST['volumen'];
$precio = $_POST['precio'];
$id_proveedor = $_POST['id_proveedor'];

$sql = "INSERT INTO productos(id_producto, nombre_producto, volumen, precio, id_proveedor) VALUES(null, '$nombre_producto', '$volumen', $precio, $id_proveedor)";

$result = mysqli_query($conexion, $sql);
$result = true;

if ($result) {
    echo "Datos almacenados";
} else {
    echo "Se produjo un error" . " " . $nombre_producto . " " . $volumen . " " . $precio . " " . $id_proveedor;
}

mysqli_close($conexion);

?>
