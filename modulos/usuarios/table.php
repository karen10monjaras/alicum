<?php
require_once "../database.php";

$query_get_users = "SELECT id_usuario, nombre, nombre_usuario FROM usuarios";
$users_data = mysqli_query($conn, $query_get_users);

$data = mysqli_fetch_all($users_data, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);

mysqli_close($conn);
?>