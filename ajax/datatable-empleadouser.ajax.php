<?php

require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";


class TablaEmpleadoUser
{

    /*=============================================
     MOSTRAR LA TABLA SUCURSALES
    =============================================*/
    public function mostrarTablaEmpleadoUser()
    {

        $empleado = ControladorEmpleado::ctrMostrarEmpleadoTabla();

        if (count($empleado) == 0) {

            echo '{"data": []}';

            return;
        }

        $datosJson = '{
		  "data": [';

        for ($i = 0; $i < count($empleado); $i++) {

            $radioButton = "<input type='radio' name='radEmpleadosBusqueda' nombre='" . $empleado[$i]["nombre"] . "' idarea='" . $empleado[$i]["idarea"] . "' id='" . $empleado[$i]["idempleado"] . "' value='" . $empleado[$i]["idempleado"] . "'>";

            /*=============================================
         TRAEMOS LA IMAGEN
        =============================================*/

            if ($empleado[$i]["foto"] != "") {

                $imagen = "<td><img src=" . $empleado[$i]["logo"] . " width='40px'></td>";
            } else {

                $imagen = "<td><img src='vistas/img/usuarios/default/anonymous.png' width='40px'></td>";
            }

            $datosJson .= '[
            "' . $radioButton . '",
			      "' . ($i + 1) . '",
			      "' . $empleado[$i]["nombre"] . '",
            "' . $empleado[$i]["descripcion"] . '",
            "' . $empleado[$i]["nrodoc"] . '",
            "' . $empleado[$i]["correo"] . '",
            "' . $imagen . '"
			    ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=   ']

		 }';

        echo $datosJson;
    }
}

/*=============================================
ACTIVAR TABLA DE EMPLEADOS
=============================================*/
$activarTablaEmpleadoUser = new TablaEmpleadoUser();
$activarTablaEmpleadoUser->mostrarTablaEmpleadoUser();
