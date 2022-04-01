<?php

class ControladorStock{

  static public function ctrMostrarStock($valor){

    $tabla = "SP_REPORTESTOCK";

    $respuesta = ModeloStock::mdlMostrarStock($tabla, $valor);

    return $respuesta;

  }

}
