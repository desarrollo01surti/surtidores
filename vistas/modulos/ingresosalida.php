<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Ingresos y Salidas" && $value["activo"] == 1) {

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

      Reporte de Ingresos y salidas por Proveedor

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Reporte de Ingresos y salidas</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Primer Bimestre</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Segundo Bimestre</a></li>
                    <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                      <?php

                      include "ingsalidas/primeramitad.php";

                      ?>

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">

                      <?php

                      include "ingsalidas/segundamitad.php";

                      ?>

                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
              </div>

      </div>

    <!-- <div class="box"> -->

      <!-- Combobox de Proveedores -->
      <!-- <div class="box-header with-border">
        <div class="row">
          <div class="col-xs-6" id="selectProve">

          </div>
        </div>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaIngresoSalida">

          <thead>

            <tr>

              <th rowspan="2" style="width:10px">#</th>
              <th rowspan="2">Codigo</th>
              <th rowspan="2">Proveedor</th>
              <th rowspan="2">Descripcion</th>
              <th colspan="2">Enero</th>
              <th colspan="2">Febrero</th>
              <th colspan="2"><center>Marzo</center></th>
              <th colspan="2">Abril</th>
              <th colspan="2">Mayo</th>
              <th colspan="2">Junio</th>
              <th colspan="2">Julio</th>
              <th colspan="2">agosto</th>
              <th colspan="2">setiembre</th>
              <th colspan="2">octubre</th>
              <th colspan="2">noviembre</th>
              <th colspan="2">diciembre</th>

            </tr>

            <tr>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
              <th>ING.</th>
              <th>SAL.</th>
            </tr>

          </thead>

          <tbody>

          </tbody>

        </table>

      </div>

    </div> -->

  </section>

</div>
