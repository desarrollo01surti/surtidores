	<?php

	// require_once "../controladores/producto.controlador.php";
	// require_once "../modelos/producto.modelo.php";

	// require_once "../controladores/precios.controlador.php";
	// require_once "../modelos/precios.modelo.php";

	if (isset($_REQUEST["action"])) {

	?>

		<tr>
			<td colspan='8'>
				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalProductos"><span class="glyphicon glyphicon-plus"></span> Agregar Producto</button>
			</td>
		</tr>

		<tr>
			<td colspan='6' class='text-right'>
				<h4>TOTAL USD<?php echo $data; ?></h4>
			</td>
			<th class='text-right'>
				<h4><?php echo number_format($suma, 2); ?></h4>
			</th>
			<td></td>
		</tr>

	<?php

	}
