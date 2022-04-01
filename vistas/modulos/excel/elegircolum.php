<div class="box box-success">

	<div class="box-header with-border">

		<h3 class="box-title">ELEGIR COLUMNAS</h3>

	    <div class="box-tools pull-right">

     		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

	        	<i class="fa fa-minus"></i>

	       	</button>

	    </div>

	</div>


 	<div class="box-body" id="datosfila1">

		<form role="form" method="post" onsubmit="return registroTabla()">

		  <div class="form-group">

				<h4><b>Nombre de tabla: </b></h4>

				<input type="text" name="nombreTabla" id="nombreTabla" class="form-control input-lg" placeholder="nombre de la tabla (sin espacios. ejem: tabla_1)">

		  </div>

			<?php

						$columnas = ControladorCabecera::ctrMostrarCabecera();

						if ($columnas) {

								foreach ($columnas as $key => $value) {

									echo '<div class="form-group row">

									      <div class="col-xs-8">

														<div class="input-group">

															<input type="text" class="form-control input-lg" name="campo" id="campo" value="'.$value["descripcion"].'">

															<input type="hidden" class="form-control input-lg" name="codigo" value="'.$value["codigo"].'">

														</div>

													</div>

													<div class="col-xs-2 ColumnaCheck">';

											if ($value["checked"] == 1) {

												echo '<input type="checkbox" class="seleccionarColumna" nombre="'.$value["descripcion"].'" colum="'.$value["columna"].'" valorExc="'.$value["columna"].'" checked>';

											}else {

												echo '<input type="checkbox" class="seleccionarColumna" nombre="'.$value["descripcion"].'" colum="'.$value["columna"].'" valorExc="">';

											}

											echo	'</div>

												</div>';

								}


						}


			 ?>

			 <input type="text" id="valorExcel" name ="valorExcel">

 	</div>

 	<div class="box-footer">

    	<button type="submit" class="btn btn-primary pull-right">Guardar</button>

	</div>

	<?php

		$crearTabla = new ControladorTablaExcel();
		$crearTabla -> ctrCrearTablaExcel();

	?>

</form>

</div>
