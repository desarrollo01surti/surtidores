<?php

 require_once "../controladores/modulos.controlador.php";
 require_once "../modelos/modulos.modelo.php";

 class AjaxModulos{

    /*=============================================
    EDITAR MODULO N1
    =============================================*/
    public $idModulo;

    public function ajaxEditarModulos(){

      $item = "idmodulo";
      $valor = $this->idModulo;

      $respuesta = ControladorModulos::ctrMostrarModulos($item, $valor);

      echo json_encode($respuesta);

    }

    /*=============================================
    EDITAR MODULO N2
    =============================================*/
    public $idSubmodulo;

    public function ajaxEditarSubModulos(){

      $valor = $this->idSubmodulo;

      $respuesta = ControladorModulos::ctrMostrarSubModuloByID($valor);

      echo json_encode($respuesta);

    }

    /*=============================================
    EDITAR MODULO N3
    =============================================*/
    public $idTrimodulo;

    public function ajaxEditarTriModulos(){

      $valor = $this->idTrimodulo;

      $respuesta = ControladorModulos::ctrMostrarTriModuloByID($valor);

      echo json_encode($respuesta);

    }


    /*=============================================
    CONSULTA SUBMODULOS SEGUN MODULO
    =============================================*/
    public $idModuN3;

    public function ajaxConsultaSubmod(){

      $item = "idmodulo";
      $valor = $this->idModuN3;

      $submod = ControladorModulos::ctrMostrarSubModulos($item, $valor);

     echo'<option value="0">Seleccionar SubModulo</option>';

       foreach ($submod as $key => $value) {

         echo '<option value="'.$value["idsubmod"].'">'.$value["descripcion"].'</option>';

       }


    }

    /*=============================================
    CONSULTA SUBMODULOS SEGUN MODULO PRA EDITAR
    =============================================*/
    public $idModuN3ED;

    public function ajaxConsultaSubmodED(){

      $item = "idmodulo";
      $valor = $this->idModuN3ED;

      $submod = ControladorModulos::ctrMostrarSubModulos($item, $valor);

     echo'<option value="" id="editSubModuloN3">Seleccionar SubModulo</option>';

       foreach ($submod as $key => $value) {

         echo '<option value="'.$value["idsubmod"].'">'.$value["descripcion"].'</option>';

       }


    }

}

  /*=============================================
  EDITAR MODULO N1
  =============================================*/
  if(isset($_POST["idModulo"])){

  	$editarModulo = new AjaxModulos();
  	$editarModulo -> idModulo = $_POST["idModulo"];
  	$editarModulo -> ajaxEditarModulos();

  }

  /*=============================================
  EDITAR MODULO N2
  =============================================*/
  if(isset($_POST["idSubmodulo"])){

    $editarSubModulo = new AjaxModulos();
    $editarSubModulo -> idSubmodulo = $_POST["idSubmodulo"];
    $editarSubModulo -> ajaxEditarSubModulos();

  }

  /*=============================================
  EDITAR MODULO N3
  =============================================*/
  if(isset($_POST["idTrimodulo"])){

    $editarTriModulo = new AjaxModulos();
    $editarTriModulo -> idTrimodulo = $_POST["idTrimodulo"];
    $editarTriModulo -> ajaxEditarTriModulos();

  }

  /*=============================================
  CONSULTA SUBMODULOS SEGUN MODULO
  =============================================*/
  if(isset($_POST["idModuN3"])){

    $consultaTriModulo = new AjaxModulos();
    $consultaTriModulo -> idModuN3 = $_POST["idModuN3"];
    $consultaTriModulo -> ajaxConsultaSubmod();

  }

  /*=============================================
  CONSULTA SUBMODULOS SEGUN MODULO
  =============================================*/
  if(isset($_POST["idModuN3ED"])){

    $consultaTriModuloED = new AjaxModulos();
    $consultaTriModuloED -> idModuN3ED = $_POST["idModuN3ED"];
    $consultaTriModuloED -> ajaxConsultaSubmodED();

  }
