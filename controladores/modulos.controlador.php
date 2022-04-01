<?php

class ControladorModulos{

  static public function ctrMostrarModulos($item, $valor){

    $tabla = "tac_modulo";

    $respuesta = ModeloModulos::mdlMostrarModulos($tabla, $item, $valor);

    return $respuesta;

  }

  static public function ctrMostrarSubModulos($item, $valor){

    $tabla = "tac_submodulo";

    $respuesta = ModeloModulos::mdlMostrarSubModulos($tabla, $item, $valor);

    return $respuesta;

  }

  static public function ctrMostrarTriModulos($item, $valor){

    $tabla = "tac_trimodulo";

    $respuesta = ModeloModulos::mdlMostrarTriModulos($tabla, $item, $valor);

    return $respuesta;

  }

  static public function ctrValidarsubModulos($item, $valor){

    $tabla = "tac_submodulo";

    $respuesta = ModeloModulos::mdlValidarModulos($tabla, $item, $valor);

    return $respuesta;

  }

  static public function ctrValidartriModulos($item, $valor){

    $tabla = "tac_trimodulo";

    $respuesta = ModeloModulos::mdlValidarModulos($tabla, $item, $valor);

    return $respuesta;

  }

  /*=============================================
  MOSTRAR TODOS LOS SUBMODULOS EN TABLA
  =============================================*/
  static public function ctrMostrarSubModulosTabla(){

    $tabla = "SP_SUBMODULO";

    $respuesta = ModeloModulos::mdlMostrarSubModulosTabla($tabla);

    return $respuesta;

  }

  /*=============================================
  MOSTRAR TODOS LOS TRIMODULOS EN TABLA
  =============================================*/
  static public function ctrMostrarTriModulosTabla(){

    $tabla = "SP_TRIMODULO";

    $respuesta = ModeloModulos::mdlMostrarTriModulosTabla($tabla);

    return $respuesta;

  }

  /*=============================================
  MOSTRAR SUBMODULOS FILTRADOS POR ID
  =============================================*/
  static public function ctrMostrarSubModuloByID($valor){

    $tabla = "SP_SUBMODULO_CONS";

    $respuesta = ModeloModulos::mdlMostrarSubModuloByID($tabla, $valor);

    return $respuesta;

  }

  /*=============================================
  MOSTRAR TRIMODULOS FILTRADOS POR ID
  =============================================*/
  static public function ctrMostrarTriModuloByID($valor){

    $tabla = "SP_TRIMODULO_CONS";

    $respuesta = ModeloModulos::mdlMostrarTriModuloByID($tabla, $valor);

    return $respuesta;

  }

  /*=============================================
  CREAR MODULO NIVEL 1
  =============================================*/

  static public function ctrCrearModuloN1(){

    if (isset($_POST["nuevoModulo"])) {

        $tabla = "tac_modulo";

        $datos = array("descripcion" => $_POST["nuevoModulo"],
                       "ruta" => "#",
                       "icono" => $_POST["nuevoIcono"]);

        $respuesta = ModeloModulos::mdlCrearModuloN1($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

              swal({
              type: "success",
              title: "El Modulo de Nivel 1 ha sido registrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
            if (result.value) {

                  window.location = "modulos";

             }
             })

            </script>';

        }

    }

  }

  /*=============================================
  CREAR MODULO NIVEL 2
  =============================================*/

  static public function ctrCrearModuloN2(){

    if (isset($_POST["nuevoSubmodulo"])) {

        $tabla = "tac_submodulo";

        $datos = array("descripcion" => $_POST["nuevoSubmodulo"],
                       "idmodulo" => $_POST["seleccionarModulo"],
                       "ruta" => $_POST["nuevaRutaSubmod"]);

        $respuesta = ModeloModulos::mdlCrearModuloN2($tabla, $datos);

        //PRUEBA PARA AÑADIR MODULO A LOS ACCESOS DE LOS USUARIOS (CORREGIR ERROR JSON PARA INSERTAR A LA BD) AVANCE ESTA EN NIVEL2.php

        if($respuesta == "ok"){

          echo'<script>

              swal({
              type: "success",
              title: "El Modulo de Nivel 2 ha sido registrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
            if (result.value) {

                  window.location = "modulos";

             }
             })

            </script>';

        }

    }

  }

  /*=============================================
  CREAR MODULO NIVEL 3
  =============================================*/

  static public function ctrCrearModuloN3(){

    if (isset($_POST["nuevoTrimodulo"])) {

        $tabla = "tac_trimodulo";

        $datos = array("descripcion" => $_POST["nuevoTrimodulo"],
                       "idsubmod" => $_POST["seleccionarSubModuloN3"],
                       "ruta" => $_POST["nuevaRutaTrimod"]);

        $respuesta = ModeloModulos::mdlCrearModuloN3($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

              swal({
              type: "success",
              title: "El Modulo de Nivel 3 ha sido registrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
            if (result.value) {

                  window.location = "modulos";

             }
             })

            </script>';

        }

    }

  }

  /*=============================================
  EDITAR MODULO NIVEL 1
  =============================================*/
  static public function ctrEditarModuloN1(){

    if (isset($_POST["editarModulo"])) {

        $tabla = "tac_modulo";

        $datos = array("idmodulo" => $_POST["idN1"],
                       "descripcion" => $_POST["editarModulo"],
                       "ruta" => "#",
                       "icono" => $_POST["editarIcono"]);

        $respuesta = ModeloModulos::mdlEditarModuloN1($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

              swal({
              type: "success",
              title: "El Modulo de Nivel 1 ha sido Actualizado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
            if (result.value) {

                  window.location = "modulos";

             }
             })

            </script>';

        }

    }

  }

  /*=============================================
  EDITAR MODULO NIVEL 2
  =============================================*/
  static public function ctrEditarModuloN2(){

    if (isset($_POST["editarSubmodulo"])) {

        $tabla = "tac_submodulo";

        $datos = array("idsubmod" => $_POST["idN2"],
                       "descripcion" => $_POST["editarSubmodulo"],
                       "ruta" => $_POST["editarRutaSubmod"],
                       "idmodulo" => $_POST["editarModuloSm"]);

        $respuesta = ModeloModulos::mdlEditarModuloN2($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

              swal({
              type: "success",
              title: "El Modulo de Nivel 2 ha sido Actualizado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
            if (result.value) {

                  window.location = "modulos";

             }
             })

            </script>';

        }

    }

  }


  /*=============================================
  EDITAR MODULO NIVEL 3
  =============================================*/
  static public function ctrEditarModuloN3(){

    if (isset($_POST["editarTrimodulo"])) {

        $tabla = "tac_trimodulo";

        $datos = array("idtmod" => $_POST["idN3"],
                       "descripcion" => $_POST["editarTrimodulo"],
                       "ruta" => $_POST["editarRutaTrimod"],
                       "idsubmod" => $_POST["editarSubModuloN3"]);

        $respuesta = ModeloModulos::mdlEditarModuloN3($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

              swal({
              type: "success",
              title: "El Modulo de Nivel 3 ha sido Actualizado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
            if (result.value) {

                  window.location = "modulos";

             }
             })

            </script>';

        }

    }

  }

}
