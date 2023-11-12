<?php
require_once "../database.php";

$query_get_transactions = "SELECT t.id_transaccion, DATE_FORMAT(t.fecha_compra, '%a. %d de %b. de %Y a las %r') AS fecha_compra, u.nombre_usuario, p.nombre_proveedor, t.total_compra FROM transaccion_compras t INNER JOIN usuarios u ON t.id_usuario = u.id_usuario INNER JOIN proveedores p ON t.id_proveedor = p.id_proveedor";
$transaction_data = mysqli_query($conn, $query_get_transactions);

$data = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>