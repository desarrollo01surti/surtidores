<?php


class ControladorRoles
{

  /*=============================================
  MOSTRAR LISTA DE ROLES
  =============================================*/
  static public function ctrMostrarRolesTabla($item, $valor)
  {
    $respuesta = ModeloRoles::mdlMostrarRolesTabla($item, $valor);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR LISTA DE ROLES ASIGNADO
  =============================================*/
  static public function ctrMostrarRolesAsignado($idrol, $iduser)
  {
    $respuesta = ModeloRoles::mdlMostrarRolesAsignado($idrol, $iduser);

    return $respuesta;
  }

  /*=============================================
  MOSTRAR ROLES POR ID USUARIO
  =============================================*/
  static public function ctrMostrarRoles($item, $valor)
  {

    $tabla = "tu_roles";

    $respuesta = ModeloRoles::mdlMostrarRolTickets($tabla, $item, $valor);

    return $respuesta;
  }

  /*=============================================
  CREAR ROLES
  =============================================*/

  static public function ctrCrearRoles()
  {

    if (isset($_POST["nuevoRol"])) {

      $tabla = "tu_roles";
      date_default_timezone_set('America/Lima');
      $fecha = date('Y-m-d');
      $hora = date('H:i:s');
      $fechaActual = $fecha . ' ' . $hora;

      $datos = array(
        "nombre_rol" => $_POST["nuevoRol"],
        "estado" => 1,
        "fecha" => $fechaActual
      );

      $respuesta = ModeloRoles::mdlIngresarRol($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

          swal({
              type: "success",
              title: "El Rol ha sido guardado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "roles";

                  }
                })

          </script>';
      }
    }
  }


  /*=============================================
  CREAR ROLES
  =============================================*/

  static public function ctrEditarRoles()
  {

    if (isset($_POST["editarRol"])) {

      $tabla = "tu_roles";
      $item1 = "nombre_rol";
      $valor1 = $_POST["editarRol"];
      $item2 = "id_rol";
      $valor2 = $_POST["idRol"];

      $respuesta = ModeloRoles::mdlActualizarRol($tabla, $item1, $valor1, $item2, $valor2);

      if ($respuesta == "ok") {

        echo '<script>

          swal({
              type: "success",
              title: "El nombre del Rol ha sido Actualizado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "roles";

                  }
                })

          </script>';
      }
    }
  }

  /*=============================================
  ACTUALIZAR ASIGNADO DE ROL
  =============================================*/

  static public function ctrActualizarEmpleadoRol()
  {

    if (isset($_POST["muestraTrabajadorAjaxAsignado"])) {

      $tabla = "tu_roles_usuario";

      $datos = array(
        "id_usuario" => $_POST["muestraTrabajadorAjaxAsignado"],
        "id_rol" => $_POST["seleccionarRoles"]
      );

      $respuesta = ModeloRoles::mdlAsignarRolUsuario($tabla, $datos);

      if ($respuesta == "ok") {

        echo '<script>

          swal({
              type: "success",
              title: "El empleado ha sido asignado al Rol correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "roles";

                  }
                })

          </script>';
      }
    }
  }

  /*=============================================
   ELIMINAR ROL ASIGNADO 
  =============================================*/

  static public function ctrEliminarRol()
  {

    if (isset($_GET["idRolAsig"])) {

      $tabla = "tu_roles_usuario";
      $valor = $_GET["idRolAsig"];

      $respuesta = ModeloRoles::mdlBorrarRolAsignado($tabla, $valor);

      if ($respuesta == "ok") {

        echo '<script>

				swal({
					  type: "success",
					  title: "El Rol ha sido quitado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "roles";

								}
							})

				</script>';
      }
    }
  }
}
