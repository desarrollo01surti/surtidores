<?php

//PRUEBA PARA AÑADIR MODULO A LOS ACCESOS DE LOS USUARIOS (CORREGIR ERROR JSON PARA INSERTAR A LA BD)
// $item = null;
// $valor = null;
// $tablaPerf = "tu_perfil";
// $dataAcc = ModeloPerfiles::mdlMostrarPerfilesArea($tablaPerf, $item, $valor);
//
// // $listaAccesos = json_decode($dataAcc["accesos"], true);
//
// foreach ($dataAcc as $key => $value) {
//
//    if ($value["accesos"] == "") {
//
//        echo'NO TIENE DATOS = '.$value["descripcion"];
//
//        // $actualix = ModeloPerfiles::mdlActualizarAccesos("tu_perfil","8","accesos",);
//
//    }else{
//
//      echo'SI TIENE DATOS = '.$value["descripcion"];
//
//      $dataNueva = json_decode($value["accesos"]);
//
//      $dataNueva += ('id'=> '14', 'activo'=> '0', 'nombre'=> 'Roles', 'modulo'=> 'submodulo',
//                         'nombremod'=> 'Gestor Usuarios');
//
//      //QUITADO array_push($dataNueva, $nuevoMod);
//
//      //QUITADO array_push($dataNueva,{"id": "14","activo": "0","nombre": "Roles","modulo": "submodulo","nombremod": "Gestor Usuarios"});
//
//      //QUITADO echo json_encode($dataNueva);
//
//      echo $value["accesos"];
//
//    }
//
// }

 ?>
<div class="box-header with-border">

  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModuloN2">

    Agregar Modulo

  </button>

</div>

<div class="box-body">

  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

   <thead>

    <tr>

      <th style="width:10px">#</th>
      <th>Descripcion</th>
      <th>Modulo</th>
      <th>Ruta</th>
      <th>Acciones</th>

    </tr>

   </thead>

   <tbody>

     <?php

     $submodulos = ControladorModulos::ctrMostrarSubModulosTabla();

      foreach ($submodulos as $key => $value){

         echo ' <tr>
                 <td>'.($key+1).'</td>
                 <td>'.$value["descripcion"].'</td>
                 <td>'.$value["modulo"].'</td>
                 <td>'.$value["ruta"].'</td>
                 <td>

                   <div class="btn-group">

                     <button class="btn btn-warning btnEditarModuloN2" idSubmodulo="'.$value["idsubmod"].'" data-toggle="modal" data-target="#modalEditarModuloN2"><i class="fa fa-pencil"></i></button>

                   </div>

                 </td>

               </tr>';

       }


     ?>

   </tbody>

  </table>

</div>

<!--=====================================
MODAL AGREGAR MODULO NIVEL 2
======================================-->
<div id="modalAgregarModuloN2" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Modulo Nivel 2</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <select class="form-control input-lg" id="seleccionarModulo" name="seleccionarModulo" required>

                <option value="">Seleccionar Modulo</option>

                <?php

                    $item = null;
                    $valor = null;

                    $modulos = ControladorModulos::ctrMostrarModulos($item, $valor);

                   foreach ($modulos as $key => $value) {

                     echo '<option value="'.$value["idmodulo"].'">'.$value["descripcion"].'</option>';

                   }

                ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL SUBMODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoSubmodulo" placeholder="Ingresar Submodulo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA RUTA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaRutaSubmod" placeholder="Ingresar Ruta (minúsculas)" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Submodulo</button>

        </div>

        <?php

           $crearModuloN2 = new ControladorModulos();
           $crearModuloN2 -> ctrCrearModuloN2();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR MODULO NIVEL 2
======================================-->
<div id="modalEditarModuloN2" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Modulo Nivel 2</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <select class="form-control input-lg" id="editarModuloSm" name="editarModuloSm" required>

                <option value="" id="editModulo"></option>

                <?php

                    $item = null;
                    $valor = null;

                    $modulos = ControladorModulos::ctrMostrarModulos($item, $valor);

                   foreach ($modulos as $key => $value) {

                     echo '<option value="'.$value["idmodulo"].'">'.$value["descripcion"].'</option>';

                   }

                ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL SUBMODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="editarSubmodulo" id="editarSubmodulo" required>
                <input type="hidden" class="form-control input-lg" name="idN2" id="idN2">

              </div>

            </div>

            <!-- ENTRADA PARA LA RUTA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="editarRutaSubmod" id="editarRutaSubmod" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Submodulo</button>

        </div>

        <?php

           $editarModuloN2 = new ControladorModulos();
           $editarModuloN2 -> ctrEditarModuloN2();

        ?>

      </form>

    </div>

  </div>

</div>
