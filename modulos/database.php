<?php

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DBNAME", "sistema");

$conn = mysqli_connect(HOST, USER, PASS, DBNAME);

if (!$conn) {
    die('Error de conexion con la BD');
}

?>