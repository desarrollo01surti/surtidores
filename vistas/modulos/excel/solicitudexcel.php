<div class="box box-success">

	<div class="box-header with-border">

		<h3 class="box-title">EXCEL IMPORTADO</h3>

	    <div class="box-tools pull-right">

     		<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

	        	<i class="fa fa-minus"></i>

	       	</button>

	    </div>

	</div>


 	<div class="box-body">

		<div class="form-group">

      <form method="post" id="cargar_excel_form" enctype="multipart/form-data">

						<?php

						$item = null;
						$valor = null;

						$codigo = ControladorCabecera::ctrMostrarRuta($item, $valor);

						if(!$codigo){

							echo '<input type="hidden" class="form-control" id="nuevoCodigo" name="nuevoCodigo" value="10001" readonly>';


						}else{

							foreach ($codigo as $key => $value) {

							}

							$codigo = $value["codigo"] + 1;

							echo '<input type="hidden" class="form-control" id="nuevoCodigo" name="nuevoCodigo" value="'.$codigo.'" readonly>';

						}

						?>

           <label class="col-lg-2 control-label">Archivo (.xlsx)*</label><br>
           <input type="file" name="archivo" class="form-control excelarch" id="archivo" placeholder="Archivo (.xlsx)" accept=".csv,.xlsx,.xls" width="40%">

           <br><br>
           <label class="control-label">Rango de Columnas:</label><br>
           <input type="text" class="form-control" name="rangoColumnas" placeholder="ejemplo: (A-B)" required>

           <br><br>

           <label class="control-label">Rango de Filas:</label>
           <input type="text" class="form-control" name="rangoFilas" placeholder="ejemplo: (1-5)" required>

           <br><br>

           <!--<button type="submit" class="btn btn-primary">Cargar Excel</button>-->

           <button type="submit" class="btn btn-warning btnElegirColumnas" data-toggle="modal" data-target="#modalElegirColumnas"><i class="fa fa-pencil"></i> Elegir Columnas</button>

      </form>

		</div>

 	</div>

 	<div class="box-footer">

    	<!-- <button type="button" id="guardarRedesSociales" class="btn btn-primary pull-right">Guardar</button> -->

	</div>

</div>
