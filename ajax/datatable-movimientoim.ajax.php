<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../controladores/movimientosimp.controlador.php";
require_once "../modelos/movimientosimp.modelo.php";

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";


class TablaMovimientosImp
{

    /*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/
    public function mostrarTablaMovimientosImp()
    {

        $valor = null;

        $movImp = ControladorMovimientosImp::ctrMostrarMovimientosImp($valor);

        if (count($movImp) == 0) {

            echo '{"data": []}';

            return;
        }


        $datosJson = '{
		  "data": [';


        for ($i = 0; $i < count($movImp); $i++) {

            /*=============================================
                SACAR PROMEDIO DE VENTAS 6 MESES
            =============================================*/
            $promedioVentas = $movImp[$i]["salida_mes6"] + $movImp[$i]["salida_mes5"] + $movImp[$i]["salida_mes4"] + $movImp[$i]["salida_mes3"] + $movImp[$i]["salida_mes2"] + $movImp[$i]["salida_mes1"];

            /*=============================================
                VALIDAR DEMANANDA DE PRODUCTOS
            =============================================*/
            date_default_timezone_set('America/Lima');
            $fechaHoy = date('Y-m-d');

            //VALIDAR SI NO EXISTE ULTIMA FECHA DE VENTA
            if ($movImp[$i]["fechultimavent"] == "-") {

                $ultimaVentFecha = "2000-01-01";
            } else {

                $ultimaVentFecha = $movImp[$i]["fechultimavent"];
            }

            //OBTENER CANTIDAD DE DIAS ENTRE FECHA DE ULTIMA VENTA - FECHA ACTUAL
            $datetime1 = date_create($ultimaVentFecha);
            $datetime2 = date_create($fechaHoy);
            $contador = date_diff($datetime2, $datetime1);


            //RANGO DE DEMANDA
            if ($contador->format('%a') >= 0 && $contador->format('%a') <= 60) {

                $demanda = "<span class='label label-success'>ALTA</span>";
            } else if ($contador->format('%a') >= 61 && $contador->format('%a') <= 90) {

                $demanda = "<span class='label label-info'>MEDIA</span>";
            } else if ($contador->format('%a') >= 91 && $contador->format('%a') <= 364) {

                $demanda = "<span class='label label-warning'>BAJA</span>";
            } else {

                $demanda = "<span class='label label-danger'>S/D</span>";
            }



            /*=============================================
            FECHA FORMATEADA
            =============================================*/
            //Conociendo fecha formateada con letras
            if ($movImp[$i]["fechaulti"] == "-") {

                $fechanew = $movImp[$i]["fechaulti"];
            } else {

                $num = date("j", strtotime($movImp[$i]["fechaulti"]));
                $anno = date("Y", strtotime($movImp[$i]["fechaulti"]));
                $mes = array('ener.', 'febr.', 'marz.', 'abril', 'mayo', 'jun.', 'jul.', 'ago.', 'sept.', 'oct.', 'nov.', 'dic.');
                $mes = $mes[(date('m', strtotime($movImp[$i]["fechaulti"])) * 1) - 1];
                $fechanew = $num . ' ' . $mes . ' ' . $anno;
            }


            /*=============================================
 	 		    ESCAPE DE CARACTERES ESPECIALES JSON
  			=============================================*/
            $descrip = json_encode($movImp[$i]["descripcion"], JSON_HEX_APOS);

            /*=============================================
 	 		    TRAEMOS LAS ACCIONES
  			=============================================*/

            // $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarEmpresa' idEmpresa='".$movImp[$i]["id"]."' data-toggle='modal' data-target='#modalEditarEmpresa'><i class='fa fa-pencil'></i></button></div>";

            $datosJson .= '[
			"' . $movImp[$i]["ID_prod"] . '",
            "' . $movImp[$i]["razon_social"] . '",
            ' . $descrip . ',
            "' . $movImp[$i]["ingreso_mes6"] . '",
            "' . $movImp[$i]["salida_mes6"] . '",
            "' . $movImp[$i]["ingreso_mes5"] . '",
            "' . $movImp[$i]["salida_mes5"] . '",
            "' . $movImp[$i]["ingreso_mes4"] . '",
            "' . $movImp[$i]["salida_mes4"] . '",
            "' . $movImp[$i]["ingreso_mes3"] . '",
            "' . $movImp[$i]["salida_mes3"] . '",
            "' . $movImp[$i]["ingreso_mes2"] . '",
            "' . $movImp[$i]["salida_mes2"] . '",
            "' . $movImp[$i]["ingreso_mes1"] . '",
            "' . $movImp[$i]["salida_mes1"] . '",
            "' . $promedioVentas . '",
            "' . $movImp[$i]["stock_actual"] . '",
            "' . $movImp[$i]["ultingreso"] . '",
            "' . $fechanew . '",
            "' . $demanda . '"
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
$activarTablaMovimientosImp = new TablaMovimientosImp();
$activarTablaMovimientosImp->mostrarTablaMovimientosImp();
