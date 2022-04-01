<?php


class ControladorEmpresas{

  /*=============================================
  MOSTRAR EMPRESA
  =============================================*/

  static public function ctrMostrarEmpresas($item, $valor){

    $tabla = "tu_empresas";

    $respuesta = ModeloEmpresas::mdlMostrarEmpresas($tabla, $item, $valor);

    return $respuesta;

  }

  /*=============================================
  CREAR EMPRESA
  =============================================*/

  static public function ctrCrearEmpresa(){

    if(isset($_POST["nuevaRazonSocial"])){

        /*=============================================
        VALIDAR IMAGEN
        =============================================*/

        $ruta = "";

				if(isset($_FILES["nuevaImgEmpresa"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaImgEmpresa"]["tmp_name"]);

					$nuevoAncho = 350;
					$nuevoAlto = 95;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DE LA EMPRESA
					=============================================*/

					$directorio = "vistas/img/empresas/".$_POST["nuevoRUC"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaImgEmpresa"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresas/".$_POST["nuevoRUC"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImgEmpresa"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaImgEmpresa"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresas/".$_POST["nuevoRUC"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImgEmpresa"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

        $tabla = "tu_empresas";

        $datos = array("codigo" => $_POST["nuevaEmpresa"],
                 "ruc" => $_POST["nuevoRUC"],
                 "descripcion" => $_POST["nuevaRazonSocial"],
                 "logo" => $ruta,
                 "estado" => 1);

        $respuesta = ModeloEmpresas::mdlIngresarEmpresa($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

            swal({
                type: "success",
                title: "La empresa ha sido guardada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    if (result.value) {

                    window.location = "empresa";

                    }
                  })

            </script>';

        }

    }

  }


  /*=============================================
  EDITAR EMPRESA
  =============================================*/

  static public function ctrEditarEmpresa(){

    if(isset($_POST["editarEmpresa"])){ ////AQUI QUEDO

        /*=============================================
        VALIDAR IMAGEN
        =============================================*/

        $ruta = $_POST["fotoActualEmp"];

        if(isset($_FILES["nuevaImgEmpresa"]["tmp_name"]) && !empty($_FILES["nuevaImgEmpresa"]["tmp_name"])){

          list($ancho, $alto) = getimagesize($_FILES["nuevaImgEmpresa"]["tmp_name"]);

          $nuevoAncho = 500;
          $nuevoAlto = 500;

          /*=============================================
          CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
          =============================================*/

          $directorio = "vistas/img/trabajador/".$_POST["editarNroDoc"];

          /*=============================================
          PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
          =============================================*/

          if(!empty($_POST["fotoActualEmp"])){

            unlink($_POST["fotoActualEmp"]);

          }else{

            mkdir($directorio, 0755);

          }

          /*=============================================
          DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
          =============================================*/

          if($_FILES["nuevaImgEmpresa"]["type"] == "image/jpeg"){

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);

            $ruta = "vistas/img/trabajador/".$_POST["editarNroDoc"]."/".$aleatorio.".jpg";

            $origen = imagecreatefromjpeg($_FILES["nuevaImgEmpresa"]["tmp_name"]);

            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

            imagejpeg($destino, $ruta);

          }

          if($_FILES["nuevaImgEmpresa"]["type"] == "image/png"){

            /*=============================================
            GUARDAMOS LA IMAGEN EN EL DIRECTORIO
            =============================================*/

            $aleatorio = mt_rand(100,999);

            $ruta = "vistas/img/trabajador/".$_POST["editarNroDoc"]."/".$aleatorio.".png";

            $origen = imagecreatefrompng($_FILES["nuevaImgEmpresa"]["tmp_name"]);

            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

            imagepng($destino, $ruta);

          }

        }

        $tabla = "tu_empresas";

        $datos = array("codigo" => $_POST["editarEmpresa"],
                       "ruc" => $_POST["editarRUC"],
                       "descripcion" => $_POST["editarRazonSocial"],
                       "logo" => $ruta);

        $respuesta = ModeloEmpresas::mdlEditarEmpresa($tabla, $datos);

        if($respuesta == "ok"){

          echo'<script>

          swal({
              type: "success",
              title: "Los datos de la empresa han sido actualizados correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result) {
                  if (result.value) {

                  window.location = "empresa";

                  }
                })

          </script>';

        }

    }

  }

}
