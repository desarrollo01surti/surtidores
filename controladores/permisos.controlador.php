<?php


class ControladorPermisos{

  static public function ctrMostrarPermisos(){

    $tabla = "tu_permiso";

    $respuesta = ModeloPermisos::mdlMostrarPermisos($tabla);

    return $respuesta;

  }

  static public function ctrActualizarPermisos(){

    if(isset($_POST["valorPermiso"])){

      $tabla = "tu_perfil";
      $id = $_POST["idPe"];
      $item = "permisos";
      $valor = $_POST["valorPermiso"];

      $respuesta = ModeloPermisos::mdlActualizarPermiso($tabla, $id, $item, $valor);

      if ($respuesta == "ok") {

        echo'<script>

        swal({
            type: "success",
            title: "Se actualizaron los Permisos correctamente",
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
