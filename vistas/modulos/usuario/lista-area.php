<!--=====================================
PANEL LISTA DE AREAS
======================================-->
<div class="box box-success">

    <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArea">

        Agregar Area

      </button>

      <button class="btn btn-danger btnExportarCCDG">

        SURSA CCDG-001 PDF

      </button>

      <button class="btn btn-success btnExportarCCCL">

        SURSA CCCL-001 PDF

      </button>

      <button class="btn btn-primary btnExportarCCGG">

        SURSA CCGG-001 PDF

      </button>

      <button class="btn btn-danger btnExportarCCUM">

        SURSA CCUM-001 PDF

      </button>

      <button class="btn btn-success btnExportarCPOS">

        SURSA CPOS-001 PDF

      </button>

    </div>

    <div class="box-body">

      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

       <thead>

        <tr>

          <th style="width:10px">#</th>
          <th>Acrónimo</th>
          <th>Descripcion</th>
          <th>Acciones</th>

        </tr>

       </thead>

       <tbody>

         <?php

         $item = null;
         $valor = null;

         $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

          foreach ($areas as $key => $value){

             echo ' <tr>
                     <td>'.($key+1).'</td>
                     <td>'.$value["acro"].'</td>
                     <td>'.$value["descripcion"].'</td>
                     <td>

                       <div class="btn-group">

                         <button class="btn btn-warning btnEditarArea" idArea="'.$value["idarea"].'" data-toggle="modal" data-target="#modalEditarArea"><i class="fa fa-pencil"></i></button>

                       </div>

                     </td>

                   </tr>';
           }


         ?>

       </tbody>

      </table>

    </div>


</div>

<!--=====================================
MODAL AGREGAR AREA
======================================-->

<div id="modalAgregarArea" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Area</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DEL AREA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaArea" placeholder="Ingresar Area" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ACRONIMO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoAcro" placeholder="Ingresar Acrónimo" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar area</button>

        </div>

        <?php

           $crearArea = new ControladorAreas();
           $crearArea -> ctrCrearArea();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR AREA
======================================-->

<div id="modalEditarArea" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Area</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE DEL AREA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarArea" id="editarArea" required>
                <input type="hidden" class="form-control input-lg" name="idA" id="idA">

              </div>

            </div>

            <!-- ENTRADA PARA EL ACRONIMO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarAcro" id="editarAcro" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar area</button>

        </div>

        <?php

           $editarArea = new ControladorAreas();
           $editarArea -> ctrActualizarArea();

        ?>

      </form>

    </div>

  </div>

</div>
