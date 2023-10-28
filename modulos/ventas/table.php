<?php
require_once "../database.php";

$query_get_transactions = "SELECT t.*, u.nombre_usuario, c.nombre_cliente FROM transaccion_ventas t INNER JOIN usuarios u ON t.id_usuario = u.id_usuario INNER JOIN clientes c ON t.id_cliente = c.id_cliente";
$data_users = mysqli_query($conn, $query_get_transactions);

$data = mysqli_fetch_all($data_users, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>