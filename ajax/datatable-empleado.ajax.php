<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";


class TablaEmpleado
{

    /*=============================================
     MOSTRAR LA TABLA SUCURSALES
    =============================================*/
    public function mostrarTablaEmpleado()
    {

        $empleado = ControladorEmpleado::ctrMostrarEmpleadoTabla();

        if (count($empleado) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($empleado); $i++) {

            /*=============================================
         TRAEMOS LA IMAGEN
        =============================================*/

            if ($empleado[$i]["foto"] != "") {

                $imagen = "<td><img src=" . $empleado[$i]["logo"] . " width='40px'></td>";
            } else {

                $imagen = "<td><img src='vistas/img/usuarios/default/anonymous.png' width='40px'></td>";
            }

            /*=============================================
 	 		    ESTADO
  			=============================================*/

            if ($empleado[$i]["estado"] != 0) {

                $estado = "<td><button class='btn btn-success btn-xs btnActivar' idEmpleado=" . $empleado[$i]["idempleado"] . " estadoEmpresa='0'>Activado</button></td>";
            } else {

                $estado = "<td><button class='btn btn-danger btn-xs btnActivar' idEmpleado=" . $empleado[$i]["idempleado"] . " estadoEmpresa='1'>Desactivado</button></td>";
            }

            /*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

            $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEmpleado' idEmpleado='" . $empleado[$i]["idempleado"] . "' data-toggle='modal' data-target='#modalEditarEmpleado'><i class='fa fa-pencil'></i></button></div>";

            $datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $empleado[$i]["codigo"] . '",
			      "' . $empleado[$i]["nombre"] . '",
            "' . $empleado[$i]["descripcion"] . '",
            "' . $empleado[$i]["nrodoc"] . '",
            "' . $empleado[$i]["correo"] . '",
            "' . $empleado[$i]["telefono"] . '",
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
$activarTablaSucursal = new TablaEmpleado();
$activarTablaSucursal->mostrarTablaEmpleado();
