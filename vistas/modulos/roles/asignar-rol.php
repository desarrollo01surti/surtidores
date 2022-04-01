      <!--=====================================
      PANEL LISTA DE ROLES ASIGNADOS
      ======================================-->
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAsignarRol">

          Asignar Nuevo Rol

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaAsignaRoles" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Descripcion</th>
              <th>Responsable</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

          </tbody>

        </table>

      </div>


      <!--=====================================
              MODAL ASIGNAR ROL
      ======================================-->

      <div id="modalAsignarRol" class="modal fade" role="dialog">

        <div class="modal-dialog">

          <div class="modal-content">

            <form role="form" method="post">

              <!--=====================================
                      CABEZA DEL MODAL
              ======================================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Asignar Rol</h4>

              </div>

              <!--=====================================
                      CUERPO DEL MODAL
              ======================================-->

              <div class="modal-body">

                <div class="box-body">

                  <!-- ENTRADA PARA LOS ROLES -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                      <select class="form-control input-lg" id="seleccionarRoles" name="seleccionarRoles" required>

                        <option value="">Selecionar Rol</option>

                        <?php

                        $item = null;
                        $valor = null;
                        $areas = ControladorRoles::ctrMostrarRoles($item, $valor);

                        foreach ($areas as $key => $value) {

                          echo '<option value="' . $value["id_rol"] . '">' . $value["nombre_rol"] . '</option>';
                        }

                        ?>

                      </select>

                    </div>

                  </div>

                  <!-- ENTRADA PARA EL AREA -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                      <select class="form-control input-lg" id="seleccionarTrabajAreaAsignado" name="seleccionarTrabajAreaAsignado" required>

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

                  <!-- ENTRADA PARA ELEGIR AL USUARIO ENCARGADO -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                      <select class="form-control input-lg" id="muestraTrabajadorAjaxAsignado" name="muestraTrabajadorAjaxAsignado" required>

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

                <button type="submit" class="btn btn-primary">Asignar Rol</button>

              </div>

              <?php

              $crearRol = new ControladorRoles();
              $crearRol->ctrActualizarEmpleadoRol();

              ?>

            </form>

          </div>

        </div>

      </div>

      <?php

      $eliminarRolAsignado = new ControladorRoles();
      $eliminarRolAsignado->ctrEliminarRol();

      ?>