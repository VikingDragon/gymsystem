<?php
	use yii\helpers\Html;
?>
<div>
	<div class="menuAdmi">
		<?php
			echo Html::a("Empleados",["empleado/index"]);
			echo Html::a("Clientes",["cliente/index"]);
			echo Html::a("Membrecias",["membrecia/index"]);
			echo Html::a("Productos",["articulo/index"]);
			echo Html::a("Provedores",["provedor/index"]);
			echo Html::a("Compras",["inventario/index"]);
			echo Html::a("Ventas",["venta/venta"]);
			echo Html::a("Reportes",[""]);
		?>
	</div>
</div>

<style type="text/css">

	.menuAdmi{
		display: flex;
		flex-direction: row;
	    flex-wrap: wrap;
	    justify-content: space-around;
	}
	.menuAdmi > a{
		text-decoration: none;
		width: 10%;
	}

</style>