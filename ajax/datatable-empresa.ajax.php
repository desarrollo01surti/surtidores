<?php

require_once "../controladores/empresas.controlador.php";
require_once "../modelos/empresas.modelo.php";


class TablaEmpresas
{

    /*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
    public function mostrarTablaEmpresas()
    {

        $item = null;
        $valor = null;
        $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

        if (count($empresas) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($empresas); $i++) {

            /*=============================================
         TRAEMOS LA IMAGEN
        =============================================*/

            if ($empresas[$i]["logo"] != "") {

                $imagen = "<td><img src=" . $empresas[$i]["logo"] . " width='40px'></td>";
            } else {

                $imagen = "<td><img src='vistas/img/empresas/default/empresa.png' width='40px'></td>";
            }

            // $imagen = "<img src='".$empresas[$i]["logo"]."' width='40px'>";

            /*=============================================
 	 		    ESTADO
  			=============================================*/

            if ($empresas[$i]["estado"] != 0) {

                $estado = "<td><button class='btn btn-success btn-xs btnActivar' idEmpresa=" . $empresas[$i]["id"] . " estadoEmpresa='0'>Activado</button></td>";
            } else {

                $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idEmpresa=" . $empresas[$i]["id"] . " estadoEmpresa='1'>Desactivado</button></td>";
            }

            /*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

            $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='" . $empresas[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pencil'></i></button></div>";

            $datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $empresas[$i]["codigo"] . '",
			      "' . $empresas[$i]["descripcion"] . '",
            "' . $empresas[$i]["ruc"] . '",
            "' . $imagen . '",
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
$activarTablaEmpresas = new TablaEmpresas();
$activarTablaEmpresas->mostrarTablaEmpresas();
