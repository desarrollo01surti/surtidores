<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once "../controladores/perfiles.controlador.php";
require_once "../modelos/perfiles.modelo.php";

class AjaxUsuarios
{


  /*=============================================
    CONSULTA PERFILES SEGUN IDAREA
    =============================================*/
  public $idArea;

  public function ajaxConsultaPerfilArea()
  {

    $item = "idarea";
    $valor = $this->idArea;

    $perfiles = ControladorPerfiles::ctrMostrarPerfilesArea($item, $valor);

    echo '<option value="">Selecionar Perfil</option>';


    foreach ($perfiles as $key => $value) {

      echo '<option value="' . $value["idperfil"] . '">' . $value["descripcion"] . '</option>';
    }
  }
}

/*=============================================
 CONSULTA PERFILES SEGUN IDAREA
  =============================================*/
if (isset($_POST["idArea"])) {

  $mostrarPerfilArea = new AjaxUsuarios();
  $mostrarPerfilArea->idArea = $_POST["idArea"];
  $mostrarPerfilArea->ajaxConsultaPerfilArea();
}
