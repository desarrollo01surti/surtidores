<?php

require_once "../controladores/usuario.controlador.php";
require_once "../modelos/usuario.modelo.php";


class TablaUsuario{

    /*=============================================
     MOSTRAR LA TABLA SUCURSALES
    =============================================*/
  public function mostrarTablaUsuario(){

      $usuario = ControladorUsuario::ctrMostrarUsuarios();

      if(count($usuario) == 0){

        echo '{"data": []}';

        return;

      }

      $datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($usuario); $i++){

		  	/*=============================================
 	 		    ESTADO
  			=============================================*/

        if($usuario[$i]["estado"] != 0){

          $estado = "<td><button class='btn btn-success btn-xs btnActivar' idUsuario=".$usuario[$i]["idusuario"]." estadoEmpresa='0'>Activado</button></td>";

        }else{

          $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idUsuario=".$usuario[$i]["idusuario"]." estadoEmpresa='1'>Desactivado</button></td>";

        }

		  	/*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

		  	$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarUsuario' idUsuario='".$usuario[$i]["idusuario"]."'><i class='fa fa-pencil'></i></button></div>";

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$usuario[$i]["area"].'",
            "'.$usuario[$i]["trabajador"].'",
            "'.$usuario[$i]["perfil"].'",
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
$activarTablaUsuario = new TablaUsuario();
$activarTablaUsuario -> mostrarTablaUsuario();
