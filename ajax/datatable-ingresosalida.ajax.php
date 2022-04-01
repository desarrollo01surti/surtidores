<?php

require_once "../controladores/movimientosimp.controlador.php";
require_once "../modelos/movimientosimp.modelo.php";

class TablaIngresoSalida
{

    /*=============================================
   MOSTRAR LA TABLA DE INGRESO Y SALIDAS PRIMERA MITAD
  =============================================*/
    public function mostrarTablaIngresoSalida1()
    {

        $valor = null;

        $movIngSal = ControladorMovimientosImp::ctrMostrarIngresoSalida($valor);

        if (count($movIngSal) == 0) {

            echo '{"data": []}';

            return;
        }


        $datosJson = '{
		  "data": [';


        for ($i = 0; $i < count($movIngSal); $i++) {

            /*=============================================
 	 		    ESCAPE DE CARACTERES ESPECIALES JSON
  			=============================================*/
            $descrip = json_encode($movIngSal[$i]["descripcion"], JSON_HEX_APOS);

            /*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

            $datosJson .= '[
			      "' . ($i + 1) . '",
			      "' . $movIngSal[$i]["ID_prod"] . '",
            "' . $movIngSal[$i]["razon_social"] . '",
            ' . $descrip . ',
            "' . $movIngSal[$i]["ingreso_enero"] . '",
            "' . $movIngSal[$i]["salida_enero"] . '",
            "' . $movIngSal[$i]["ingreso_febrero"] . '",
            "' . $movIngSal[$i]["salida_febrero"] . '",
            "' . $movIngSal[$i]["ingreso_marzo"] . '",
            "' . $movIngSal[$i]["salida_marzo"] . '",
            "' . $movIngSal[$i]["ingreso_abril"] . '",
            "' . $movIngSal[$i]["salida_abril"] . '",
            "' . $movIngSal[$i]["ingreso_mayo"] . '",
            "' . $movIngSal[$i]["salida_mayo"] . '",
            "' . $movIngSal[$i]["ingreso_junio"] . '",
            "' . $movIngSal[$i]["salida_junio"] . '",
            "' . $movIngSal[$i]["ingreso_julio"] . '"
			    ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=   ']

		 }';

        echo $datosJson;
    }

    /*=============================================
   MOSTRAR LA TABLA DE INGRESO Y SALIDAS SEGUNDA MITAD
  =============================================*/
    public function mostrarTablaIngresoSalida2()
    {

        $valor = null;

        $movIngSal = ControladorMovimientosImp::ctrMostrarIngresoSalida($valor);

        if (count($movIngSal) == 0) {

            echo '{"data": []}';

            return;
        }


        $datosJson = '{
      "data": [';


        for ($i = 0; $i < count($movIngSal); $i++) {

            /*=============================================
          ESCAPE DE CARACTERES ESPECIALES JSON
        =============================================*/
            $descrip = json_encode($movIngSal[$i]["descripcion"], JSON_HEX_APOS);

            /*=============================================
          TRAEMOS LAS ACCIONES
        =============================================*/
            $datosJson .= '[
            "' . ($i + 1) . '",
            "' . $movIngSal[$i]["ID_prod"] . '",
            "' . $movIngSal[$i]["razon_social"] . '",
            ' . $descrip . ',
            "' . $movIngSal[$i]["ingreso_julio"] . '",
            "' . $movIngSal[$i]["salida_julio"] . '",
            "' . $movIngSal[$i]["ingreso_agosto"] . '",
            "' . $movIngSal[$i]["salida_agosto"] . '",
            "' . $movIngSal[$i]["ingreso_setiembre"] . '",
            "' . $movIngSal[$i]["salida_setiembre"] . '",
            "' . $movIngSal[$i]["ingreso_octubre"] . '",
            "' . $movIngSal[$i]["salida_octubre"] . '",
            "' . $movIngSal[$i]["ingreso_noviembre"] . '",
            "' . $movIngSal[$i]["salida_noviembre"] . '",
            "' . $movIngSal[$i]["ingreso_diciembre"] . '",
            "' . $movIngSal[$i]["salida_diciembre"] . '"
          ],';
        }

        $datosJson = substr($datosJson, 0, -1);

        $datosJson .=   ']

     }';

        echo $datosJson;
    }
}

/*=============================================
ACTIVAR TABLA DE PRIMERA MITAD
=============================================*/
if ($_GET["bimestre"] == "primero") {

    $activarTablaIngSal1 = new TablaIngresoSalida();
    $activarTablaIngSal1->mostrarTablaIngresoSalida1();
}

/*=============================================
ACTIVAR TABLA DE SEGUNDA MITAD
=============================================*/
if ($_GET["bimestre"] == "segundo") {

    $activarTablaIngSal1 = new TablaIngresoSalida();
    $activarTablaIngSal1->mostrarTablaIngresoSalida2();
}
