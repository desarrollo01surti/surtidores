<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Modulos" && $value["activo"] == 1) {

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
      Gestor Modulos
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Modulos</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Nivel 1</a></li>
            <li><a href="#tab_2" data-toggle="tab">Nivel 2</a></li>
            <li><a href="#tab_3" data-toggle="tab">Nivel 3</a></li>
            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

              <?php

              include "modulo/nivel1.php";

              ?>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2">

              <?php

              include "modulo/nivel2.php";

              ?>

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">

              <?php

              include "modulo/nivel3.php";

              ?>

            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
      </div>

    </div>

  </section>

</div>