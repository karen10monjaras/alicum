<?php
require_once "../database.php";

$query_get_transactions = "SELECT t.id_transaccion, DATE_FORMAT(t.fecha_venta, '%a. %d de %b. de %Y a las %r') AS fecha_venta, u.nombre_usuario, c.nombre_cliente, t.total_venta FROM transaccion_ventas t INNER JOIN usuarios u ON t.id_usuario = u.id_usuario INNER JOIN clientes c ON t.id_cliente = c.id_cliente ORDER BY t.id_transaccion DESC";
$transaction_data = mysqli_query($conn, $query_get_transactions);

$data = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>