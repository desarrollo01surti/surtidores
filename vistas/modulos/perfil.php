<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if($value["nombre"] == "Perfiles" && $value["activo"] == 1){

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
      Gestor Perfiles
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Perfiles</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

      <!--=====================================
      BLOQUE 1
      ======================================-->

      <?php

        /*=============================================
        ADMINISTRACIÓN PERFILES
        =============================================*/

        include "usuario/nuevo-perfil.php";

        /*=====================================
        ADMINISTRAR COLORES
        ======================================*/

        // include "comercio/colores.php";


      ?>

      </div>


      <div class="col-xs-12">

      <!--=====================================
      BLOQUE 2
      ======================================-->

        <?php

        /*=============================================
        LISTA PERFILES
        =============================================*/

        include "usuario/lista-perfil.php";


        ?>

      </div>

    </div>

  </section>

</div>
