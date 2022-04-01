<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Reclamos de la Web" && $value["activo"] == 1) {

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
      Gestor de Libro de Reclamación Virtual
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Reclamos</li>

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

            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">

              Agregar Empleado

            </button> -->

          </div>

          <div class="box-body">

            <?php

            $id_user = $_SESSION["idUsuario"];

            //consultar ROL ADMINISTRADOR RECLAMO
            $AdministradorReclamo = ControladorRoles::ctrMostrarRolesAsignado('5', $id_user);

            // if ($AdministradorReclamo) { //VALIDAR LAS TABLAS POR SUPERVIDOR Y USUARIO ASIGNADO

            echo '<table class="table table-bordered table-striped dt-responsive tablaReclama" width="100%">';
            // } else {

            //   echo '<table class="table table-bordered table-striped dt-responsive tablaReclamaAsig" width="100%">';
            // }

            ?>

            <thead>

              <tr>

                <th style="width:10px">#</th>
                <th>Codigo</th>
                <th>Nombres</th>
                <th>Documento</th>
                <th>Telefono</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Fecha</th>
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
       MODAL VER RECLAMO
======================================-->
<div id="modalVerReclamo" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

      <div class="modal-header" style="background:#3c8dbc; color:white">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">PREVISUALIZAR RECLAMO</h4>

      </div>

      <!--=====================================
                CUERPO DEL MODAL
        ======================================-->

      <div class="modal-body">

        <div class="box-body">

          <section class="invoice">
            <!-- COLUMNA DE TITULO -->
            <div class="row">

              <div class="col-xs-12">

                <h1 class="page-header">
                  <b id="codReclamo"></b>
                  <small class="pull-right" id="fechaReclamo"></small>
                </h1>

              </div>
              <!-- /.col -->
            </div>

            <!-- /.row -->

            <!-- INICIO DE FORMULACIO DE INFORMACION -->
            <div class="row">
              <div class="col-md-12" style="background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
                1. IDENTIFICACIÓN DEL CONSUMIDOR RECLAMANTE
              </div>
            </div>

            <br>

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">

              <div class="row">

                <label class="control-label col-sm-2" for="nombre" style="text-align: left; font-size: 15px;">NOMBRE:</label>
                <div class="input-group col-sm-10">
                  <input type="text" class="form-control input-sm" id="nombReclamo" name="nombReclamo" readonly>
                </div>

              </div>

            </div>


            <!-- ENTRADA PARA EL DOMICILIO -->
            <div class="form-group">

              <div class="row">

                <label class="control-label col-sm-2" for="domicilio" style="text-align: left; font-size: 15px;">DOMICILIO:</label>
                <div class="input-group col-sm-10">
                  <input type="text" class="form-control input-sm" id="domicilio" name="domicilio" readonly>
                </div>

              </div>

            </div>

            <div class="form-group">

              <div class="row">

                <label class="control-label col-sm-2" for="dni" style="text-align: left; font-size: 15px;">DNI/CE:</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control input-sm" id="NroDoc" name="NroDoc" readonly>
                </div>

                <label class="control-label col-sm-1" for="telf" style="text-align: left; font-size: 15px;">TELEF:</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control input-sm" id="telfReclamo" name="telfReclamo" readonly>
                </div>

                <label class="control-label col-sm-1" for="email" style="text-align: left; font-size: 15px;">EMAIL:</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control input-sm" id="email" name="email" readonly>
                </div>

              </div>

            </div>

            <div class="row">
              <div class="col-md-12" style="background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
                2. IDENTIFICACIÓN DEL BIEN CONTRATADO
              </div>
            </div>

            <br>

            <div class="form-group">

              <div class="row">

                <div class="col-sm-2 radio">
                  <label style="font-size: 15px"><b><input type="radio" id="optradioP" name="optradioP" value="PRODUCTO" disabled>PRODUCTO</b></label>
                </div>

                <label class="control-label col-sm-2" for="monto" style="text-align: left; font-size: 15px;">MONTO RECLAMADO:</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control input-sm" id="monto" name="monto" readonly>
                </div>

              </div>


            </div>

            <div class="form-group">

              <div class="row">

                <div class="col-sm-2 radio">
                  <label style="font-size: 15px"><b><input type="radio" id="optradioS" name="optradioS" value="SERVICIO" disabled>SERVICIO</b></label>
                </div>

                <label class="control-label col-sm-2" for="descripcion" style="text-align: left; font-size: 15px;">DESCRIPCION:</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control input-sm" id="descripcion" name="descripcion" readonly>
                </div>

              </div>

            </div>

            <div class="form-group">

              <div class="row">

                <div class="col-md-8" style="background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
                  3. DETALLE DE LA RECLAMACIÓN Y PEDIDO DEL CONSUMIDOR
                </div>


                <div class="col-md-2">
                  <label style="font-size: 15px"><b><input type="radio" id="optradioTR" name="optradioTR" value="RECLAMO" disabled>RECLAMO<sup>1</sup></b></label>
                </div>

                <div class="col-md-2" style="margin-top: none;">
                  <label style="font-size: 15px;"><b><input type="radio" id="optradioTQ" name="optradioTQ" value="QUEJA" disabled>QUEJA<sup>2</sup></b></label>
                </div>


              </div>

            </div>

            <br>

            <div class="form-group">

              <div class="row">

                <div class="col-md-12">
                  <textarea class="form-control input-sm as_required" id="detalle" name="detalle" rows="5" readonly></textarea>
                </div>

                <br>

                <div class="col-md-12">
                  <textarea class="form-control input-sm as_required" id="pedido" name="pedido" rows="4" readonly></textarea>
                </div>

              </div>

            </div>

            <br>

            <div class="row">
              <div class="col-md-12" style="background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
                4. OBSERVACIONES Y ACCIONES ADOPTADAS POR EL PROVEEDOR
              </div>
            </div>

            <br>

            <div class="form-group">

              <div class="row">
                <label class="control-label col-sm-4" for="fechaResp" style="text-align: left; font-size: 15px;">FECHA DE COMUNICACIÓN DE LA RESPUESTA:</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control input-sm" id="fechaResp2" name="fechaResp2" readonly>
                </div>

              </div>

            </div>

            <div class="form-group">

              <div class="row">

                <div class="col-md-12">
                  <textarea readonly class="form-control input-sm" rows="4" placeholder="" id="respReclamo2" name="respReclamo2"></textarea>
                </div>

              </div>

            </div>

          </section>

        </div>

      </div>

      <!--=====================================
                PIE DEL MODAL
        ======================================-->

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

      </div>

    </div>

  </div>

