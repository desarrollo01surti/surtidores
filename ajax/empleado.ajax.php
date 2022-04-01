<?php

 require_once "../controladores/empleado.controlador.php";
 require_once "../modelos/empleado.modelo.php";

 class AjaxEmpleado{

    /*=============================================
    EDITAR MODULO N1
    =============================================*/
    public $idEmpleado;

    public function ajaxEditarEmpleado(){

      $valor = $this->idEmpleado;

      $respuesta = ControladorEmpleado::ctrMostrarEditarEmpleado($valor);

      echo json_encode($respuesta);

    }

}


/*=============================================
EDITAR EMPLEADO
=============================================*/
if(isset($_POST["idEmpleado"])){

  $editarEmpleado = new AjaxEmpleado();
  $editarEmpleado -> idEmpleado = $_POST["idEmpleado"];
  $editarEmpleado -> ajaxEditarEmpleado();

}
