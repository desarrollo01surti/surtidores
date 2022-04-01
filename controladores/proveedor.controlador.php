<?php

class ControladorProveedor{

  static public function ctrMostrarProveedor($item, $valor){

    $tabla = "tb_proveedor";

    $respuesta = ModeloProveedor::mdlMostrarProveedor($tabla, $item, $valor);

    return $respuesta;

  }

}
