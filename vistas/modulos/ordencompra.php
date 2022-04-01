<?php

date_default_timezone_set("America/Lima");

$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

    if ($value["nombre"] == "Orden de Compra" && $value["activo"] == 1) {

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
            Gestor de Orden de Compra
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Gestor de Orden de Compra</li>

        </ol>

    </section>

    <section class="content">

        <!--=====================================
         PANEL LISTA DE ORDENES DE COMPRAS
        ======================================-->

        <div class="row" id="tablaOrden">

            <div class="col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border">

                        <a href="nueva-orden" class="btn btn-primary" id="AddNuevaOrden">

                            Nueva Orden

                        </a>

                    </div>

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaOrden" width="100%">

                            <thead>

                                <tr>

                                    <th style="width:100px">N° de Orden</th>
                                    <th>Proveedor</th>
                                    <th>Via</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
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