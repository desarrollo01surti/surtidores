
<?php

class ControladorOrdenCompra
{

    /*=============================================
	MOSTRAR ORDEN DE COMPRA CABECERA
	=============================================*/

    static public function ctrMostrarOrdenCab($item, $valor)
    {

        $tabla = "tu_ordencab";

        $respuesta = ModeloOrdenCompra::mdlMostrarOrdenCab($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	MOSTRAR ULTIMA ORDEN DE COMPRA
	=============================================*/

    static public function ctrMostrarUltimaOrden()
    {

        $tabla = "tu_ordencab";

        $respuesta = ModeloOrdenCompra::mdlMostrarUltimaOrden($tabla);

        return $respuesta;
    }

    /*=============================================
	MOSTRAR TIPO DE VIA
	=============================================*/

    static public function ctrMostrarVia($item, $valor)
    {

        $tabla = "tu_via";

        $respuesta = ModeloOrdenCompra::mdlMostrarVia($tabla, $item, $valor);

        return $respuesta;
    }
}
