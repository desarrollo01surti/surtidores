<?php

$id_user = $_SESSION["idUsuario"];

//consultar ROL ADMINISTRADOR TICKET
$AdministradorTicket = ControladorRoles::ctrMostrarRolesAsignado('4', $id_user);

?>

<div class="box box-warning">

  <!-- Combobox de Proveedores -->
  <div class="box-header with-border">

    <div class="row">
      <div class="col-xs-6" id="selectEstado">

      </div>

      <div class="col-xs-3">

      </div>

      <div class="col-xs-3">

        <?php if ($AdministradorTicket) : ?>

          <a href="nuevo-ticket" class="btn btn-success">Crear Ticket</a>

        <?php endif; ?>

      </div>

    </div>

    <hr>

  </div>

  <div class="box-body">

    <input type="hidden" id="id_user" value="<?php echo $id_user; ?>">

    <?php

    // if ($AdministradorTicket) {

    echo '<table class="table table-bordered table-striped dt-responsive tablaTickets" width="100%">';
    // } else {

    //   echo '<table class="table table-bordered table-striped dt-responsive tablaTicketsAsignado" width="100%">';
    // }

    ?>

    <thead>

      <tr>

        <th style="width:100px">N° Ticket</th>
        <th>Prioridad</th>
        <th>Registrado por</th>
        <th>Asunto</th>
        <th>RUC/DNI</th>
        <th>Fecha de Registro</th>
        <th>Estado</th>
        <th>Asignado</th>
        <th>Ultima Actualización</th>
        <th>Acciones</th>

      </tr>

    </thead>

    <tbody>

    </tbody>

    </table>

  </div>

</div>

<!--=====================================
    MODAL ASIGNAR RESPONSABLE DE TICKET
======================================-->

<div id="modalAsignarTicket" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Responsable de Ticket</h4>

        </div>

        <!--=====================================
                CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL AREA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <input type="hidden" id="codigoTik" name="codigoTik" value="">

                <select class="form-control input-lg" id="seleccionarTrabajArea" name="seleccionarAreaTickets" required>

                  <option value="">Selecionar Area</option>

                  <?php

                  $item = null;
                  $valor = null;
                  $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

                  foreach ($areas as $key => $value) {

                    echo '<option value="' . $value["idarea"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA ELEGIR AL USUARIO RESPONSABLE DEL TICKET -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" id="muestraTrabajadorAjax" name="muestraTrabajadorTickets" required>


                </select>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
                PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Asignar</button>

        </div>

        <?php

        $asignarTicket = new ControladorTickets();
        $asignarTicket->ctrAsignarTicket();

        ?>

      </form>

    </div>

  </div>

</div>


<?php


$cerrarTicket = new ControladorTickets();
$cerrarTicket->ctrCerrarTicket();

?>