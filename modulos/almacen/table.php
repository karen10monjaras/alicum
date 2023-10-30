<?php
require_once "../database.php";

$query_get_productos = "SELECT * FROM almacen";
$productos_data = mysqli_query($conn, $query_get_productos);

$data = mysqli_fetch_all($productos_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>