<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Usuario" && $value["activo"] == 1) {

    $existe = "si";
  }
}

if ($existe != "si") {

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Gestor Usuarios
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="row" id="tablaUsuario">

      <div class="col-xs-12">

        <!--=====================================
        PANEL LISTA DE USUARIOS
        ======================================-->
        <div class="box box-success">

          <div class="box-header with-border">

            <button class="btn btn-primary" id="AddUsuarioNuevo">

              Agregar Usuario

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaUsuario" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Area</th>
                  <th>Trabajador</th>
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

      </div>

    </div>

    <div class="row" id="verAgregarUsuario" style="display: none;">

      <form role="form" method="post" onsubmit="return registroSucursal()">

        <div class="col-xs-6">

          <!--=====================================
          PANEL LISTA DE USUARIOS
          ======================================-->
          <div class="box box-success">

            <div class="box-header with-border">

              <h4 class="modal-title">Datos Usuario</h4>

            </div>

            <div class="box-body">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA EL TRABAJADOR -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-btn">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalBuscarTrabajador"><i class="fa fa-search"></i></button>
                      </span>

                      <input type="text" class="form-control" name="nuevoTrabajador" id="nuevoTrabajador" placeholder="Seleccione Trabajador" required autofocus disabled>
                      <input type="hidden" class="form-control" name="nuevoidTrabajador" id="nuevoidTrabajador">

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA EL PERFIl -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <select class="form-control" id="seleccionaPerfil" name="seleccionaPerfil" required disabled>

                      </select>

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA EL USUARIO -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <input type="text" class="form-control" name="nuevoUsuario" id="nuevoUsuario" placeholder="Usuario" required>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA LA CONTRASEÑA -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <input type="text" class="form-control" name="nuevoPassword" id="nuevoPassword" placeholder="Contraseña" required>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="col-xs-6">

          <!--=====================================
          PANEL LISTA DE USUARIOS
          ======================================-->
          <div class="box box-success">

            <div class="box-header with-border">

              <h4 class="modal-title">Elegir Sucursales</h4>

            </div>

            <div class="box-body">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <select class="form-control" id="seleccionaEmpresa" name="seleccionaEmpresa" required>

                        <option value="0">Selecionar Empresa</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

                        foreach ($empresas as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                        }

                        ?>

                      </select>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA SELECCIONAR SUCURSAL"-->

                  <div class="form-group">

                    <div class="input-group" id="selectSucursales">

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="form-group permission-list">

                  <div class="col-sm-6">

                    <h4>
                      <input type="checkbox" class="sucursal" id="sucursales_action" nombre="principal" activate="0" onclick="$('.sucursal').prop('checked', this.checked);">
                      <label for="sucursales_action"> SUCURSALES </label>
                    </h4>

                    <div class="well well-sm permission-well datacheck" id="datacheck">

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left">

                  <input type="hidden" class="form-control" id="valorSucursal" name="valorSucursal">

                </div>

              </div>

              <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">

                  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar Usuario</button>

                  <a href="usuario" class="btn btn-danger"><i class="fa fa-remove"></i> Cancelar</a>

                </div>

              </div>

            </div>

          </div>

        </div>

        <?php

        $crearUsuario = new ControladorUsuario();
        $crearUsuario->ctrCrearUsuario();

        ?>

      </form>

    </div>

    <div class="row" id="verEditarUsuario" style="display: none;">

      <form role="form" method="post" onsubmit="return registroSucursal()">

        <div class="col-xs-6">

          <!--=====================================
          PANEL LISTA DE USUARIOS
          ======================================-->
          <div class="box box-success">

            <div class="box-header with-border">

              <h4 class="modal-title">Datos Usuario</h4>

            </div>

            <div class="box-body">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA EL TRABAJADOR -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-btn">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalBuscarTrabajador" disabled><i class="fa fa-search"></i></button>
                      </span>

                      <input type="text" class="form-control" name="editarTrabajador" id="editarTrabajador" placeholder="Seleccione Trabajador" required autofocus disabled>
                      <input type="hidden" class="form-control" name="editaridTrabajador" id="editaridTrabajador">

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA EL PERFIl -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <select class="form-control" id="seleccionaeditarPerfil" name="seleccionaeditarPerfil" required disabled>

                        <?php

                        $item = "idarea";
                        $valor = $_SESSION["idArea"];

                        $perfiles = ControladorPerfiles::ctrMostrarPerfilesArea($item, $valor);

                        echo '<option value="">Selecionar Perfil</option>';


                        foreach ($perfiles as $key => $value) {

                          echo '<option value="' . $value["idperfil"] . '">' . $value["descripcion"] . '</option>';
                        }
                        ?>

                      </select>

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA EL USUARIO -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" required>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA LA CONTRASEÑA -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <input type="text" class="form-control" name="editarPassword" id="editarPassword" required>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="col-xs-6">

          <!--=====================================
          PANEL SELECCIONAR EMPRESA Y SUCURSAL
          ======================================-->
          <div class="box box-success">

            <div class="box-header with-border">

              <h4 class="modal-title">Elegir Sucursales</h4>

            </div>

            <div class="box-body">

              <div class="row">

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

                  <div class="form-group">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <select class="form-control" id="seleccionaEmpresa" name="seleccionaEmpresa" required>

                        <option value="0">Selecionar Empresa</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

                        foreach ($empresas as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                        }

                        ?>

                      </select>

                    </div>

                  </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                  <!-- ENTRADA PARA SELECCIONAR SUCURSAL"-->

                  <div class="form-group">

                    <div class="input-group" id="selectSucursales">

                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="form-group permission-list">

                  <div class="col-sm-6">

                    <h4>
                      <input type="checkbox" class="sucursal" id="sucursales_action" nombre="principal" activate="0" onclick="$('.sucursal').prop('checked', this.checked);">
                      <label for="sucursales_action"> SUCURSALES </label>
                    </h4>

                    <div class="well well-sm permission-well datacheck" id="datacheck">


                    </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12 left">

                  <input type="hidden" class="form-control" id="valorSucursal" name="valorSucursal">

                </div>

              </div>

              <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 left">

                  <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar Usuario</button>

                  <a href="usuario" class="btn btn-danger"><i class="fa fa-remove"></i> Cancelar</a>

                </div>

              </div>

            </div>

          </div>

        </div>

        <?php

        // $crearUsuario = new ControladorUsuario();
        // $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

    </div>

  </section>

</div>

<!--=====================================
        MODAL AGREGAR TRABAJADOR
======================================-->

<div id="modalBuscarTrabajador" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
                CABEZA DEL MODAL
      ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Lista de Trabajadores</h4>

      </div>

      <!--=====================================
                CUERPO DEL MODAL
      ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <table class="table table-bordered table-striped dt-responsive tablaEmpleadoUser" width="100%">

            <thead>

              <tr>

                <th>Seleccione</th>
                <th style="width:10px">#</th>
                <th>Nombres</th>
                <th>Area</th>
                <th>Documento</th>
                <th>Correo</th>
                <th>Foto</th>

              </tr>

            </thead>

            <tbody>

            </tbody>

          </table>

        </div>

      </div>

      <!--=====================================
                PIE DEL MODAL
      ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Salir</button>

        <button type="button" class="btn btn-primary" id="btnAgregarEmpleado"><i class="fa fa-plus"></i> Agregar</button>

      </div>

    </div>

  </div>

</div>