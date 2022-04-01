<?php
 //Crear AJAX<?php

 require_once "../controladores/perfiles.controlador.php";
 require_once "../modelos/perfiles.modelo.php";

 require_once "../controladores/modulos.controlador.php";
 require_once "../modelos/modulos.modelo.php";

 class AjaxPerfil{

   	/*=============================================
   	CONSULTA PERFIL
    =============================================*/
    public $idPerfil;

    public function ajaxConsultaPerfil(){

      $valor = $this->idPerfil;

      $respuesta = ControladorPerfiles::ctrConsultaPerfil($valor);

      echo json_encode($respuesta);

    }

    /*=============================================
    CONSULTA ACCESO A MODULOS
    =============================================*/
    public $idPer;

    public function ajaxConsultaModulos(){

      $valor = $this->idPer;

      $item = null;
      $val = null;

      $modulos = ControladorModulos::ctrMostrarModulos($item, $val);

      $accesos = ControladorPerfiles::ctrConsultaPerfil($valor);

      $listaAccesos = json_decode($accesos["accesos"], true);

       if ($listaAccesos == "") { //SI VIENE DATOS VACIOS

            foreach ($modulos as $key => $value1) {

              $nomModulo = $value1["descripcion"];
              $descr = str_replace(' ', '_', $nomModulo);

              $modulojs = "$('.".$descr."').prop('checked', this.checked);";

                         echo '<div class="col-sm-4">
                                  <h4>
                                      <input class="accesofrm" type="checkbox" modulo="modulo" nombre="'.$value1["descripcion"].'" moduid="'.$value1["idmodulo"].'" nombremod="" activo="0" id="'.$descr.'_action" onclick="'.$modulojs.'">
                                      <label for="'.$descr.'_action">
                                          '.$value1["descripcion"].'</label>
                                  </h4>

                                  <div class="well well-sm permission-well">

                                    <div filter-list="search_report">';

                                      $item = "idmodulo";
                                      $valor1 = $value1["idmodulo"];

                                      $submodulos = ControladorModulos::ctrMostrarSubModulos($item, $valor1);

                                      /*=============================================
                                      RECORRE TODOS LOS SUBMODULOS
                                      =============================================*/

                                      foreach ($submodulos as $key => $value2) {

                                        // $submodulojs = "$('.subm".$value2["idsubmod"]."').prop('checked', this.checked);";
                                        $nomModulo2 = $value2["descripcion"];
                                        $descr2 = str_replace(' ', '_', $nomModulo2);
                                        $submodulojs = "$('.".$descr2."').prop('checked', this.checked);";

                                        echo '<div class="media" style="margin: 0px;">

                                                  <div class="media-left"></div>

                                                  <div class="media-body">

                                                    <input type="checkbox" class="accesofrm '.$descr.'" modulo="submodulo" nombre="'.$value2["descripcion"].'" moduid="'.$value2["idsubmod"].'" nombremod="'.$value1["descripcion"].'" activo="0" id="'.$value2["descripcion"].'" value="true" name="acceso" onclick="'.$submodulojs.'">
                                                    <label for="'.$value2["descripcion"].'">'.$value2["descripcion"].'</label>';


                                                    $item = "idsubmod";
                                                    $valor2 = $value2["idsubmod"];

                                                    $trimodulos = ControladorModulos::ctrMostrarTriModulos($item, $valor2);

                                                    /*=============================================
                                                    RECORRE TODOS LOS TRMODULOS
                                                    =============================================*/

                                                    foreach ($trimodulos as $key => $value3) {

                                                      echo'       <!-- Sub modulo -->
                                                                  <div class="media" style="margin: 0px;">
                                                                    <div class="media-left">
                                                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    </div>
                                                                    <div class="media-body">
                                                                      <input type="checkbox" class="accesofrm '.$descr.' '.$descr2.'" modulo="trimodulo" nombre="'.$value3["descripcion"].'" moduid="'.$value3["idtmod"].'" nombremod="'.$value2["descripcion"].'" activo="0" id="'.$value3["descripcion"].'" value="true" name="acceso">
                                                                      <label for="'.$value3["descripcion"].'">'.$value3["descripcion"].'</label>
                                                                    </div>
                                                                  </div>';

                                                    }



                                          echo '   </div>

                                                </div>';

                                      }



                              echo '</div>

                                  </div>

                                </div>';
            }

       }else{
                     /*=============================================
                     RECORRE TODOS LOS MODULOS
                     =============================================*/

                         foreach ($modulos as $key => $value1) {

                           $nomModulo = $value1["descripcion"];
                           $descr = str_replace(' ', '_', $nomModulo);

                           $modulojs = "$('.".$descr."').prop('checked', this.checked);";

                           $valida = "if ($('.accesofrm').is(':checked')) {".$modulojs."}";

                                      echo '<div class="col-sm-4">
                                               <h4>';


                                               foreach ($listaAccesos as $key => $valeAcc) {

                                                   if ($valeAcc["activo"] != 0 && $valeAcc["nombre"] == $value1["descripcion"] && $valeAcc["modulo"] == "modulo") {

                                                      echo '<input class="accesofrm" type="checkbox" modulo="modulo" nombre="'.$value1["descripcion"].'" moduid="'.$value1["idmodulo"].'" nombremod="" activo="0" id="'.$descr.'_action" onclick="'.$modulojs.'" checked>';

                                                      echo '<script>
                                                                         '.$valida.'
                                                           </script>';

                                                   }else if($valeAcc["nombre"] == $value1["descripcion"] && $valeAcc["modulo"] == "modulo"){

                                                      echo '<input class="accesofrm" type="checkbox" modulo="modulo" nombre="'.$value1["descripcion"].'" moduid="'.$value1["idmodulo"].'" nombremod="" activo="0" id="'.$descr.'_action" onclick="'.$modulojs.'">';

                                                   }

                                               }

                                           echo '<label for="'.$descr.'_action">
                                                   '.$value1["descripcion"].'</label>
                                               </h4>

                                               <div class="well well-sm permission-well">

                                                 <div filter-list="search_report">';

                                                   $item = "idmodulo";
                                                   $valor1 = $value1["idmodulo"];

                                                   $submodulos = ControladorModulos::ctrMostrarSubModulos($item, $valor1);

                                                   /*=============================================
                                                   RECORRE TODOS LOS SUBMODULOS
                                                   =============================================*/

                                                   foreach ($submodulos as $key => $value2) {

                                                     // $submodulojs = "$('.subm".$value2["idsubmod"]."').prop('checked', this.checked);";
                                                     $nomModulo2 = $value2["descripcion"];
                                                     $descr2 = str_replace(' ', '_', $nomModulo2);
                                                     $submodulojs = "$('.".$descr2."').prop('checked', this.checked);";
                                                     $submodulojs2 = "$(this).on('change', function() {

                                                                           if (this).is(':checked') ) {

                                                                             $(.'.$descr.'_action).attr('activo', 1);

                                                                             crearDatosJsonCheck()

                                                                           }else{

                                                                             $(.'.$descr.'_action).attr('activo', 0);

                                                                             crearDatosJsonCheck()

                                                                           }

                                                                   });";

                                                     echo '<div class="media" style="margin: 0px;">

                                                               <div class="media-left"></div>

                                                               <div class="media-body">';

                                                               foreach ($listaAccesos as $key => $valeAcc1) {

                                                                   if ($valeAcc1["activo"] != 0 && $valeAcc1["nombre"] == $value2["descripcion"] && $valeAcc1["modulo"] == "submodulo") {

                                                                       echo '<input type="checkbox" class="accesofrm '.$descr.'" modulo="submodulo" nombre="'.$value2["descripcion"].'" moduid="'.$value2["idsubmod"].'" nombremod="'.$value1["descripcion"].'" activo="0" id="'.$value2["descripcion"].'" value="true" name="acceso" onclick="'.$submodulojs.'" checked>';

                                                                   }else if($valeAcc1["nombre"] == $value2["descripcion"]){

                                                                     if($valeAcc1["nombre"] == $value1["descripcion"] && $valeAcc1["modulo"] == "modulo"){

                                                                       echo '<input type="checkbox" class="accesofrm '.$descr.'" modulo="submodulo" nombre="'.$value2["descripcion"].'" moduid="'.$value2["idsubmod"].'" nombremod="'.$value1["descripcion"].'" activo="0" id="'.$value2["descripcion"].'" value="true" name="acceso" onclick="'.$submodulojs.'" checked>';

                                                                     }else{

                                                                       echo '<input type="checkbox" class="accesofrm '.$descr.'" modulo="submodulo" nombre="'.$value2["descripcion"].'" moduid="'.$value2["idsubmod"].'" nombremod="'.$value1["descripcion"].'" activo="0" id="'.$value2["descripcion"].'" value="true" name="acceso" onclick="'.$submodulojs.'">';

                                                                     }

                                                                   }

                                                                   // echo $valeAcc1["nombre"];

                                                               }

                                                            echo'<label for="'.$value2["descripcion"].'">'.$value2["descripcion"].'</label>';


                                                                 $item = "idsubmod";
                                                                 $valor2 = $value2["idsubmod"];

                                                                 $trimodulos = ControladorModulos::ctrMostrarTriModulos($item, $valor2);

                                                                 /*=============================================
                                                                 RECORRE TODOS LOS TRMODULOS
                                                                 =============================================*/

                                                                 foreach ($trimodulos as $key => $value3) {

                                                                   echo'       <!-- Sub modulo -->
                                                                               <div class="media" style="margin: 0px;">
                                                                                 <div class="media-left">
                                                                                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                 </div>
                                                                                 <div class="media-body">';

                                                                                 foreach ($listaAccesos as $key => $valeAcc2) {

                                                                                     if ($valeAcc2["activo"] != 0 && $valeAcc2["nombre"] == $value3["descripcion"] && $valeAcc2["modulo"] == "trimodulo") {

                                                                                        echo '<input type="checkbox" class="accesofrm '.$descr.' '.$descr2.'" modulo="trimodulo" nombre="'.$value3["descripcion"].'" moduid="'.$value3["idtmod"].'" nombremod="'.$value2["descripcion"].'" activo="0" id="'.$value3["descripcion"].'" value="true" name="acceso" checked>';

                                                                                     }else if($valeAcc2["nombre"] == $value3["descripcion"]){

                                                                                       if($valeAcc2["nombre"] == $value2["descripcion"] && $valeAcc2["modulo"] == "submodulo"){

                                                                                         echo '<input type="checkbox" class="accesofrm '.$descr.' '.$descr2.'" modulo="trimodulo" nombre="'.$value3["descripcion"].'" moduid="'.$value3["idtmod"].'" nombremod="'.$value2["descripcion"].'" activo="0" id="'.$value3["descripcion"].'" value="true" name="acceso" checked>';

                                                                                       }else{

                                                                                         echo '<input type="checkbox" class="accesofrm '.$descr.' '.$descr2.'" modulo="trimodulo" nombre="'.$value3["descripcion"].'" moduid="'.$value3["idtmod"].'" nombremod="'.$value2["descripcion"].'" activo="0" id="'.$value3["descripcion"].'" value="true" name="acceso">';

                                                                                       }

                                                                                     }

                                                                                 }

                                                                              echo'<label for="'.$value3["descripcion"].'">'.$value3["descripcion"].'</label>
                                                                                 </div>
                                                                               </div>';

                                                                 }



                                                       echo '   </div>

                                                             </div>';

                                                   }



                                           echo '</div>

                                               </div>

                                             </div>';
                         }


              }

              echo "<script>

                       var checkBoxAccess = $('.accesofrm');

                       $('.accesofrm').on('change', function() {

                        ////MODIFICAR CON ERRORES AL QUITAR CHECK

                             for(var i = 0; i < checkBoxAccess.length; i++){

                               if ($(checkBoxAccess[i]).is(':checked') ) {

                                 $(checkBoxAccess[i]).attr('activo', 1);

                                 crearDatosJsonCheck()

                               }else{

                                 $(checkBoxAccess[i]).attr('activo', 0);

                                 crearDatosJsonCheck()

                               }


                             }

                       });

                      </script>";

    }

}

  /*=============================================
  CONSULTA PERFIL
  =============================================*/
  if(isset($_POST["idPerfil"])){

  	$cperfil = new AjaxPerfil();
  	$cperfil -> idPerfil = $_POST["idPerfil"];
  	$cperfil -> ajaxConsultaPerfil();

  }

  /*=============================================
  CONSULTA ACCESOS A MODULOS DEL SISTEMA
  =============================================*/
  if(isset($_POST["idPer"])){

    $accmodulo = new AjaxPerfil();
    $accmodulo -> idPer = $_POST["idPer"];
    $accmodulo -> ajaxConsultaModulos();

  }
