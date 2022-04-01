<?php


class ControladorPerfiles
{

  /*=============================================
  MOSTRAR PERFILES POR AREA
  =============================================*/
  static public function ctrMostrarPerfilesArea($item, $valor)
  {

    $tabla = "tu_perfil";

    $respuesta = ModeloPerfiles::mdlMostrarPerfilesArea($tabla, $item, $valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR LISTA DE PERFILES
  =============================================*/
  static public function ctrMostrarPerfiles()
  {

    $tabla = "SP_PERFILES";

    $respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR PERFILES SEGUN VALOR
  =============================================*/
  static public function ctrConsultaPerfil($valor)
  {

    $tabla = "SP_PERFIL_CONSULTA";

    $respuesta = ModeloPerfiles::mdlConsultaPerfil($tabla, $valor);

    return $respuesta;
  }

  /*=============================================
  ACTUALIZA ACCESOS DE PERFILES
  =============================================*/
  static public function ctrActualizarAccesos()
  {

    if (isset($_POST["valorPerfil"])) {

      $tabla = "tu_perfil";
      $id = $_POST["idP"];
      $item = "accesos";
      $valor = $_POST["valorPerfil"];

      $respuesta = ModeloPerfiles::mdlActualizarAccesos($tabla, $id, $item, $valor);

      if ($respuesta == "ok") {

        echo '<script>

        swal({
            type: "success",
            title: "Se actualizo los accesos correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
            }).then(function(result){
                if (result.value) {

                window.location = "perfil";

                }
              })

        </script>';
      }
    }
  }

  /*=============================================
  CREAR PERFILES
  =============================================*/

  static public function ctrCrearPerfil()
  {

    if (isset($_POST["nuevoPerfil"])) {

      $tabla = "tu_perfil";

      $datos = array(
        "descripcion" => $_POST["nuevoPerfil"],
        "idarea" => $_POST["seleccionarArea"],
        "estado" => 1
      );

      $respuesta = ModeloPerfiles::mdlIngresarPerfil($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

          swal({
              type: "success",
              title: "El perfil ha sido guardado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "perfil";

                  }
                })

          </script>';
      }
    }
  }
}
