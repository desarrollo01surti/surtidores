      <!--=====================================
      PANEL LISTA DE ROLES
      ======================================-->
      <div class="box box-success">

        <div class="box-header with-border">

          <h4 class="box-title">

            <a data-toggle="collapse" data-parent="#accordion" href="#listagrupo" class="collapsed" aria-expanded="false">
              LISTA DE PERFILES
            </a>

          </h4>

        </div>

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaPerfiles" width="100%">

            <thead>

              <tr>

                <th style="width:10px">#</th>
                <th>Area</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Acciones</th>

              </tr>

            </thead>

            <tbody>

            </tbody>

          </table>

        </div>


      </div>


      <!--=====================================
      MODAL DE PERMISOS DEL SISTEMA
      ======================================-->
      <div class="modal fade" id="modalAccesoPermisos" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">PERMISOS DEL SISTEMA</h4>
            </div>
            <div class="modal-body">

              <form class="form-horizontal" method="post" role="form" onsubmit="return registroPermiso()">

                <div class="box-body">

                  <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">
                      AREA </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="areaPe" name="areaPe" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="slug" class="col-sm-3 control-label">
                      PERFIL
                    </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="perfilDa" name="perfilDa" disabled>
                    </div>
                  </div>

                  <hr>

                  <div class="form-group mb-0">
                    <div class="col-sm-12">
                      <h4 class="pull-left">
                        <b> Accesos</b>
                      </h4>
                      <button type="submit" class="btn btn-info btn-lg pull-right user-group-update">
                        <span class="fa fa-fw fa-pencil"></span>
                        ACTUALIZAR </button>
                    </div>
                  </div>

                  <hr>


                  <div class="form-group permission-list">

                    <div class="col-sm-6">

                      <h4>
                        <input type="checkbox" class="permisos" id="accesos_action" nombre="principal" onclick="$('.permisos').prop('checked', this.checked);">
                        <label for="accesos_action">
                          Accesos </label>
                      </h4>

                      <div class="well well-sm permission-well datacheck" id="datacheck">


                      </div>

                    </div>

                  </div>

                </div>

                <div class="box-footer">

                  <div class="form-group">

                    <input type="hidden" class="form-control" id="valorPermiso" name="valorPermiso">
                    <input type="hidden" class="form-control" id="idPe" name="idPe">

                  </div>

                </div>

                <?php

                $permisos = new ControladorPermisos();
                $permisos->ctrActualizarPermisos();

                ?>

              </form>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

          </div>

        </div>

      </div>


      <!--=====================================
      MODAL DE ACCESOS A MODULOS DEL SISTEMA
      ======================================-->
      <div class="modal fade" id="modalAccesoModulos" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">MODULOS DEL SISTEMA</h4>
            </div>
            <div class="modal-body">

              <form class="form-horizontal" method="post" role="form" onsubmit="return registroModuloAcceso()">

                <div class="box-body">

                  <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">
                      AREA </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="areaPerf" name="areaPerf" disabled>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="slug" class="col-sm-3 control-label">
                      PERFIL
                    </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="perfilDat" name="perfilDat" disabled>
                    </div>
                  </div>

                  <hr>

                  <div class="form-group mb-0">
                    <div class="col-sm-12">
                      <h4 class="pull-left">
                        <b> Accesos</b>
                      </h4>
                      <button type="submit" class="btn btn-info btn-lg pull-right user-group-update">
                        <span class="fa fa-fw fa-pencil"></span>
                        ACTUALIZAR </button>
                    </div>
                  </div>

                  <hr>


                  <div class="form-group permission-list dataModCheck" id="dataModCheck">


                  </div>

                </div>

                <div class="box-footer">

                  <div class="form-group">

                    <input type="text" class="form-control" id="valorPerfil" name="valorPerfil">
                    <input type="text" class="form-control" id="idP" name="idP">

                  </div>

                </div>

                <?php

                $accesos = new ControladorPerfiles();
                $accesos->ctrActualizarAccesos();

                ?>

              </form>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

          </div>

        </div>

      </div>