</div>


<!--=====================================
       MODAL RESPONDER RECLAMO
======================================-->
<div id="modalRespuestaReclamo" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="formRespReclamo">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Responder Reclamo</h4>

        </div>

        <!--=====================================
                CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <section class="invoice">

              <!-- COLUMNA DE TITULO -->
              <div class="row">

                <div class="col-xs-12">

                  <h1 class="page-header">
                    <b id="codReclamo2"></b>
                    <input type="hidden" name="codReclamacion2" id="codReclamacion2">
                    <input type="hidden" name="idUsua" id="idUsua">
                  </h1>

                </div>
                <!-- /.col -->
              </div>

              <!-- /.row -->

              <div class="row">
                <div class="col-md-12" style="background-color: #bebebe; padding-top: 7px!important; padding-bottom: 7px!important;">
                  4. OBSERVACIONES Y ACCIONES ADOPTADAS POR EL PROVEEDOR
                </div>
              </div>

              <br>

              <div class="form-group">

                <?php
                date_default_timezone_set('America/Lima');

                $fecha = date('d/m/Y');
                ?>

                <div class="row">
                  <label class="control-label col-sm-4" for="fechaResp" style="text-align: left; font-size: 15px;">FECHA DE COMUNICACIÓN DE LA RESPUESTA:</label>
                  <div class="col-sm-3">
                    <label class="control-label col-sm-4" id="fechaResp" style="text-align: left; font-size: 15px;"><?php echo $fecha; ?></label>
                    <!-- <input type="text" class="form-control input-sm" id="fechaResp" name="fechaResp" required> -->
                  </div>

                </div>

              </div>

              <div class="form-group">

                <div class="row">

                  <div class="col-md-12">
                    <textarea required class="form-control input-sm" rows="4" placeholder="" id="respReclamo" name="respReclamo"></textarea>
                  </div>

                </div>

              </div>

            </section>

          </div>

        </div>

        <!--=====================================
                PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary" id="btnGuardarReclamo">Responder Reclamo</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
    MODAL ASIGNAR RESPONSABLE DE RECLAMO
======================================-->

<div id="modalAsginarReclamo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Responsable de Reclamo</h4>

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

                <input type="hidden" id="codigoRecla" name="codigoRecla" value="">

                <select class="form-control input-lg" id="seleccionarTrabajArea" name="seleccionarAreaReclamo" required>

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

                <select class="form-control input-lg" id="muestraTrabajadorAjax" name="muestraTrabajadorReclamo" required>


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

        $AsignarReclamo = new ControladorConsultaReclamos();
        $AsignarReclamo->ctrAsignarReclamo();

        ?>

      </form>

    </div>

  </div>

</div>