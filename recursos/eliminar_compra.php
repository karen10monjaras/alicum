<?php

include "conexion.php";

$id = $_POST['id'];

$sql = "DELETE FROM compras WHERE id_compra = '$id'";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    echo "Compra eliminada";
} else {
    echo "Error, intentelo nuevamente";
}

mysqli_close($conexion);

?>