<?php
session_start();
require_once "../database.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "insertar") {
        $nombre_proveedor = htmlspecialchars(trim($_POST['nombre_proveedor']), ENT_QUOTES, 'UTF-8');
        $telefono_proveedor = htmlspecialchars(trim($_POST['telefono_proveedor']), ENT_QUOTES, 'UTF-8');
        $domicilio_proveedor = htmlspecialchars(trim($_POST['domicilio_proveedor']), ENT_QUOTES, 'UTF-8');

        $query_proveedor_insert = "INSERT INTO proveedores(id_proveedor, nombre_proveedor, telefono_proveedor, domicilio_proveedor) VALUES(NULL, '$nombre_proveedor', '$telefono_proveedor', '$domicilio_proveedor')";
        $result_proveedor_insert = mysqli_query($conn, $query_proveedor_insert);  

        if ($result_proveedor_insert) echo "Registro exitoso";
    }
    if ($_POST['action'] == "actualizar") {
        $id_proveedor = htmlspecialchars(trim($_POST['id_proveedor']), ENT_QUOTES, 'UTF-8');
        $nombre_proveedor = htmlspecialchars(trim($_POST['nombre_proveedor']), ENT_QUOTES, 'UTF-8');
        $telefono_proveedor = htmlspecialchars(trim($_POST['telefono_proveedor']), ENT_QUOTES, 'UTF-8');
        $domicilio_proveedor = htmlspecialchars(trim($_POST['domicilio_proveedor']), ENT_QUOTES, 'UTF-8');

        $query_proveedores_update = "UPDATE proveedores SET nombre_proveedor = '$nombre_proveedor', telefono_proveedor = '$telefono_proveedor', domicilio_proveedor = '$domicilio_proveedor' WHERE id_proveedor = $id_proveedor";        
        $result_proveedores_update = mysqli_query($conn, $query_proveedores_update);  

        if ($result_proveedores_update) echo "Actualización exitosa";
    }
}

if (isset($_POST['edit_id'])) {
    $id_proveedor = $_POST['edit_id'];
    
    $query_proveedor_data = "SELECT * FROM proveedores WHERE id_proveedor = $id_proveedor";
    $proveedores_data = mysqli_query($conn, $query_proveedor_data);
    $row = mysqli_fetch_all($proveedores_data, MYSQLI_ASSOC);

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['delete_id'])) {
    $id_proveedor = $_POST['delete_id'];
    
    $query_proveedor_delete = "DELETE FROM proveedores WHERE id_proveedor = $id_proveedor";
    $result_proveedor_delete = mysqli_query($conn, $query_proveedor_delete);    
        
    if ($result_proveedor_delete) echo "Proveedor eliminado";
}

mysqli_close($conn);
?>