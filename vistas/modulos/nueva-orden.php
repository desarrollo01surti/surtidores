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
            Nueva de Orden de Compra
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Nueva Orden de Compra</li>

        </ol>

    </section>

    <section class="content">

        <!--=====================================
        NUEVA ORDEN DE COMPRA
        ======================================-->

        <div class="row" id="verNuevaOrden">
            <!-- onsubmit="return registroOrden()" -->
            <form role="form" method="post">

                <div class="col-xs-12">

                    <div class="box box-success">

                        <div class="box-header with-border">

                            <h4 class="modal-title">Nueva Orden de Compra</h4>

                        </div>

                        <div class="box-body">

                            <div class="row">

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <h2>Detalles del proveedor :</h2>

                                    <!-- ENTRADA PARA EL PROVEEDOR -->

                                    <div class="form-group">

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control" id="seleccionarProveedor" name="seleccionarProveedor" required>

                                                <option value="0">Seleccionar Proveedor</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $empresas = ControladorProveedor::ctrMostrarProveedor($item, $valor);

                                                foreach ($empresas as $key => $value) {

                                                    echo '<option value="' . $value["id_proveedor"] . '">' . $value["razon_social"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>

                                        <h4>
                                            <span>Contacto: </span>
                                            <span id="contacto">
                                                -
                                            </span>
                                        </h4>

                                        <h4>
                                            <span>Telefono: </span>
                                            <span id="telefono">
                                                -
                                            </span>
                                        </h4>

                                        <h4>
                                            <span>Correo: </span>
                                            <span id="correo">
                                                -
                                            </span>
                                        </h4>

                                    </div>

                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 left">

                                    <h2>Detalles de la orden de compra :</h2>

                                    <!-- ENTRADA PARA DATOS DE LA ORDEN DE COMPRA -->

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <h4>
                                                <span>Orden N°: </span>
                                                <span id="nrorden">
                                                    <?php

                                                    $item = null;
                                                    $valor = null;

                                                    $cab = ControladorOrdenCompra::ctrMostrarOrdenCab($item, $valor);

                                                    date_default_timezone_set('America/Lima');
                                                    $año = date('Y');

                                                    if ($cab) {

                                                        $ordenValida = ControladorOrdenCompra::ctrMostrarUltimaOrden();
                                                        $separar = explode("-", $ordenValida["codigo"]);
                                                        $cod = $separar[0];
                                                        $nroOrden = ($cod + 1) . "-" . $año;
                                                        echo $nroOrden;
                                                    } else {

                                                        $nroOrden = "2400-" . $año;
                                                        echo $nroOrden;
                                                    }

                                                    ?>
                                                </span>
                                                <input type="hidden" value="<?php echo $nroOrden; ?>">
                                            </h4>

                                        </div>

                                        <div class="col-lg-6">

                                            <h4>
                                                <span>Fecha: </span>
                                                <span id="fecha">
                                                    <?php echo date("d/m/Y"); ?>
                                                </span>
                                            </h4>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-lg-6">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                                    <select class="form-control" id="seleccionarVia" name="seleccionarVia" required>

                                                        <option value="0">Seleccionar Via</option>

                                                        <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $vias = ControladorOrdenCompra::ctrMostrarVia($item, $valor);

                                                        foreach ($vias as $key => $value) {
                                                            echo '<option value="' . $value["id_via"] . '">' . $value["via_esp"] . '</option>';
                                                        }

                                                        ?>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                                    <select class="form-control" id="seleccionarIdioma" name="seleccionarIdioma" required>

                                                        <option value="0">Seleccionar Idioma</option>
                                                        <option value="es">Español</option>
                                                        <option value="en">Ingles</option>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <hr>

                                <div class="col-lg-6 col-md-6 col-sm-6">

                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalProductos"><span class="glyphicon glyphicon-plus"></span> Agregar Producto</button>

                                </div>
                            </div>

                            <div class="row">

                                <hr>

                                <div class="col-lg-12 col-md-12 col-sm-12">

                                    <div class="table-responsive">

                                        <table class="table table-striped table-hover dt-responsive" id="tablaOrdenProdu">

                                            <thead>

                                                <tr style="background-color:#c0392b;color:white;">

                                                    <th class='text-center'>CANTIDAD</th>
                                                    <th class='text-center'>CODIGO</th>
                                                    <th class='text-center'>N° PARTE</th>
                                                    <th class='text-center'>DESCRIPCION</th>
                                                    <th class='text-right'>P.U.</th>
                                                    <th class='text-right'>TOTAL</th>
                                                    <th class='text-center'>ACCIONES</th>

                                                </tr>

                                            </thead>

                                            <tbody id='items'>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <hr>

                                <div class="col-lg-10 col-md-10">

                                </div>

                                <div class="col-lg-2 col-md-2">
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6">
                                            <h4>TOTAL</h4>
                                        </div>

                                        <div class="col-lg-6 col-md-6">
                                            <h4 id="totalMonto">0.00</h4>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

        <!--=====================================
        MODAL AGREGAR PRODUCTOS
        ======================================-->
        <div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="modalProductos">

            <div class="modal-dialog modal-lg">

                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Nuevo Ítem</h4>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-12">

                                <label>Codigo Producto</label>
                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="seleccionarProdProv" name="seleccionarProdProv">

                                </select>
                                <hr>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <label>Descripción del producto</label>
                                <input type="hidden" class="form-control" id="ID_prod" name="ID_prod">
                                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label>Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad" required>
                            </div>

                            <div class="col-md-4">
                                <label>Nro Parte</label>
                                <input type="text" class="form-control" id="nroparte" name="nroparte" required>
                            </div>

                            <div class="col-md-2">
                                <label>Moneda</label>
                                <input type="text" class="form-control" id="moneda" name="moneda" required>
                            </div>

                            <div class="col-md-3">
                                <label>Precio unitario</label>
                                <input type="text" class="form-control" id="precio" name="precio" required>
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-info" id="btnAddProducto" idProdu=""><i class="fa fa-plus"></i> Agregar</button>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>