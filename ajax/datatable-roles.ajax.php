<?php

require_once "../controladores/roles.controlador.php";
require_once "../modelos/roles.modelo.php";


class TablaRoles
{

	/*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
	public function mostrarTablaRoles()
	{
		$item = null;
		$valor = null;

		$roles = ControladorRoles::ctrMostrarRoles($item, $valor);

		if (count($roles) == 0) {

			echo '{"data": []}';

			return;
		}

		$datosJson = '{
		  "data": [';

		for ($i = 0; $i < count($roles); $i++) {


			/*=============================================
 	 		    ESTADO
  			=============================================*/

			if ($roles[$i]["estado"] != 0) {

				$estado = "<td><button class='btn btn-success btn-xs btnActivarRol' idRol" . $roles[$i]["id_rol"] . " estadoRol='0'>Activado</button></td>";
			} else {

				$estado = "<td><button class='btn btn-danger btn-xs btnActivarRol' idRol=" . $roles[$i]["id_rol"] . " estadoRol='1'>Desactivado</button></td>";
			}

			/*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarRol' idRol='" . $roles[$i]["id_rol"] . "' title='Editar Rol' data-toggle='modal' data-target='#modalEditarRol'><i class='fa fa-pencil'></i></button></div>";

			$datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $roles[$i]["nombre_rol"] . '",
			      "' . $estado . '",
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
$activarTablaRoles = new TablaRoles();
$activarTablaRoles->mostrarTablaRoles();
