 <?php
    $hostname='localhost';
    $username='root';
    $password='';
    $database='proyecto_android';

    $conexion = new mysqli($hostname, $username, $password, $database);
    
    if($conexion-> connect_errno){
        echo"El sitio web esta experimentado problemas";
    }
?>