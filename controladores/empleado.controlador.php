<?php


class ControladorEmpleado
{

  /*=============================================
  MOSTRAR EMPLEADO Y AREA EN TABLA
  =============================================*/

  static public function ctrMostrarEmpleadoTabla()
  {

    $tabla = "SP_EMPLEADOS";

    $respuesta = ModeloEmpleado::mdlMostrarEmpleadoTabla($tabla);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR EMPLEADO
  =============================================*/

  static public function ctrMostrarEmpleado($item, $valor)
  {

    $tabla = "tu_empleado";

    $respuesta = ModeloEmpleado::mdlMostrarEmpleado($tabla, $item, $valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR TRABAJADOR ROL
  =============================================*/

  static public function ctrMostrarTrabajadorRol($valor)
  {

    $respuesta = ModeloEmpleado::mdlMostrarTrabajadorRol($valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR EMPLEADOS PARA EDITAR
  =============================================*/

  static public function ctrMostrarEditarEmpleado($valor)
  {

    $tabla = "SP_EDITAR_EMPL";

    $respuesta = ModeloEmpleado::mdlMostrarEditarEmpleado($tabla, $valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR TIPO DOCUMENTO
  =============================================*/

  static public function ctrMostrarTipoDoc($item, $valor)
  {

    $tabla = "tu_tipo_documento";

    $respuesta = ModeloEmpleado::mdlMostrarTipoDoc($tabla, $item, $valor);

    return $respuesta;
  }

  /*=============================================
  CREAR EMPLEADO
  =============================================*/

  static public function ctrCrearEmpleado()
  {

    if (isset($_POST["nuevoNombre"])) {

      /*=============================================
        VALIDAR IMAGEN
        =============================================*/

      $ruta = "";

      if (isset($_FILES["nuevaFotoEmpleado"]["tmp_name"])) {

        list($ancho, $alto) = getimagesize($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

        $nuevoAncho = 300;
        $nuevoAlto = 90;

        /*=============================================
        	CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
        	=============================================*/

        $directorio = "vistas/img/trabajador/" . $_POST["nuevoNroDoc"];

        mkdir($directorio, 0755);

        /*=============================================
        	DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
        	=============================================*/

        if ($_FILES["nuevaFotoEmpleado"]["type"] == "image/jpeg") {

          /*=============================================
        		GUARDAMOS LA IMAGEN EN EL DIRECTORIO
        		=============================================*/

          $aleatorio = mt_rand(100, 999);

          $ruta = "vistas/img/trabajador/" . $_POST["nuevoNroDoc"] . "/" . $aleatorio . ".jpg";

          $origen = imagecreatefromjpeg($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

          imagejpeg($destino, $ruta);
        }

        if ($_FILES["nuevaFotoEmpleado"]["type"] == "image/png") {

          /*=============================================
        		GUARDAMOS LA IMAGEN EN EL DIRECTORIO
        		=============================================*/

          $aleatorio = mt_rand(100, 999);

          $ruta = "vistas/img/trabajador/" . $_POST["nuevoNroDoc"] . "/" . $aleatorio . ".png";

          $origen = imagecreatefrompng($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

          imagepng($destino, $ruta);
        }
      }

      $tabla = "tu_empleado";

      $datos = array(
        "codigo" => $_POST["nuevoEmpleado"],
        "nombre" => $_POST["nuevoNombre"],
        "idtipodoc" => $_POST["seleccionaTipoDoc"],
        "nrodoc" => $_POST["nuevoNroDoc"],
        "telefono" => $_POST["nuevoTelefono"],
        "correo" => $_POST["nuevoEmail"],
        "idarea" => $_POST["seleccionaArea"],
        "foto" => $ruta,
        "estado" => 1,
        "usu_reg" => $_SESSION["usuario"]
      );

      $respuesta = ModeloEmpleado::mdlIngresarEmpleado($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

            swal({
                type: "success",
                title: "El trabajador ha sido registrado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "empleado";

                    }

                  })

            </script>';
      }
    }
  }

  /*=============================================
  EDITAR EMPLEADO
  =============================================*/

  static public function ctrEditarEmpleado()
  {

    if (isset($_POST["editarEmpleado"])) {

      /*=============================================
        VALIDAR IMAGEN
        =============================================*/

      $ruta = $_POST["fotoActualEmpl"];

      if (isset($_FILES["nuevaFotoEmpleado"]["tmp_name"]) && !empty($_FILES["nuevaFotoEmpleado"]["tmp_name"])) {

        list($ancho, $alto) = getimagesize($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

        $nuevoAncho = 500;
        $nuevoAlto = 500;

        /*=============================================
          CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
          =============================================*/

        $directorio = "vistas/img/trabajador/" . $_POST["editarNroDoc"];

        /*=============================================
          PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
          =============================================*/

        if (!empty($_POST["fotoActualEmpl"])) {

          unlink($_POST["fotoActualEmpl"]);
        } else {

          mkdir($directorio, 0755);
        }

        /*=============================================
          DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
          =============================================*/

        if ($_FILES["nuevaFotoEmpleado"]["type"] == "image/jpeg") {

          /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

          $aleatorio = mt_rand(100, 999);

          $ruta = "vistas/img/trabajador/" . $_POST["editarNroDoc"] . "/" . $aleatorio . ".jpg";

          $origen = imagecreatefromjpeg($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

          imagejpeg($destino, $ruta);
        }

        if ($_FILES["nuevaFotoEmpleado"]["type"] == "image/png") {

          /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

          $aleatorio = mt_rand(100, 999);

          $ruta = "vistas/img/trabajador/" . $_POST["editarNroDoc"] . "/" . $aleatorio . ".png";

          $origen = imagecreatefrompng($_FILES["nuevaFotoEmpleado"]["tmp_name"]);

          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

          imagepng($destino, $ruta);
        }
      }

      $tabla = "tu_empleado";

      $datos = array(
        "codigo" => $_POST["editarEmpleado"],
        "nombre" => $_POST["editarNombre"],
        "idtipodoc" => $_POST["editarTipoDoc"],
        "nrodoc" => $_POST["editarNroDoc"],
        "telefono" => $_POST["editarTelefono"],
        "correo" => $_POST["editarEmail"],
        "idarea" => $_POST["editarArea"],
        "foto" => $ruta
      );

      $respuesta = ModeloEmpleado::mdlEditarEmpleado($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

          swal({
              type: "success",
              title: "Los datos del empleado han sido actualizados correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result) {
                  if (result.value) {

                  window.location = "empleado";

                  }
                })

          </script>';
      }
    }
  }
}
