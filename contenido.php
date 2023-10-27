<?php
$modules = [
    "inicio" => "modulos/inicio/view.php",
    "ventas" => "modulos/ventas/view.php",
    "compras" => "modulos/compras/view.php",
    "almacen" => "modulos/almacen/view.php",
    "clientes" => "modulos/clientes/view.php",
    "proveedores" => "modulos/proveedores/view.php",
    "usuarios" => "modulos/usuarios/view.php"
];

if (empty($_GET) || !isset($_GET['modulo'])) {
    $module = "inicio";
} else { 
    $module = $_GET['modulo'];
}

if (array_key_exists($module, $modules)) {
    $load_page = $modules[$module];
    include_once "$load_page";
} else {
    include_once "error.php";
}
?>