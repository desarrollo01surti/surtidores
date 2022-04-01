<?php


class ControladorSucursal
{

  /*=============================================
  MOSTRAR SUCURSAL EMPRESA
  =============================================*/

  static public function ctrMostrarSucursalEmpresa()
  {

    $tabla = "SP_SUCURSALES";

    $respuesta = ModeloSucursal::mdlMostrarSucursalEmpresa($tabla);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR DATA PARA EDITAR SUCURSAL
  =============================================*/

  static public function ctrMostrarSucursalDatos($valor)
  {

    $tabla = "SP_SUCURSALES_CONS";

    $respuesta = ModeloSucursal::mdlMostrarSucursalEdit($tabla, $valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR SUCURSAL
  =============================================*/

  static public function ctrMostrarSucursal($item, $valor, $select)
  {

    $tabla = "tu_sucursal";

    $respuesta = ModeloSucursal::mdlMostrarSucursal($tabla, $item, $valor, $select);

    return $respuesta;
  }

  /*=============================================
  CREAR SUCURSAL
  =============================================*/

  static public function ctrCrearSucursal()
  {

    if (isset($_POST["nuevaDescrip"])) {

      $tabla = "tu_sucursal";

      $datos = array(
        "codigo" => $_POST["nuevaSucursal"],
        "descripcion" => $_POST["nuevaDescrip"],
        "empresa" => $_POST["seleccionaEmpresa"],
        "estado" => 1
      );

      $respuesta = ModeloSucursal::mdlIngresarSucursal($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

            swal({
                type: "success",
                title: "La sucursal ha sido guardada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "sucursal";

                    }
                  })

            </script>';
      }
    }
  }

  /*=============================================
  EDITAR SUCURSAL
  =============================================*/

  static public function ctrEditarSucursal()
  {

    if (isset($_POST["editarSucursal"])) {

      $tabla = "tu_sucursal";

      $datos = array(
        "codigo" => $_POST["editarSucursal"],
        "descripcion" => $_POST["editarDescrip"],
        "empresa" => $_POST["editSeleccionarEmpresa"]
      );

      $respuesta = ModeloSucursal::mdlEditarSucursal($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

            swal({
                type: "success",
                title: "La sucursal ha sido actualizada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "sucursal";

                    }
                  })

            </script>';
      }
    }
  }
}
