<?php
session_start();
require_once "../database.php";

if (isset($_POST['proveedores'])){
    $html = '';

    $query = "SELECT id_proveedor, nombre_proveedor FROM proveedores";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_proveedor = $row['id_proveedor'];              
            $nombre_proveedor = $row['nombre_proveedor'];

            $html .= "
            <option value='$id_proveedor'>$nombre_proveedor</option>";
        }
    }

    echo $html;
    return;
}


// Recibe los datos JSON del frontend
$data = json_decode($_POST['productos'], true);

mysqli_begin_transaction($conn);

try {
    $id_proveedor = $data[count($data) - 1]['proveedor'];
    $id_usuario = $_SESSION['id_usuario'];
    $total_compra_insumo = $data[count($data) - 2]['total'];

    // Se hace el insert en la tabla transaccion
    $query_insert_transaction = "INSERT INTO transaccion_compras(id_transaccion, id_proveedor, id_usuario, total_compra) VALUES (NULL, $id_proveedor, $id_usuario, $total_compra_insumo)";                
    $result_insert_transaction = mysqli_query($conn, $query_insert_transaction);

    // Se obtiene el id de la ultima transaccion
    $id_transaccion = mysqli_insert_id($conn);

    $limite = count($data) - 2; // Cantidad de productos menos los datos de proveedor y total

    // Itera sobre los datos y actualiza la base de datos
    for ($i = 0; $i < $limite; $i++) {
        $id = $data[$i]['id'];
        $cantidad = $data[$i]['cantidad'];

        // Realiza la consulta SQL para actualizar la cantidad vendida en la tabla correspondiente
        $query_update_stock = "UPDATE almacen SET stock = stock + $cantidad WHERE id_producto = $id";
        $result_update_stock = mysqli_query($conn, $query_update_stock);

        $query_insert_compra = "INSERT INTO compras(id_compra, id_transaccion, id_producto, cantidad_producto) VALUES (NULL, $id_transaccion, $id, $cantidad)";
        $result_insert_compra = mysqli_query($conn, $query_insert_compra);        
    }

    // Verifica si las inserciones fueron exitosas
    if ($result_insert_compra) echo "Transaccion exitosa!";

    // Confirmar transacción
    mysqli_commit($conn);
    
} catch (Exception $e) {
    // Ocurrió un error, realizar rollback
    mysqli_rollback($conn);
    echo "Error: " . $e->getMessage();
}
