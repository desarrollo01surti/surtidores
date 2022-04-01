<?php

require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";


class TablaPerfiles
{

    /*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
    public function mostrarTablaPerfiles()
    {

        $perfiles = ControladorPerfiles::ctrMostrarPerfiles();

        if (count($perfiles) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($perfiles); $i++) {


            /*=============================================
 	 		    ESTADO
  			=============================================*/

            if ($perfiles[$i]["estado"] != 0) {

                $estado = "<td><button class='btn btn-success btn-xs btnActivar' idUsuario=" . $perfiles[$i]["idperfil"] . " estadoUsuario='0'>Activado</button></td>";
            } else {

                $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idUsuario=" . $perfiles[$i]["idperfil"] . " estadoUsuario='1'>Desactivado</button></td>";
            }

            /*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

            $botones =  "<div class='btn-group'><button class='btn btn-primary btnAccesoModulos' idPerfil='" . $perfiles[$i]["idperfil"] . "' data-toggle='modal' data-target='#modalAccesoModulos'><i class='fa fa-gears'></i></button><button class='btn btn-info btnAccesoPermisos' idPerfil='" . $perfiles[$i]["idperfil"] . "' data-toggle='modal' data-target='#modalAccesoPermisos'><i class='fa fa-key'></i></button></div>";

            $datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $perfiles[$i]["area"] . '",
			      "' . $perfiles[$i]["perfil"] . '",
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarTablaPerfiles = new TablaPerfiles();
$activarTablaPerfiles->mostrarTablaPerfiles();
