<?php

include "conexion.php";

$sql = "SELECT * FROM productos";

if (!$conexion->query($sql)) {
    echo "Error, intentelo de nuevo!";
} else {
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $return_arr['datos_productos'] = array(); // Arreglo de libros
        while ($row = $result->fetch_array()) {
            array_push($return_arr['datos_productos'], array("id" => $row['id_producto'], "nombre" => $row['nombre_producto'], "vol" => $row['volumen'], "precio" => $row['precio']));
        }
        echo json_encode($return_arr);
    }
}

?>
