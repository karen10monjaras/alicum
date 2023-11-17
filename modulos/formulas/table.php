<?php
require_once "../database.php";

$query_get_transactions = "SELECT t.*, a.nombre_producto FROM transaccion_formulas t INNER JOIN almacen a ON t.id_producto = a.id_producto ORDER BY t.id_transaccion DESC";
$transaction_data = mysqli_query($conn, $query_get_transactions);
    
$data = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);
    
echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>