<?php
require_once "../database.php";

$query_get_clientes = "SELECT * FROM clientes";
$clientes_data = mysqli_query($conn, $query_get_clientes);

$data = mysqli_fetch_all($clientes_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>