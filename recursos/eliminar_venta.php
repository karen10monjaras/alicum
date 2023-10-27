<?php

include "conexion.php";

$id = $_POST['id'];

$sql = "DELETE FROM ventas WHERE id_venta = '$id'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "Venta eliminada";
} else {
    echo "Error, intentelo nuevamente";
}

mysqli_close($conexion);

?>