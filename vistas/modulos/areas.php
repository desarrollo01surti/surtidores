<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if($value["nombre"] == "Areas" && $value["activo"] == 1){

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
      Gestor Areas
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Areas</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

      <!--=====================================
      BLOQUE 1
      ======================================-->


      </div>


      <div class="col-xs-12">

      <!--=====================================
      BLOQUE 2
      ======================================-->

        <?php

        /*=============================================
        LISTA PERFILES
        =============================================*/

        include "usuario/lista-area.php";


        ?>

      </div>

    </div>

  </section>

</div>
