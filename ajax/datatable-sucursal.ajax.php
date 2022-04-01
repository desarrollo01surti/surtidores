<?php

require_once "../controladores/sucursal.controlador.php";
require_once "../modelos/sucursal.modelo.php";


class TablaSucursal{

    /*=============================================
     MOSTRAR LA TABLA SUCURSALES
    =============================================*/
  public function mostrarTablaSucursal(){

      $sucursal = ControladorSucursal::ctrMostrarSucursalEmpresa();

      if(count($sucursal) == 0){

        echo '{"data": []}';

        return;

      }

      $datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($sucursal); $i++){

		  	/*=============================================
 	 		    ESTADO
  			=============================================*/

        if($sucursal[$i]["estado"] != 0){

          $estado = "<td><button class='btn btn-success btn-xs btnActivar' idSucursal=".$sucursal[$i]["idsucursal"]." estadoEmpresa='0'>Activado</button></td>";

        }else{

          $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idSucursal=".$sucursal[$i]["idsucursal"]." estadoEmpresa='1'>Desactivado</button></td>";

        }

		  	/*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

		  	$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarSucursal' idSucursal='".$sucursal[$i]["idsucursal"]."' data-toggle='modal' data-target='#modalEditarSucursal'><i class='fa fa-pencil'></i></button></div>";

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$sucursal[$i]["codigo"].'",
			      "'.$sucursal[$i]["descripcion"].'",
            "'.$sucursal[$i]["sucursal"].'",
			      "'.$estado.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   ']

		 }';

		echo $datosJson;

  }

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarTablaSucursal = new TablaSucursal();
$activarTablaSucursal -> mostrarTablaSucursal();
