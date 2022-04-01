<?php

require_once "../controladores/stock.controlador.php";
require_once "../modelos/stock.modelo.php";


class TablaStock{

  /*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
  public function mostrarTablaStock(){

      $valor = null;

      $stock = ControladorStock::ctrMostrarStock($valor);

      if(count($stock) == 0){

        echo '{"data": []}';

        return;

      }


      $datosJson = '{
		  "data": [';


		  for($i = 0; $i < count($stock); $i++){

      // /*=============================================
      //  TRAEMOS LA IMAGEN
      // =============================================*/
      //
      // if($movImp[$i]["logo"] != ""){
      //
      //   $imagen = "<td><img src=".$movImp[$i]["logo"]." width='40px'></td>";
      //
      // }else{
      //
      //   $imagen = "<td><img src='vistas/img/empresas/default/empresa.png' width='40px'></td>";
      //
      // }

      /*=============================================
       STOCK
      =============================================*/

      if($stock[$i]["stock_tienda"] <= 20){

        $stk = "<td><span class='badge bg-red'>".$stock[$i]["stock_tienda"]."</span></td>";

      }

        /*=============================================
 	 		    ESCAPE DE CARACTERES ESPECIALES JSON
  			=============================================*/
        $descrip = json_encode($stock[$i]["descripcion"], JSON_HEX_APOS);

		  	/*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

		  	// $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$movImp[$i]["id"]."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pencil'></i></button></div>";

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$stock[$i]["ID_prod"].'",
            "'.$stock[$i]["razon_social"].'",
             '.$descrip.',
            "'.$stock[$i]["stock_total"].'",
            "'.$stk.'",
            "'.$stock[$i]["stock_planta"].'",
            "'.$stock[$i]["stock_cam16"].'",
            "'.$stock[$i]["stock_cam4"].'",
            "'.$stock[$i]["stock_cam5"].'",
            "'.$stock[$i]["stock_cam9"].'"
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
$activarTablaStock = new TablaStock();
$activarTablaStock -> mostrarTablaStock();
