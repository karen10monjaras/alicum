<?php
session_start();
require_once "../database.php";

if (isset($_POST['clientes'])){
    $html = '';

    $query = "SELECT id_cliente, nombre_cliente FROM clientes";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_cliente = $row['id_cliente'];              
            $nombre_cliente = $row['nombre_cliente'];

            $html .= "
            <option value='$id_cliente'>$nombre_cliente</option>";
        }
    }

    echo $html;
    return;
}

// Recibe los datos JSON del frontend
$data = json_decode($_POST['productos'], true);

mysqli_begin_transaction($conn);

try {
    $id_cliente = $data[count($data) - 1]['cliente'];
    $id_usuario = $_SESSION['id_usuario'];
    $total_venta = $data[count($data) - 2]['total'];

    // Se hace el insert en la tabla transaccion
    $query_insert_transaction = "INSERT INTO transaccion_ventas(id_transaccion, id_cliente, id_usuario, total_venta) VALUES (NULL, $id_cliente, $id_usuario, $total_venta)";                
    $result_insert_transaction = mysqli_query($conn, $query_insert_transaction);

    // Se obtiene el id de la ultima transaccion
    $id_transaccion = mysqli_insert_id($conn);

    // Itera sobre los datos y actualiza la base de datos
    foreach ($data as $item) {
        $id = $item['id'];
        $cantidad = $item['cantidad'];

        // Realiza la consulta SQL para actualizar la cantidad vendida en la tabla correspondiente
        $query_update_stock = "UPDATE almacen SET stock = stock - $cantidad WHERE id_producto = $id";
        $result_update_stock = mysqli_query($conn, $query_update_stock);

        $query_insert_product = "INSERT INTO ventas(id_venta, id_transaccion, id_producto, cantidad_producto) VALUES (NULL, $id_transaccion, $id, $cantidad)";
        $result_insert_product = mysqli_query($conn, $query_insert_product);        
    }

    // Verifica si las inserciones fueron exitosas
    if ($result_insert_product) echo "Transaccion exitosa!";

    // Confirmar transacción
    mysqli_commit($conn);
    
} catch (Exception $e) {
    // Ocurrió un error, realizar rollback
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}
