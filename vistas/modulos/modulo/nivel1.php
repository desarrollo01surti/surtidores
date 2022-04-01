<div class="box-header with-border">

  <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModuloN1">

    Agregar Modulo

  </button>

</div>

<div class="box-body">

  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

   <thead>

    <tr>

      <th style="width:10px">#</th>
      <th>Descripcion</th>
      <th>ruta</th>
      <th>Icono</th>
      <th>Acciones</th>

    </tr>

   </thead>

   <tbody>

     <?php

     $item = null;
     $valor = null;

     $modulos = ControladorModulos::ctrMostrarModulos($item, $valor);

      foreach ($modulos as $key => $value){

         echo ' <tr>
                 <td>'.($key+1).'</td>
                 <td>'.$value["descripcion"].'</td>
                 <td>'.$value["ruta"].'</td>
                 <td><span class="pull-left badge bg-blue"><i class="fa fa-fw '.$value["icono"].'"></i></span></td>
                 <td>

                   <div class="btn-group">

                     <button class="btn btn-warning btnEditarModuloN1" idModulo="'.$value["idmodulo"].'" data-toggle="modal" data-target="#modalEditarModuloN1"><i class="fa fa-pencil"></i></button>

                   </div>

                 </td>

               </tr>';

       }


     ?>

   </tbody>

  </table>

</div>

<!--=====================================
MODAL AGREGAR MODULO NIVEL 1
======================================-->
<div id="modalAgregarModuloN1" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Modulo Nivel 1</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DEL MODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoModulo" placeholder="Ingresar Modulo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ICONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoIcono" placeholder="Ingresar Icono (ej: fa-archive)" required>

              </div>

            </div>

            <a href="https://adminlte.io/themes/AdminLTE/pages/UI/icons.html" target="_blank">Ver iconos aqui</a>

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

           $crearModuloN1 = new ControladorModulos();
           $crearModuloN1 -> ctrCrearModuloN1();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR MODULO NIVEL 1
======================================-->

<div id="modalEditarModuloN1" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Modulo Nivel 1</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DEL MODULO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="editarModulo" id="editarModulo" required>
                <input type="hidden" class="form-control input-lg" name="idN1" id="idN1">

              </div>

            </div>

            <!-- ENTRADA PARA EL ICONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                <input type="text" class="form-control input-lg" name="editarIcono" id="editarIcono" required>

              </div>

            </div>

            <a href="https://adminlte.io/themes/AdminLTE/pages/UI/icons.html" target="_blank">Ver iconos aqui</a>

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

           $editarModuloN1 = new ControladorModulos();
           $editarModuloN1 -> ctrEditarModuloN1();

        ?>

      </form>

    </div>

  </div>

</div>
