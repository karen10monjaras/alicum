<?php
session_start();
require_once "../database.php";

if (isset($_POST['action'])) {
    if ($_POST['action'] == "insertar") {
        $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $contrasenia_segura = sha1($contrasenia);

        $query_user_insert = "INSERT INTO usuarios(id_usuario, nombre, nombre_usuario, contrasenia) VALUES(NULL, '$nombre', '$nombre_usuario', '$contrasenia_segura')";
        $result_user_insert = mysqli_query($conn, $query_user_insert);  

        if ($result_user_insert) echo "Registro exitoso";
    }
    if ($_POST['action'] == "actualizar") {
        $id_usuario = htmlspecialchars(trim($_POST['id_usuario']), ENT_QUOTES, 'UTF-8');
        $nombre = htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $contrasenia_segura = sha1($contrasenia);

        $query_user_update = "UPDATE usuarios SET nombre = '$nombre', nombre_usuario = '$nombre_usuario' WHERE id_usuario = $id_usuario";
        
        if ($contrasenia != "") {
            $query_user_update = "UPDATE usuarios SET nombre = '$nombre', nombre_usuario = '$nombre_usuario', contrasenia = '$contrasenia_segura' WHERE id_usuario = $id_usuario";
        }
        
        $result_user_update = mysqli_query($conn, $query_user_update);  

        if ($result_user_update) echo "Actualización exitosa";
    }
}

if (isset($_POST['edit_id'])) {
    $id_usuario = $_POST['edit_id'];
    
    $query_user_data = "SELECT id_usuario, nombre, nombre_usuario FROM usuarios WHERE id_usuario = $id_usuario";
    $user_data = mysqli_query($conn, $query_user_data);
    $row = mysqli_fetch_all($user_data, MYSQLI_ASSOC);

    echo json_encode($row, JSON_UNESCAPED_UNICODE);
}

if (isset($_POST['delete_id'])) {
    $user_id = $_POST['delete_id'];
    
    $query_user_delete = "DELETE FROM usuarios WHERE id_usuario = $user_id";
    $result_user_delete = mysqli_query($conn, $query_user_delete);    
        
    if ($result_user_delete) echo "Usuario eliminado";
}

mysqli_close($conn);
?>