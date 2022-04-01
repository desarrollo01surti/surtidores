<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Empresa" && $value["activo"] == 1) {

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
      Gestor Empresas
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Empresas</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <!--=====================================
        PANEL LISTA DE EMPRESAS
        ======================================-->
        <div class="box box-success">

          <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpresa">

              Agregar Empresa

            </button>

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaEmpresas" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>RUC</th>
                  <th>Logo</th>
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
        MODAL AGREGAR EMPRESA
======================================-->

<div id="modalAgregarEmpresa" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empresa</h4>

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

                $empresa = ControladorEmpresas::ctrMostrarEmpresas($item, $valor);

                if (!$empresa) {

                  echo '<input type="text" class="form-control input-lg" id="nuevaEmpresa" name="nuevaEmpresa" value="1001" readonly>';
                } else {

                  foreach ($empresa as $key => $value) {
                  }

                  $codigo = $value["codigo"] + 1;



                  echo '<input type="text" class="form-control input-lg" id="nuevaEmpresa" name="nuevaEmpresa" value="' . $codigo . '" readonly>';
                }

                ?>


              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO RUC -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="1" max="99999999999" class="form-control input-lg" name="nuevoRUC" id="nuevoRUC" placeholder="Ingresar RUC" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaRazonSocial" placeholder="Ingresar Razon Social" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

            <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImgEmpresa" name="nuevaImgEmpresa">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/empresas/default/empresa.png" class="img-thumbnail previsualizarEmpresa" width="100px">

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

        $crearEmpresa = new ControladorEmpresas();
        $crearEmpresa->ctrCrearEmpresa();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
        MODAL EDITAR EMPRESA
======================================-->

<div id="modalEditarEmpresa" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Empresa</h4>

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

                <input type="text" class="form-control input-lg" id="editarEmpresa" name="editarEmpresa" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO RUC -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" min="1" max="99999999999" class="form-control input-lg" name="editarRUC" id="editarRUC" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarRazonSocial" id="editarRazonSocial" required>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR LOGO -->

            <div class="form-group">

              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImgEmpresa" name="nuevaImgEmpresa">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/empresas/default/empresa.png" class="img-thumbnail previsualizarEmpresa" width="100px">

              <input type="hidden" name="fotoActualEmp" id="fotoActualEmp">

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

        $editarEmpresa = new ControladorEmpresas();
        $editarEmpresa->ctrEditarEmpresa();

        ?>

      </form>

    </div>

  </div>

</div>
