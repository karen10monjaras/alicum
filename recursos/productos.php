<?php

require_once "conexion.php";

$result = array();
$result['data'] = array();

$select = "SELECT * FROM productos AS p INNER JOIN proveedores AS pr ON p.id_proveedor = pr.id_proveedor";

$response = mysqli_query($conexion, $select);
while ($row = mysqli_fetch_array($response)) {
    $index['id_producto'] = $row['0'];
    $index['nombre_producto'] = $row['1'];
    $index['volumen'] = $row['2'];
    $index['precio'] = $row['3'];
    $index['proveedor'] = $row['6'];
    $index['correo'] = $row['7'];
    $index['telefono'] = $row['8'];
    array_push($result['data'], $index);
}

$result['success'] = "1";
echo json_encode($result);

mysqli_close($conexion);

?>
