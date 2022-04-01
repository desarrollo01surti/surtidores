<?php

class ControladorVentas{

  static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

    //$tabla = "tu_area";

    $respuesta = ModeloVentas::mdlRangoFechasVentas($fechaInicial, $fechaFinal);

    return $respuesta;

  }

  static public function ctrProdMasVendidosxSem(){

    $tabla = "";

    $respuesta = ModeloVentas::mdlProdMasVendidosxSem($tabla);

    return $respuesta;

  }

}
