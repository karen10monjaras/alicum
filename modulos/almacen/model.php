<?php
session_start();
require_once "../database.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "insertar") {
        $nombre_producto = htmlspecialchars(trim($_POST['nombre_producto']), ENT_QUOTES, 'UTF-8');
        $precio_producto = htmlspecialchars(trim($_POST['precio_producto']), ENT_QUOTES, 'UTF-8');

        $query_producto_insert = "INSERT INTO almacen(id_producto, nombre_producto, precio_producto, stock) VALUES(NULL, '$nombre_producto', $precio_producto, 0)";
        $result_producto_insert = mysqli_query($conn, $query_producto_insert);  

        if ($result_producto_insert) echo "Registro exitoso";
    }
    if ($_POST['action'] == "actualizar") {
        $id_producto = htmlspecialchars(trim($_POST['id_producto']), ENT_QUOTES, 'UTF-8');
        $nombre_producto = htmlspecialchars(trim($_POST['nombre_producto']), ENT_QUOTES, 'UTF-8');
        $precio_producto = htmlspecialchars(trim($_POST['precio_producto']), ENT_QUOTES, 'UTF-8');

        $query_producto_update = "UPDATE almacen SET nombre_producto = '$nombre_producto', precio_producto = $precio_producto WHERE id_producto = $id_producto";        
        $result_producto_update = mysqli_query($conn, $query_producto_update);  

        if ($result_producto_update) echo "Actualización exitosa";
    }
}

if (isset($_POST['edit_id'])) {
    $id_producto = $_POST['edit_id'];
    
    $query_producto_data = "SELECT * FROM almacen WHERE id_producto = $id_producto";
    $productos_data = mysqli_query($conn, $query_producto_data);
    $row = mysqli_fetch_all($productos_data, MYSQLI_ASSOC);

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['delete_id'])) {
    $id_producto = $_POST['delete_id'];
    
    $query_producto_delete = "DELETE FROM almacen WHERE id_producto = $id_producto";
    $result_producto_delete = mysqli_query($conn, $query_producto_delete);    
        
    if ($result_producto_delete) echo "Producto retirado de la tienda";
}

mysqli_close($conn);
?>