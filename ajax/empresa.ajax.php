<?php

require_once "../controladores/empresas.controlador.php";
require_once "../modelos/empresas.modelo.php";

require_once "../controladores/sucursal.controlador.php";
require_once "../modelos/sucursal.modelo.php";

class AjaxEmpresa
{

  /*=============================================
    EDITAR EMPRESAS
    =============================================*/
  public $idEmp;

  public function ajaxEditarEmpresa()
  {

    $item = "id";
    $valor = $this->idEmp;

    $respuesta = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

    echo json_encode($respuesta);
  }

  /*=============================================
    CARGAR SUCURSALES SEGUN EMPRESA
    =============================================*/
  public $idEmpres;

  public function ajaxCargaSucursalesxEmp()
  {

    $item = "idempresa";
    $valor = $this->idEmpres;
    $select = "sucursal";

    $sucursales = ControladorSucursal::ctrMostrarSucursal($item, $valor, $select);

    echo '<div filter-list="search_report">';

    foreach ($sucursales as $key => $value) {

      echo '<div>
                <input type="checkbox" class="sucursal" nombre="' . $value["descripcion"] . '" idSucursal="' . $value["idsucursal"] . '" activate="0" id="' . $value["descripcion"] . '" value="true">
                <label for="' . $value["descripcion"] . '">' . $value["descripcion"] . '</label>
            </div>';
    }

    echo '</div>';


    echo "<script>

                  var checkBoxSucursales = $('.sucursal');

                  $('.sucursal').on('change', function() {

                   ////MODIFICAR CON ERRORES AL QUITAR CHECK

                        for(var i = 0; i < checkBoxSucursales.length; i++){

                          if ($(checkBoxSucursales[i]).is(':checked') ) {

                            $(checkBoxSucursales[i]).attr('activate', 1);

                            crearDatosJsonCheckSucursal()

                          }else{

                            $(checkBoxSucursales[i]).attr('activate', 0);

                            crearDatosJsonCheckSucursal()

                          }


                        }

                  });

                 </script>";
  }
}


/*=============================================
EDITAR EMPRESA
=============================================*/
if (isset($_POST["idEmp"])) {

  $editarEmpresa = new AjaxEmpresa();
  $editarEmpresa->idEmp = $_POST["idEmp"];
  $editarEmpresa->ajaxEditarEmpresa();
}

/*=============================================
CARGAR SUCURSALES SEGUN EMPRESA
=============================================*/
if (isset($_POST["idEmpresa"])) {

  $cargarSucursalEmpresa = new AjaxEmpresa();
  $cargarSucursalEmpresa->idEmpres = $_POST["idEmpresa"];
  $cargarSucursalEmpresa->ajaxCargaSucursalesxEmp();
}
