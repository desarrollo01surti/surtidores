<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Reporte Movimientos" && $value["activo"] == 1) {

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

      Reporte de Movimientos de Importación por Proveedor

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Reporte de Movimientos</li>

    </ol>

  </section>

  <section class="content">

     <?php

         // include "reportes/movimientos-importaciones.php";

         include "reportes/movimientos-im.php";

      ?>

  </section>

</div>
