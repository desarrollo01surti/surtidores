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

<div class="content-wrapper">

  <section class="content-header">

    <h1>
      Gestor de Tickets
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tickets</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

        <div class="col-md-12">

           <?php

                include "tickets/tabla.php";

            ?>

        </div>

    </div>

  </section>

</div>
