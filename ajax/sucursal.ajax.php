<?php

 require_once "../controladores/sucursal.controlador.php";
 require_once "../modelos/sucursal.modelo.php";

 class AjaxSucursal{

    /*=============================================
    EDITAR EMPRESAS
    =============================================*/
    public $idSucursal;

    public function ajaxEditarSucursal(){

      $valor = $this->idSucursal;

      $respuesta = ControladorSucursal::ctrMostrarSucursalDatos($valor);

      echo json_encode($respuesta);

    }

}


/*=============================================
EDITAR EMPLEADO
=============================================*/
if(isset($_POST["idSucursal"])){

  $editarSucursal = new AjaxSucursal();
  $editarSucursal -> idSucursal = $_POST["idSucursal"];
  $editarSucursal -> ajaxEditarSucursal();

}
