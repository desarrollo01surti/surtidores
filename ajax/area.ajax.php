<?php

require_once "../controladores/area.controlador.php";
require_once "../modelos/area.modelo.php";

class AjaxAreas
{

    /*=============================================
    EDITAR AREA
    =============================================*/
    public $idArea;

    public function ajaxEditarArea()
    {

        $item = "idarea";
        $valor = $this->idArea;

        $respuesta = ControladorAreas::ctrMostrarAreas($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
  CONSULTA ACCESO AL SISTEMA
  =============================================*/
if (isset($_POST["idArea"])) {

    $editarArea = new AjaxAreas();
    $editarArea->idArea = $_POST["idArea"];
    $editarArea->ajaxEditarArea();
}
