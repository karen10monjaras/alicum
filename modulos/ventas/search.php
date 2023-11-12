<?php
require_once "../database.php";

$html = '';
$key = $_POST['key'];

if ($key == "") {
    return $html = "";
}

$query = "SELECT * FROM almacen WHERE nombre_producto LIKE  '%$key%' AND stock > 0";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id_producto = $row['id_producto'];              
        $nombre_producto = $row['nombre_producto'];
        $precio_producto = $row['precio_producto'];
        $stock = $row['stock'];

        $html .= "
        <div>
            <a class='suggest-element' id='$id_producto' stock='$stock' precio='$precio_producto'>$nombre_producto</a>
        </div>";
    }
}

echo $html;
?>