<?php
require_once "../controladores/empleado.controlador.php";
require_once "../modelos/empleado.modelo.php";

require_once "../controladores/roles.controlador.php";
require_once "../modelos/roles.modelo.php";

class AjaxRoles
{


  /*=============================================
    CONSULTA TRABAJADORES SEGUN AREA
  =============================================*/
  public $idArea;

  public function ajaxConsultaTrabajadorArea()
  {

    $valor = $this->idArea;

    $trabajadores = ControladorEmpleado::ctrMostrarTrabajadorRol($valor);

    echo '<option value="">Selecionar Trabajador</option>';

    foreach ($trabajadores as $key => $value) {

      echo '<option value="' . $value["idusuario"] . '">' . $value["nombre"] . '</option>';
    }
  }

  /*=============================================
    CONSULTA DATOS DEL ROL
  =============================================*/
  public $idRol;

  public function ajaxConsultaDataRol()
  {
    $item = "id_rol";
    $valor = $this->idRol;

    $roles = ControladorRoles::ctrMostrarRoles($item, $valor);

    echo json_encode($roles);
  }
}

/*=============================================
  CONSULTA TRABAJADORES SEGUN IDAREA
  =============================================*/
if (isset($_POST["idArea"])) {

  $mostrarTrabajadorArea = new AjaxRoles();
  $mostrarTrabajadorArea->idArea = $_POST["idArea"];
  $mostrarTrabajadorArea->ajaxConsultaTrabajadorArea();
}

/*=============================================
  CONSULTA DATOS DEL ROL
  =============================================*/
if (isset($_POST["idRol"])) {

  $mostrarDataRol = new AjaxRoles();
  $mostrarDataRol->idRol = $_POST["idRol"];
  $mostrarDataRol->ajaxConsultaDataRol();
}
