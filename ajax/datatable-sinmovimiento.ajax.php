<?php

require_once "../controladores/movimientosimp.controlador.php";
require_once "../modelos/movimientosimp.modelo.php";


class TablaSinMovimientos{

  /*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS SIN VENTAS
    =============================================*/
  public function mostrarTablaSinMovimientos(){

      $valor = null;
      $sinMov = ControladorMovimientosImp::ctrMostrarSinMovimientos($valor);

      // var_dump($sinMov);

      if(count($sinMov) == 0){

        echo '{"data": []}';

        return;

      }


      $datosJson = '{
		  "data": [';


		  for($i = 0; $i < count($sinMov); $i++){

        /*=============================================
 	 		    ESCAPE DE CARACTERES ESPECIALES JSON
  			=============================================*/
         $descrip = json_encode($sinMov[$i]["descripcion"], JSON_HEX_APOS);

         /*=============================================
           PONEMOS COLOR ROJO A LAS VENTAS
         =============================================*/
          $estado = "<span class='label label-danger'>".$sinMov[$i]["ventas"]."</span>";

		  	/*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

		  	// $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$movImp[$i]["id"]."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pencil'></i></button></div>";

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$sinMov[$i]["ID_prod"].'",
            '. $descrip.',
            "'.$estado.'"
			    ],';

		  }

     $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   ']

		 }';

		echo $datosJson;

  }

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS SIN MOVIMIENTO
=============================================*/
$activarTablaSinMovimientos = new TablaSinMovimientos();
$activarTablaSinMovimientos -> mostrarTablaSinMovimientos();
