<?php

$ventas = '';
$historial_ventas = '';
$compras = '';
$historial_compras = '';
$almacen = '';
$formulas = '';
$clientes = '';
$proveedores = '';
$usuarios = '';

if (!empty($_GET) && isset($_GET['modulo'])) {
    switch($_GET['modulo']){
      case 'ventas':
        $ventas = 'active'; break;
      case 'historial_ventas':
        $historial_ventas = 'active'; break;
      case 'compras':
        $compras = 'active'; break;
	  case 'historial_compras':
        $historial_compras = 'active'; break;
      case 'almacen':
        $almacen = 'active'; break;
	  case 'formulas':
        $formulas = 'active'; break;
      case 'clientes':
        $clientes = 'active'; break;
	  case 'proveedores':
        $proveedores = 'active'; break;
	  case 'usuarios':
        $usuarios = 'active'; break;
    }
}

echo "
<div class='navbar-content'>
	<ul class='pc-navbar'>
    	<li class='pc-item $ventas'>
			<a href='?modulo=ventas' class='pc-link'><span class='pc-micon'><i class='fa fas fa-dollar-sign'></i></span><span class='pc-mtext'>Generar venta</span></a>
		</li>
		<li class='pc-item $historial_ventas'>
			<a href='?modulo=historial_ventas' class='pc-link'><span class='pc-micon'><i class='fa fas fa-history'></i></span><span class='pc-mtext'>Historial ventas</span></a>
		</li>
		<li class='pc-item $compras'>
			<a href='?modulo=compras' class='pc-link'><span class='pc-micon'><i class='fa fas fa-shopping-bag'></i></span><span class='pc-mtext'>Compras</span></a>
		</li>
		<li class='pc-item $historial_compras'>
			<a href='?modulo=historial_compras' class='pc-link'><span class='pc-micon'><i class='fa fas fa-history'></i></span><span class='pc-mtext'>Historial compras</span></a>
		</li>
		<li class='pc-item $almacen'>
			<a href='?modulo=almacen' class='pc-link'><span class='pc-micon'><i class='fa fas fa-warehouse'></i></span><span class='pc-mtext'>Almacén primario</span></a>
		</li>
		<li class='pc-item $formulas'>
			<a href='?modulo=formulas' class='pc-link'><span class='pc-micon'><i class='fa fas fa-pencil-ruler'></i></span><span class='pc-mtext'>Fórmulas alimento</span></a>
		</li>
    	<li class='pc-item $clientes'>
			<a href='?modulo=clientes' class='pc-link'><span class='pc-micon'><i class='fa fas fa-address-book'></i></span><span class='pc-mtext'>Clientes</span></a>
		</li>
    	<li class='pc-item $proveedores'>
			<a href='?modulo=proveedores' class='pc-link'><span class='pc-micon'><i class='fa fas fa-truck'></i></span><span class='pc-mtext'>Proveedores</span></a>
		</li>
    	<li class='pc-item $usuarios'>
			<a href='?modulo=usuarios' class='pc-link'><span class='pc-micon'><i class='fa fas fa-users'></i></span><span class='pc-mtext'>Usuarios</span></a>
		</li>
	</ul>
</div>";

?>