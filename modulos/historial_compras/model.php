<?php
session_start();
require_once "../database.php";

if (isset($_POST['transaction_id'])) {
    $id_transaccion = $_POST['transaction_id'];
    
    $query_transaction_data = "SELECT t.id_transaccion, DATE_FORMAT(t.fecha_compra, '%a. %d de %b. de %Y a las %r') AS fecha_compra, p.nombre_proveedor, u.nombre_usuario, t.total_compra, t.descripcion_compra FROM transaccion_compras t INNER JOIN compras c ON t.id_transaccion = c.id_transaccion INNER JOIN proveedores p ON t.id_proveedor = p.id_proveedor INNER JOIN usuarios u ON t.id_usuario = u.id_usuario WHERE t.id_transaccion = $id_transaccion";
    $transaction_data = mysqli_query($conn, $query_transaction_data);
    $row = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

    $query_products_data = "SELECT a.nombre_producto, c.cantidad_producto, c.precio_compra FROM compras c INNER JOIN almacen a ON c.id_producto = a.id_producto WHERE id_transaccion = $id_transaccion ORDER BY a.nombre_producto ASC";
    $products_data = mysqli_query($conn, $query_products_data);
    $row_products = mysqli_fetch_all($products_data, MYSQLI_ASSOC);
    
    // Combinar los resultados en un solo arreglo
    $result = array("transaccion_data" => $row, "productos_data" => $row_products);

    // Codificar como JSON
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['delete_id'])) {
    $transaccion_id = $_POST['delete_id'];
    
    $query_transaction_delete = "DELETE FROM transaccion_compras WHERE id_transaccion = $transaccion_id";
    $result_transaction_delete = mysqli_query($conn, $query_transaction_delete);    
        
    if ($result_transaction_delete) echo "Registro eliminado con exito";
}

mysqli_close($conn);
?>