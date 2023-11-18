<?php
session_start();
require_once "../database.php";

if (isset($_POST['edit_id'])) {
    $id_transaccion = $_POST['edit_id'];

    $query_transaction_data = "SELECT t.*, f.* FROM transaccion_formulas t INNER JOIN formulas f ON t.id_transaccion = f.id_transaccion WHERE t.id_producto = $id_transaccion";
    $transaction_data = mysqli_query($conn, $query_transaction_data);
    $row = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

    foreach($row as $key => $value) {
        $id_producto = $value['id_producto'];

        $query_products_data = "SELECT nombre_producto, stock FROM almacen WHERE id_producto = $id_producto";
        $products_data = mysqli_query($conn, $query_products_data);
        $row_products = mysqli_fetch_all($products_data, MYSQLI_ASSOC);

        $row[$key]["extra"] = $row_products;
    }

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['preparar_alimento'])) {
    $data = json_decode($_POST['productos'], true);

    $cantidad_generada = $data[count($data) - 1]['cantidad_generada'];
    $id_producto = $data[count($data) - 2]['id_producto'];

    // Se hace la actualizacion del stock
    $query_update_stock = "UPDATE almacen SET stock = stock + $cantidad_generada WHERE id_producto = $id_producto";                
    $result_update_stock = mysqli_query($conn, $query_update_stock);
    
    $limite = count($data) - 2; // Cantidad de productos menos los datos de proveedor y total
    
    // Itera sobre los datos y actualiza la base de datos
    for ($i = 0; $i < $limite; $i++) {
        $id = $data[$i]['id'];
        $cantidad = $data[$i]['cantidad'];

        // Realiza la consulta SQL para actualizar la cantidad de insumos restantes
        $query_update_products = "UPDATE almacen SET stock = $cantidad WHERE id_producto = $id";
        $result_update_products = mysqli_query($conn, $query_update_products);       
    }

    // Verifica si las actualizaciones fueron exitosas
    if ($result_update_products) echo "Insumos registrados!";
}

if (isset($_POST['guardar_formula'])) {
    $data = json_decode($_POST['productos'], true); // Recibe los datos JSON del frontend

    $id_producto = $data[count($data) - 1]['id_producto'];

    $query_get_transaction = "SELECT id_transaccion FROM transaccion_formulas WHERE id_producto = $id_producto";
    $result_get_transaction = mysqli_query($conn, $query_get_transaction);
    $rows = mysqli_num_rows($result_get_transaction);

    if ($rows > 0) {
        $row = mysqli_fetch_assoc($result_get_transaction);
        $id_transaccion = $row['id_transaccion'];

        $query_delete_products = "DELETE FROM transaccion_formulas WHERE id_transaccion = $id_transaccion";
        $result_delete_transaction = mysqli_query($conn, $query_delete_products);
    }

    mysqli_begin_transaction($conn);

    try {
        $id_producto = $data[count($data) - 1]['id_producto'];

        // Se hace el insert en la tabla transaccion
        $query_insert_transaction = "INSERT INTO transaccion_formulas(id_transaccion, id_producto) VALUES (NULL, $id_producto)";
        $result_insert_transaction = mysqli_query($conn, $query_insert_transaction);

        // Se obtiene el id de la ultima transaccion
        $id_transaccion = mysqli_insert_id($conn);

        $limite = count($data) -  1; // Cantidad de productos menos el id de producto (tipo de alimento)

        // Itera sobre los datos y actualiza la base de datos
        for ($i = 0; $i < $limite; $i++) {
            $id = $data[$i]['id'];
            $cantidad = $data[$i]['cantidad'];

            $query_insert_formula = "INSERT INTO formulas(id_formula, id_transaccion, id_producto, cantidad_producto) VALUES (NULL, $id_transaccion, $id, $cantidad)";
            $result_insert_formula = mysqli_query($conn, $query_insert_formula);
        }

        // Verifica si las inserciones fueron exitosas
        if ($result_insert_formula) echo "Transacción exitosa!";

        // Confirmar transacción
        mysqli_commit($conn);
    } catch (Exception $e) {
        // Ocurrió un error, realizar rollback
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }
}
