<?php

class ControladorAreas{

  static public function ctrMostrarAreas($item, $valor){

    $tabla = "tu_area";

    $respuesta = ModeloAreas::mdlMostrarAreas($tabla, $item, $valor);

    return $respuesta;

  }

  static public function ctrCrearArea(){

    if (isset($_POST["nuevaArea"])) {

      $tabla = "tu_area";

      $datos = array("descripcion" => $_POST["nuevaArea"],
                     "acro" => $_POST["nuevoAcro"]);

      $respuesta = ModeloAreas::mdlCrearArea($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

          swal({
              type: "success",
              title: "El area ha sido registrada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "areas";

                  }
                })

          </script>';

      }

    }

  }

  static public function ctrActualizarArea(){

    if (isset($_POST["editarArea"])) {

      $tabla = "tu_area";

      $datos = array("descripcion" => $_POST["editarArea"],
                     "acro" => $_POST["editarAcro"],
                     "idarea" => $_POST["idA"]);

      $respuesta = ModeloAreas::mdlEditarArea($tabla, $datos);

      if($respuesta == "ok"){

        echo'<script>

          swal({
              type: "success",
              title: "El area ha sido Actualizada correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "areas";

                  }
                })

          </script>';

      }

    }

  }

}
