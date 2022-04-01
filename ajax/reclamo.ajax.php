<?php

 require_once "../controladores/consultareclamo.controlador.php";
 require_once "../modelos/reclamaciones.modelo.php";

 class AjaxReclamaciones{

    /*=============================================
    VER RECLAMO
    =============================================*/
    public $idReclamo;

    public function ajaxVerReclamo(){

      $item = "codigo";
      $valor = $this->idReclamo;

      $respuesta = ControladorConsultaReclamos::ctrMostrarReclamos($item, $valor);

      echo json_encode($respuesta);

    }

    /*=============================================
    ASIGNAR TICKET
    =============================================*/
    public $codigo;
    public $usuario;

    public function ajaxAsignarTicket(){

      $valor = $this->codigo;
      $valor2 = $this->usuario;

      $respuesta = ControladorConsultaReclamos::ctrAsignarTicket($valor, $valor2);

      echo json_encode($respuesta);

    }

}


/*=============================================
VER RECLAMO
=============================================*/
if(isset($_POST["idReclamo"])){

  $verReclamo = new AjaxReclamaciones();
  $verReclamo -> idReclamo = $_POST["idReclamo"];
  $verReclamo -> ajaxVerReclamo();

}

/*=============================================
ASIGNAR TICKET
=============================================*/
if(isset($_POST["codigo"])){

  $asignaTicket = new AjaxReclamaciones();
  $asignaTicket -> codigo = $_POST["codigo"];
  $asignaTicket -> usuario = $_POST["usuario"];
  $asignaTicket -> ajaxAsignarTicket();

}
