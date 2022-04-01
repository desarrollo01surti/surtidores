      <!--=====================================
      PANEL LISTA DE ROLES
      ======================================-->
      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRol">

          Agregar Nuevo Rol

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaRoles" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Descripcion</th>
              <th>Estado</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

          </tbody>

        </table>

      </div>


      <!--=====================================
              MODAL AGREGAR ROL
      ======================================-->

      <div id="modalAgregarRol" class="modal fade" role="dialog">

        <div class="modal-dialog">

          <div class="modal-content">

            <form role="form" method="post">

              <!--=====================================
                      CABEZA DEL MODAL
              ======================================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Agregar Rol</h4>

              </div>

              <!--=====================================
                      CUERPO DEL MODAL
              ======================================-->

              <div class="modal-body">

                <div class="box-body">

                  <!-- ENTRADA PARA LA DESCRIPCION DEL ROL -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control input-lg" name="nuevoRol" id="nuevoRol" placeholder="Ingresar Descripcion" required>

                    </div>

                  </div>

                </div>

              </div>

              <!--=====================================
                      PIE DEL MODAL
              ======================================-->

              <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary">Guardar Rol</button>

              </div>

              <?php

              $crearRol = new ControladorRoles();
              $crearRol->ctrCrearRoles();

              ?>

            </form>

          </div>

        </div>

      </div>

      <!--=====================================
              MODAL EDITAR ROL --- FALTA CORREGIR LOS CONTROLADORES DE NUEVO Y EDITAR
      ======================================-->

      <div id="modalEditarRol" class="modal fade" role="dialog">

        <div class="modal-dialog">

          <div class="modal-content">

            <form role="form" method="post">

              <!--=====================================
                      CABEZA DEL MODAL
              ======================================-->

              <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Editar Rol</h4>

              </div>

              <!--=====================================
                      CUERPO DEL MODAL
              ======================================-->

              <div class="modal-body">

                <div class="box-body">

                  <!-- ENTRADA PARA LA DESCRIPCION DEL ROL -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon">Rol: </span>

                      <input type="hidden" class="form-control input-lg" name="idRol" id="idRol">
                      <input type="text" class="form-control input-lg" name="editarRol" id="editarRol" required>

                    </div>

                  </div>

                </div>

              </div>

              <!--=====================================
                      PIE DEL MODAL
              ======================================-->

              <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary">Actualizar Rol</button>

              </div>

              <?php

              $editarRol = new ControladorRoles();
              $editarRol->ctrEditarRoles();

              ?>

            </form>

          </div>

        </div>

      </div>