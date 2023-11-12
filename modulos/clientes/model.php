<?php
session_start();
require_once "../database.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "insertar") {
        $nombre_cliente = htmlspecialchars(trim($_POST['nombre_cliente']), ENT_QUOTES, 'UTF-8');
        $telefono_cliente = htmlspecialchars(trim($_POST['telefono_cliente']), ENT_QUOTES, 'UTF-8');
        $domicilio_cliente = htmlspecialchars(trim($_POST['domicilio_cliente']), ENT_QUOTES, 'UTF-8');

        $query_cliente_insert = "INSERT INTO clientes(id_cliente, nombre_cliente, telefono_cliente, domicilio_cliente) VALUES(NULL, '$nombre_cliente', '$telefono_cliente', '$domicilio_cliente')";
        $result_cliente_insert = mysqli_query($conn, $query_cliente_insert);  

        if ($result_cliente_insert) echo "Registro exitoso";
    }
    if ($_POST['action'] == "actualizar") {
        $id_cliente = htmlspecialchars(trim($_POST['id_cliente']), ENT_QUOTES, 'UTF-8');
        $nombre_cliente = htmlspecialchars(trim($_POST['nombre_cliente']), ENT_QUOTES, 'UTF-8');
        $telefono_cliente = htmlspecialchars(trim($_POST['telefono_cliente']), ENT_QUOTES, 'UTF-8');
        $domicilio_cliente = htmlspecialchars(trim($_POST['domicilio_cliente']), ENT_QUOTES, 'UTF-8');

        $query_clientes_update = "UPDATE clientes SET nombre_cliente = '$nombre_cliente', telefono_cliente = '$telefono_cliente', domicilio_cliente = '$domicilio_cliente' WHERE id_cliente = $id_cliente";        
        $result_clientes_update = mysqli_query($conn, $query_clientes_update);  

        if ($result_proveedores_update) echo "Actualización exitosa";
    }
}

if (isset($_POST['edit_id'])) {
    $id_cliente = $_POST['edit_id'];
    
    $query_cliente_data = "SELECT * FROM clientes WHERE id_cliente = $id_cliente";
    $clientes_data = mysqli_query($conn, $query_cliente_data);
    $row = mysqli_fetch_all($clientes_data, MYSQLI_ASSOC);

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['delete_id'])) {
    $id_cliente = $_POST['delete_id'];
    
    $query_cliente_delete = "DELETE FROM clientes WHERE id_cliente = $id_cliente";
    $result_cliente_delete = mysqli_query($conn, $query_cliente_delete);    
        
    if ($result_cliente_delete) echo "Cliente eliminado";
}

mysqli_close($conn);
?>