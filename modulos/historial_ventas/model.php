<?php
session_start();
require_once "../database.php";

if (isset($_POST['transaction_id'])) {
    $id_transaccion = $_POST['transaction_id'];
    
    $query_transaction_data = "SELECT t.id_transaccion, DATE_FORMAT(t.fecha_venta, '%a. %d de %b. de %Y a las %r') AS fecha_venta, c.nombre_cliente, u.nombre_usuario, t.total_venta, t.descripcion_venta FROM transaccion_ventas t INNER JOIN ventas v ON t.id_transaccion = v.id_transaccion INNER JOIN clientes c ON t.id_cliente = c.id_cliente INNER JOIN usuarios u ON t.id_usuario = u.id_usuario WHERE t.id_transaccion = $id_transaccion";
    $transaction_data = mysqli_query($conn, $query_transaction_data);
    $row = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

    $query_products_data = "SELECT a.nombre_producto, v.cantidad_producto, v.precio_venta FROM ventas v INNER JOIN almacen a ON v.id_producto = a.id_producto WHERE id_transaccion = $id_transaccion ORDER BY a.nombre_producto ASC";
    $products_data = mysqli_query($conn, $query_products_data);
    $row_products = mysqli_fetch_all($products_data, MYSQLI_ASSOC);
    
    // Combinar los resultados en un solo arreglo
    $result = array("transaccion_data" => $row, "productos_data" => $row_products);

    // Codificar como JSON
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['delete_id'])) {
    $transaccion_id = $_POST['delete_id'];
    
    $query_transaction_delete = "DELETE FROM transaccion_ventas WHERE id_transaccion = $transaccion_id";
    $result_transaction_delete = mysqli_query($conn, $query_transaction_delete);    
        
    if ($result_transaction_delete) echo "Registro eliminado con exito";
}

mysqli_close($conn);
?>