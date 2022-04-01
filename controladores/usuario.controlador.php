<?php


class ControladorUsuario
{

  /*=============================================
  INGRESO DE USUARIO
  =============================================*/

  static public function ctrIngresoUsuario()
  {

    if (isset($_POST["ingUsuario"])) {

      if (
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])
      ) {

        $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $tabla1 = "SP_USUARIOS_CONSULTA";

        $valor = $_POST["ingUsuario"];

        $tablaUs = "tu_usuario";
        $item = "usuario";

        $respuesta = ModeloUsuario::mdlMostrarUsuariosLogin($tabla1, $valor);

        if ($respuesta) {

          $validaEmpresa = ModeloUsuario::mdlMostrarUsuariosFiltro($tablaUs, $item, $valor);

          if ($validaEmpresa["idempresa"] != 0) {

            if ($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["pass"] == $encriptar) {

              if ($respuesta["estado"] == 1) {

                $_SESSION["iniciarSesion"] = "ok";
                $_SESSION["acceder"] = "ok";
                $_SESSION["idUsuario"] = $respuesta["idusuario"];
                $_SESSION["nombre"] = $respuesta["trabajador"];
                $_SESSION["codigoem"] = $respuesta["codigo"];
                $_SESSION["documento"] = $respuesta["documento"];
                $_SESSION["correo"] = $respuesta["correo"];
                $_SESSION["usuario"] = $respuesta["usuario"];
                $_SESSION["foto"] = $respuesta["foto"];
                $_SESSION["logoEmpresa"] = $respuesta["logo"];
                $_SESSION["idArea"] = $respuesta["idarea"];
                $_SESSION["idPerfil"] = $respuesta["idperfil"];
                $_SESSION["perfil"] = $respuesta["perfil"];
                $_SESSION["accesos"] = $respuesta["accesos"];
                $_SESSION["sucursales"] = $respuesta["sucursales"];

                /*=============================================
                  REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
                  =============================================*/

                date_default_timezone_set('America/Lima');

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');

                $fechaActual = $fecha . ' ' . $hora;

                $item1 = "ultimo_login";
                $valor1 = $fechaActual;

                $item2 = "idusuario";
                $valor2 = $respuesta["idusuario"];

                $tabla2 = "tu_usuario";

                $ultimoLogin = ModeloUsuario::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2);

                if ($ultimoLogin == "ok") {

                  echo '<script>

                      window.location = "acceder";

                    </script>';
                }
              } else {

                echo '<br>
                    <div class="alert alert-danger">El usuario aún no está activado</div>';
              }
            } else {

              echo '<br><div class="alert alert-danger">Error al ingresar, Contraseña incorrecta. Vuelve a intentarlo</div>';
            }
          } else {

            echo '<br><div class="alert alert-danger">Error al ingresar, El usuario no tiene asignada una sucursal</div>';
          }
        } else {

          echo '<br><div class="alert alert-danger">Error al ingresar, El usuario no existe.</div>';
        }
      } else {

        echo '<br><div class="alert alert-danger">Error al ingresar, No se permiten caracteres especiales.</div>';
      }
    }
  }

  /*=============================================
  INGRESO DE USUARIO
  =============================================*/

  static public function ctrIngresoUsuarioToken($usuario)
  {

    $tabla1 = "SP_USUARIOS_CONSULTA";
    $valor = $usuario;

    $respuesta = ModeloUsuario::mdlMostrarUsuariosLogin($tabla1, $valor);

    if (is_array($respuesta)) {

      $_SESSION["iniciarSesion"] = "ok";
      $_SESSION["acceder"] = "ok";
      $_SESSION["idUsuario"] = $respuesta["idusuario"];
      $_SESSION["nombre"] = $respuesta["trabajador"];
      $_SESSION["codigoem"] = $respuesta["codigo"];
      $_SESSION["documento"] = $respuesta["documento"];
      $_SESSION["correo"] = $respuesta["correo"];
      $_SESSION["usuario"] = $respuesta["usuario"];
      $_SESSION["foto"] = $respuesta["foto"];
      $_SESSION["logoEmpresa"] = $respuesta["logo"];
      $_SESSION["idArea"] = $respuesta["idarea"];
      $_SESSION["idPerfil"] = $respuesta["idperfil"];
      $_SESSION["perfil"] = $respuesta["perfil"];
      $_SESSION["accesos"] = $respuesta["accesos"];
      $_SESSION["sucursales"] = $respuesta["sucursales"];

      /*=============================================
    REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
    =============================================*/

      date_default_timezone_set('America/Lima');

      $fecha = date('Y-m-d');
      $hora = date('H:i:s');

      $fechaActual = $fecha . ' ' . $hora;

      $item1 = "ultimo_login";
      $valor1 = $fechaActual;

      $item2 = "idusuario";
      $valor2 = $respuesta["idusuario"];

      $tabla2 = "tu_usuario";

      $ultimoLogin = ModeloUsuario::mdlActualizarUsuario($tabla2, $item1, $valor1, $item2, $valor2);

      if ($ultimoLogin == "ok") {

        echo '<script>

              window.location = "acceder";

           </script>';
      }
    } else {

      echo '<script>

          swal({

            type: "error",
            title: "¡El usuario aún no tiene acceso al Sistema Catalogo 2!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          })

        </script>';
    }
  }

  /*=============================================
  MOSTRAR USUARIOS TABLA
  =============================================*/

  static public function ctrMostrarUsuarios()
  {

    $tabla = "SP_USUARIOS";

    $respuesta = ModeloUsuario::mdlMostrarUsuarios($tabla);

    return $respuesta;
  }

  /*=============================================
  Mostrar Usuarios (ADAPTADO) Ticket
  =============================================*/

  static public function ctrMostrarUsuariosTick($item, $valor)
  {

    $tabla = "tu_usuario_cliente";

    $respuesta = ModeloUsuario::mdlMostrarUsuariosTick($tabla, $item, $valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR USUARIOS FILTRO
  =============================================*/

  static public function ctrMostrarUsuariosFiltro($item, $valor)
  {

    $tabla = "tu_usuario";

    $respuesta = ModeloUsuario::mdlMostrarUsuariosFiltro($tabla, $item, $valor);

    return $respuesta;
  }

  /*=============================================
  REGISTRO DE USUARIO
  =============================================*/
  static public function ctrCrearUsuario()
  {

    if (isset($_POST["nuevoUsuario"])) {

      if (
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
      ) {

        $tabla = "tu_usuario";

        $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

        $datos = array(
          "idempleado" => $_POST["nuevoidTrabajador"],
          "idperfil" => $_POST["seleccionaPerfil"],
          "idempresa" => $_POST["seleccionaEmpresa"],
          "sucursales" => $_POST["valorSucursal"],
          "usuario" => $_POST["nuevoUsuario"],
          "pass" => $encriptar,
          "password" => $_POST["nuevoPassword"],
          "estado" => "1"
        );

        // var_dump($datos);

        $respuesta = ModeloUsuario::mdlIngresarUsuario($tabla, $datos);

        if ($respuesta == "ok") {

          echo '<script>

          swal({

            type: "success",
            title: "¡El usuario ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "usuario";

            }

          });


          </script>';
        }
      } else {

        echo '<script>

          swal({

            type: "error",
            title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"

          }).then(function(result){

            if(result.value){

              window.location = "usuario";

            }

          });


        </script>';
      }
    }
  }
}
