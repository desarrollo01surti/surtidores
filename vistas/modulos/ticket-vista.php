<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Tickets" && $value["activo"] == 1) {

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

<div class="content-wrapper" style="min-height: 1058.31px;">

  <section class="content-header">

      <h1>Gestión de Ticket</h1>

      <ol class="breadcrumb">

          <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

          <li class="active">Gestion de Ticket</li>

      </ol>

  </section>

  <section class="content">

        <div class="row">

          <div class="col-md-9">

             <?php

               //PANEL SUPERIOR (INFORMACION GENERAL)

                include "tickets/info.php";

              ?>

          </div>

          <div class="col-md-9">

            <?php

            //PANEL INFERIOR (INFORMACION TIMELINE)

            include "tickets/timeline.php";

            ?>

          </div>

        </div>

  </section>

</div>
