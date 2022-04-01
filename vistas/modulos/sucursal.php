<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if($value["nombre"] == "Sucursal" && $value["activo"] == 1){

     $existe = "si";

  }

}

if($existe != "si"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Gestor Sucursales
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Sucursales</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <!--=====================================
        PANEL LISTA DE SUCURSALES
        ======================================-->
        <div class="box box-success">

          <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSucursal">

              Agregar Sucursal

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaSucursal" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Empresa</th>
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

  </section>

</div>

<!--=====================================
        MODAL AGREGAR SUCURSAL
======================================-->

<div id="modalAgregarSucursal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Sucursal</h4>

        </div>

        <!--=====================================
                CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
                    ENTRADA DEL CÓDIGO
            ======================================-->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <?php

                        $item = null;
                        $valor = null;
                        $select = null;

                        $sucursal = ControladorSucursal::ctrMostrarSucursal($item, $valor, $select);

                        if(!$sucursal){

                          echo '<input type="text" class="form-control input-lg" id="nuevaSucursal" name="nuevaSucursal" value="1001" readonly>';


                        }else{

                          foreach ($sucursal as $key => $value) {



                          }

                          $codigo = $value["codigo"] + 1;



                          echo '<input type="text" class="form-control input-lg" id="nuevaSucursal" name="nuevaSucursal" value="'.$codigo.'" readonly>';


                        }

                        ?>


              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="seleccionaEmpresa" name="seleccionaEmpresa" required>

                  <option value="">Selecionar Empresa</option>

                  <?php

                          $item = null;
                          $valor = null;

                          $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

                          foreach ($empresas as $key => $value) {

                            echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                          }

                          ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION DE SUCURSAL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDescrip" placeholder="Ingresar Sucursal" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
                PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Empresa</button>

        </div>

        <?php

                  $crearSucursal = new ControladorSucursal();
                  $crearSucursal -> ctrCrearSucursal();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
        MODAL EDITAR SUCURSAL
======================================-->

<div id="modalEditarSucursal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Sucursal</h4>

        </div>

        <!--=====================================
                CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
                    ENTRADA DEL CÓDIGO
            ======================================-->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text" class="form-control input-lg" id="editarSucursal" name="editarSucursal" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="editSeleccionarEmpresa" name="editSeleccionarEmpresa" required>

                  <option value="" id="editSeleccEmpresa"></option>

                  <?php

                          $item = null;
                          $valor = null;

                          $empresas = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

                          foreach ($empresas as $key => $value) {

                            echo '<option value="'.$value["id"].'">'.$value["descripcion"].'</option>';
                          }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION DE SUCURSAL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarDescrip" id="editarDescrip" required>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
                PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Empresa</button>

        </div>

        <?php

                  $editarSucursal = new ControladorSucursal();
                  $editarSucursal -> ctrEditarSucursal();

        ?>

      </form>

    </div>

  </div>

</div>
