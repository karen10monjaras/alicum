<?php
require_once "../database.php";

$query_get_transactions = "SELECT t.*, u.nombre_usuario, p.nombre_proveedor FROM transaccion_compras t INNER JOIN usuarios u ON t.id_usuario = u.id_usuario INNER JOIN proveedores p ON t.id_proveedor = p.id_proveedor";
$transaction_data = mysqli_query($conn, $query_get_transactions);

$data = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>