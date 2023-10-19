<?php

include "conexion.php";

$sql = "SELECT * FROM proveedores";

if (!$conexion->query($sql)) {
    echo "Error, intentelo de nuevo!";
} else {
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $return_arr['datos_proveedores'] = array(); // Arreglo de libros
        while ($row = $result->fetch_array()) {
            array_push($return_arr['datos_proveedores'], array("id" => $row['id_proveedor'], "name" => $row['nombre_proveedor']));
        }
        echo json_encode($return_arr);
    }
}

?>