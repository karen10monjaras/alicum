<?php

include "conexion.php";

$id = $_POST['id'];

$sql = "DELETE FROM productos WHERE id_producto = '$id'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "Producto eliminado";
} else {
    echo "Error, intentelo nuevamente";
}

mysqli_close($conexion);

?>