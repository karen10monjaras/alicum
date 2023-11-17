<?php
$modules = [
    "ventas" => "modulos/ventas/view.php",
    "historial_ventas" => "modulos/historial_ventas/view.php",
    "compras" => "modulos/compras/view.php",
    "historial_compras" => "modulos/historial_compras/view.php",
    "almacen" => "modulos/almacen/view.php",
    "formulas" => "modulos/formulas/view.php",
    "clientes" => "modulos/clientes/view.php",
    "proveedores" => "modulos/proveedores/view.php",
    "usuarios" => "modulos/usuarios/view.php"
];

if (empty($_GET) || !isset($_GET['modulo'])) {
    $module = "ventas";
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