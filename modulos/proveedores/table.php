<?php
require_once "../database.php";

$query_get_proveedores = "SELECT * FROM proveedores";
$proveedores_data = mysqli_query($conn, $query_get_proveedores);

$data = mysqli_fetch_all($proveedores_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>