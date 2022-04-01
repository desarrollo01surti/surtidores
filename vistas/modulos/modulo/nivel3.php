<div class="box-header with-border">

  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModuloN3">

    Agregar Modulo N3

  </button>

</div>

<div class="box-body">

  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

   <thead>

    <tr>

      <th style="width:10px">#</th>
      <th>Modulo</th>
      <th>SubModulo</th>
      <th>Descripcion</th>
      <th>Ruta</th>
      <th>Acciones</th>

    </tr>

   </thead>

   <tbody>

     <?php

     $trimodulos = ControladorModulos::ctrMostrarTriModulosTabla();

      foreach ($trimodulos as $key => $value){

         echo ' <tr>
                 <td>'.($key+1).'</td>
                 <td>'.$value["modulo"].'</td>
                 <td>'.$value["submodulo"].'</td>
                 <td>'.$value["descripcion"].'</td>
                 <td>'.$value["ruta"].'</td>
                 <td>

                   <div class="btn-group">

                     <button class="btn btn-warning btnEditarModuloN3" idTrimodulo="'.$value["idtmod"].'" data-toggle="modal" data-target="#modalEditarModuloN3"><i class="fa fa-pencil"></i></button>

                   </div>

                 </td>

               </tr>';

       }


     ?>

   </tbody>

  </table>

</div>

<!--=====================================
MODAL AGREGAR MODULO NIVEL 3
======================================-->
<div id="modalAgregarModuloN3" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Modulo Nivel 3</h4>

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

                <select class="form-control input-lg" id="seleccionarModuloN3" name="seleccionarModuloN3" required>

                <option value="0">Seleccionar Modulo</option>

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

                <select class="form-control input-lg" id="seleccionarSubModuloN3" name="seleccionarSubModuloN3" required>


                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL TRIMODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTrimodulo" placeholder="Ingresar Modulo Nivel 3" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA RUTA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaRutaTrimod" placeholder="Ingresar Ruta (minúsculas)" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Modulo</button>

        </div>

        <?php

           $crearModuloN3 = new ControladorModulos();
           $crearModuloN3 -> ctrCrearModuloN3();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR MODULO NIVEL 3
======================================-->
<div id="modalEditarModuloN3" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Modulo Nivel 3</h4>

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

                <select class="form-control input-lg" id="editarModuloN3" name="editarModuloN3" required>

                <option value="" id="editModuloN3"></option>

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

                <select class="form-control input-lg" id="editarSubModuloN3" name="editarSubModuloN3" required>


                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL TRIMODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="editarTrimodulo" id="editarTrimodulo" required>
                <input type="hidden" class="form-control input-lg" name="idN3" id="idN3">

              </div>

            </div>

            <!-- ENTRADA PARA LA RUTA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="editarRutaTrimod" id="editarRutaTrimod" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Modulo</button>

        </div>

        <?php

           $editarModuloN3 = new ControladorModulos();
           $editarModuloN3 -> ctrEditarModuloN3();

        ?>

      </form>

    </div>

  </div>

</div>
