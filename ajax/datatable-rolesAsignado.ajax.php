<?php

require_once "../controladores/roles.controlador.php";
require_once "../modelos/roles.modelo.php";


class TablaRolesAsignado
{

	/*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
	public function mostrarTablaRolesAsignado()
	{
		$idrol = null;
		$idusuario = null;

		$rolesAsig = ControladorRoles::ctrMostrarRolesAsignado($idrol, $idusuario);

		if (count($rolesAsig) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($rolesAsig); $i++) {


			/*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

			$botones =  "<div class='btn-group'><button class='btn btn-danger btnQuitarAsignado' empleado ='" . $rolesAsig[$i]["nombre"] . "'  idRolAsig='" . $rolesAsig[$i]["id_rolusuario"] . "' title='Eliminar Rol'><i class='fa fa-trash'></i></button></div>";

			$datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $rolesAsig[$i]["nombre_rol"] . '",
			      "' . $rolesAsig[$i]["nombre"] . '",
			      "' . $botones . '"
			    ],';
		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   ']

		 }';

		echo $datosJson;
	}
}

/*=============================================
ACTIVAR TABLA DE ROLES
=============================================*/
$activarTablaRolesAsignado = new TablaRolesAsignado();
$activarTablaRolesAsignado->mostrarTablaRolesAsignado();
