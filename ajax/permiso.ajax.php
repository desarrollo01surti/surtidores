<?php
 //Crear AJAX<?php

 require_once "../controladores/permisos.controlador.php";
 require_once "../modelos/permisos.modelo.php";

 require_once "../controladores/perfiles.controlador.php";
 require_once "../modelos/perfiles.modelo.php";

 class AjaxPermisos{

   	/*=============================================
   	CONSULTA PERMISOS DEL SISTEMA
    =============================================*/
    public $idPer;

    public function ajaxConsultaPermisos(){

      $valor = $this->idPer;

      $permisos = ControladorPermisos::ctrMostrarPermisos();

      $perfpermiso = ControladorPerfiles::ctrConsultaPerfil($valor);

      $listaPermisos = json_decode($perfpermiso["permisos"], true);

       if ($listaPermisos == "") { //SI VIENE DATOS VACIOS

      echo'<div filter-list="search_report">';

         foreach ($permisos as $key => $value) {

                      echo '<div>
                                <input type="checkbox" class="permisos" nombre="'.$value["descripcion"].'" idAcces="'.$value["idpermiso"].'" activo="0" id="'.$value["descripcion"].'" value="true" name="acceso">
                                <label for="'.$value["descripcion"].'">'.$value["descripcion"].'</label>
                           </div>';

         }

          echo '</div>';

       }else{

                       /*=============================================
                       RECORRE TODOS LOS ACCESOS PERMISOS
                       =============================================*/
                       echo'<div filter-list="search_report">';

                       foreach ($permisos as $key => $value) {

                                    echo '<div>';

                                    foreach ($listaPermisos as $key => $valePer) {

                                        if ($valePer["activo"] != 0 && $valePer["nombre"] == $value["descripcion"]) {

                                           echo '<input type="checkbox" class="permisos" nombre="'.$value["descripcion"].'" idAcces="'.$value["idpermiso"].'" activo="0" id="'.$value["descripcion"].'" value="true" name="acceso" checked>';

                                           // echo '<script>
                                           //                    '.$valida.'
                                           //      </script>';

                                        }else if($valePer["nombre"] == $value["descripcion"]){

                                           echo '<input type="checkbox" class="permisos" nombre="'.$value["descripcion"].'" idAcces="'.$value["idpermiso"].'" activo="0" id="'.$value["descripcion"].'" value="true" name="acceso">';

                                        }

                                    }

                                         echo'<label for="'.$value["descripcion"].'">'.$value["descripcion"].'</label>
                                         </div>';

                       }

                       echo '</div>';


              }

              echo "<script>

                       var checkBoxPermisos = $('.permisos');

                       $('.permisos').on('change', function() {

                       ////MODIFICAR CON ERRORES AL QUITAR CHECK

                       for(var i = 0; i < checkBoxPermisos.length; i++){

                             if ($(checkBoxPermisos[i]).is(':checked') ) {

                                $(checkBoxPermisos[i]).attr('activo', 1);

                                crearDatosJsonCheckPermiso()

                             }else{

                                 $(checkBoxPermisos[i]).attr('activo', 0);

                                 crearDatosJsonCheckPermiso()

                             }


                         }

                         });

                      </script>";

    }

}

  /*=============================================
  CONSULTA PERMISOS
  =============================================*/
  if(isset($_POST["idPer"])){

  	$permisos = new AjaxPermisos();
  	$permisos -> idPer = $_POST["idPer"];
  	$permisos -> ajaxConsultaPermisos();

  }
