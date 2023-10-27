<?php

require_once "conexion.php";

$result = array();
$result['data'] = array();

$select = "SELECT * FROM ventas AS v INNER JOIN productos AS p ON v.id_producto = p.id_producto";

$response = mysqli_query($conexion, $select);
while ($row = mysqli_fetch_array($response)) {
    $index['id_venta'] = $row['0'];
    $index['nombre_producto'] = $row['5'];
    $index['fecha_venta'] = $row['2'];
    $index['cantidad_venta'] = $row['3'];
    array_push($result['data'], $index);
}

$result['success'] = "1";
echo json_encode($result);

mysqli_close($conexion);

?>
