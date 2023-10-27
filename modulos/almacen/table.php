<?php
require_once "../database.php";

$query_get_users = "SELECT id_usuario, rol_usuario, usuario, nombre_usuario, telefono_usuario, correo_usuario, creacion_cuenta, estado_usuario FROM usuarios";
$data_users = mysqli_query($conn, $query_get_users);

$data = mysqli_fetch_all($data_users, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>