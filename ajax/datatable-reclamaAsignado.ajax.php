<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once "../controladores/consultareclamo.controlador.php";
require_once "../modelos/reclamaciones.modelo.php";

require_once "../modelos/usuario.modelo.php";


class TablaReclamosAsignado
{

    /*=============================================
     MOSTRAR LA TABLA SUCURSALES
    =============================================*/
    public function mostrarTablaReclamosAsignado()
    {

        $item = "responsable";
        $valor = $_GET["id_usuario"];

        $reclamos = ControladorConsultaReclamos::ctrMostrarReclamosTabla($item, $valor);

        if (count($reclamos) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($reclamos); $i++) {

            /*=============================================
             ASIGNADO
            =============================================*/
            if ($reclamos[$i]["responsable"] != 0) {

                //DEVOLVER DATOS DE USUARIO
                $valorUser = $reclamos[$i]["responsable"];
                $usuario = ModeloUsuario::mdlMostrarNombreUsuario($valorUser);

                $asignado = $usuario["nombre"];
            } else {

                $asignado = "-";
            }

            /*=============================================
 	 		    ESTADO (RECIBIDO = 1, ASIGNADO = 3, RESPONDIDO = 2)
  			=============================================*/

            if ($reclamos[$i]["estado"] == 1) {

                $estado = "<td><button class='btn btn-primary btn-xs' idReclamo=" . $reclamos[$i]["codigo"] . ">Recibido</button></td>";
            } else if ($reclamos[$i]["estado"] == 2) {

                $estado = "<td><button class='btn btn-success btn-xs' idReclamo=" . $reclamos[$i]["codigo"] . ">Respondido</button></td>";
            } else {

                $estado = "<td><button class='btn btn-danger btn-xs' idReclamo=" . $reclamos[$i]["codigo"] . ">Asignado</button></td>";
            }

            /*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

            if ($reclamos[$i]["estado"] == 2) {

                $botones = "<div class='btn-group'>";
                $botones .= "<button class='btn btn-default btnVerReclamo' title='ver' idReclamo='" . $reclamos[$i]["codigo"] . "' data-toggle='modal' data-target='#modalVerReclamo'><i class='fa fa-eye'></i></button></div>";
            } else {

                $botones = "<div class='btn-group'><button class='btn btn-primary btnResponder' title='responder' estado='" . $reclamos[$i]["estado"] . "' idReclamo='" . $reclamos[$i]["codigo"] . "' data-toggle='modal' data-target='#modalRespuestaReclamo'><i class='fa fa-mail-reply'></i></button>";
                $botones .= "<button class='btn btn-default btnVerReclamo' title='ver' idReclamo='" . $reclamos[$i]["codigo"] . "' data-toggle='modal' data-target='#modalVerReclamo'><i class='fa fa-eye'></i></button></div>";
            }



            $datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $reclamos[$i]["codigo"] . '",
			      "' . $reclamos[$i]["nombre"] . '",
                  "' . $reclamos[$i]["documento"] . '",
                  "' . $reclamos[$i]["telefono"] . '",
                  "' . $reclamos[$i]["tipo_reclamo"] . '",
			      "' . $estado . '",
                  "' . $asignado . '",
                  "' . $reclamos[$i]["fecha"] . '",
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
$activarTablaReclamos = new TablaReclamosAsignado();
$activarTablaReclamos->mostrarTablaReclamosAsignado();
