<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Prod. sin Movimientos" && $value["activo"] == 1) {

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

      Reporte de Productos sin Movimientos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Reporte productos sin movimientos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <!-- Combobox de Proveedores -->
      <div class="box-header with-border">
        <div class="row">
          <div class="col-xs-6">
          </div>
          <div class="col-xs-6">
            <button type="button" class="btn btn-default pull-right" id="btn-daterange">
                <span>
                    <i class="fa fa-calendar"></i> Rango de fecha
                </span>
                    <i class="fa fa-caret-down"></i>
             </button>
          </div>
        </div>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas">

          <thead>

            <tr>

              <th style="width:5px">#</th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Estado</th>

            </tr>

          </thead>

          <tbody>


            <?php

              if(isset($_GET["fechaInicial"])){

                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];

              }else{

                $fechaInicial = null;
                $fechaFinal = null;

              }

              $sinMov = ControladorMovimientosImp::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

              foreach ($sinMov as $key => $value) {

               echo '<tr>

                      <td>'.($key+1).'</td>

                      <td>'.$value["ID_prod"].'</td>';

                 echo'<td>'.$value["descripcion"].'</td>

                      <td><span class="label label-danger">'.$value["ventas"].'</span></td>

                    </tr>';
                }

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>
