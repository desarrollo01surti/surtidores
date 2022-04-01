<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Stock Productos" && $value["activo"] == 1) {

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

      Stock actual de productos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Stock de productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <!-- Combobox de Proveedores -->
      <div class="box-header with-border">
        <div class="row">
          <div class="col-xs-6" id="selectProve">

          </div>
        </div>
      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaStock">

          <thead>

            <tr>

              <th style="width:5px">#</th>
              <th>Codigo</th>
              <th>Proveedor</th>
              <th>Descripcion</th>
              <th>Stock total</th>
              <th>Tienda</th>
              <th>Planta</th>
              <th>Cam. 016</th>
              <th>Cam. 004</th>
              <th>Cam. 005</th>
              <th>Cam. 009</th>

            </tr>

          </thead>

          <tbody>

          </tbody>

        </table>

      </div>

    </div>

  </section>

</div>
