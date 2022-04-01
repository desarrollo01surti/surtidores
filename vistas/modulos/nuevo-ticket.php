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

            <li class="active">Nuevo Ticket</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-8">

                <div class="box box-primary box-outline">

                    <div class="box-header with-border">

                        <h3 class="box-title">Crear un nuevo Ticket</h3>

                    </div>

                    <form method="post" enctype="multipart/form-data">

                        <div class="box-body">

                            <!--=====================================
                            ENTRADA DEL CÓDIGO
                            ======================================-->
                            <?php

                            $tickets = ControladorTickets::ctrMostrarUltimoTicket();

                            if (!$tickets) {

                                echo '<input type="hidden" class="form-control" id="codigo" name="codigo" value="TK10001">';
                            } else {

                                $separado = explode("TK", $tickets["codigo"]);
                                $codigonum = $separado[1] + 1;
                                $codigoT = "TK" . $codigonum;

                                echo '<input type="hidden" class="form-control" id="codigo" name="codigo" value="' . $codigoT . '">';
                            }

                            ?>

                            <!--=====REMITENTE DEL MENSAJE======-->
                            <input type="hidden" class="form-control" value=" <?php echo $_SESSION["idUsuario"]; ?>" name="remitente">

                            <!--=====================================
                            DATOS DE LA EMPRESA EMISORA DEL TICKET
                            ======================================-->

                            <label>Medio de Atención</label>

                            <hr size="2px" color="#DFDFDF" />

                            <div class="input-group mb-3">

                                <span class="input-group-addon">Tipo de tienda: <FONT COLOR="red">(*)</FONT></span>

                                <select class="form-control" name="tienda" id="tienda" required>

                                    <option value="0">Seleccionar Tienda</option>
                                    <option value="Tienda Virtual">Tienda Virtual</option>
                                    <option value="Tienda Física">Tienda Física</option>

                                </select>

                            </div>

                            <hr size="2px" color="#DFDFDF" />

                            <!--=====================================
                            DATOS DE LA EMPRESA EMISORA DEL TICKET
                            ======================================-->

                            <label>Datos de su empresa</label>

                            <hr size="2px" color="#DFDFDF" />

                            <div class="input-group mb-3">

                                <span class="input-group-addon">RUC / DNI: <FONT COLOR="red">(*)</FONT></span>

                                <input type="text" class="form-control" name="ruc" required>

                            </div>

                            <br>

                            <div class="input-group mb-3">

                                <span class="input-group-addon">Razon Social / Nombre Completo: <FONT COLOR="red">(*)</FONT></span>

                                <input type="text" class="form-control" name="razonsoc" require>

                            </div>

                            <hr size="2px" color="#DFDFDF" />

                            <!--=====================================
                            DATOS DE CONTACTO DEL EMISOR DEL TICKET
                            ======================================-->

                            <label>Datos de contacto</label>

                            <hr size="2px" color="#DFDFDF" />

                            <div class="input-group mb-3">

                                <span class="input-group-addon">Email:</span>

                                <input type="text" class="form-control" name="email">

                                <span class="input-group-addon">Telefono: <FONT COLOR="red">(*)</FONT></span>

                                <input type="text" class="form-control" name="telefono" required>

                            </div>

                            <br>

                            <div class="input-group mb-3">

                                <span class="input-group-addon">Persona de contacto: <FONT COLOR="red">(*)</FONT></span>

                                <input type="text" class="form-control" name="contacto" required>

                            </div>

                            <hr size="2px" color="#DFDFDF" />

                            <!--=====================================
                            EL ASUNTO DEL TICKET
                            ======================================-->

                            <label>Descripcion</label>

                            <hr size="2px" color="#DFDFDF" />

                            <div class="input-group mb-3">

                                <span class="input-group-addon">Motivo: <FONT COLOR="red">(*)</FONT></span>

                                <select class="form-control" name="asunto" required>

                                    <option value="0">Seleccionar Motivo</option>
                                    <option value="Garantia">Garantia</option>
                                    <option value="Cambio y/o devolución">Cambio y/o devolución</option>
                                    <option value="Faltante">Faltante</option>
                                    <option value="Incumplimiento de Servicio">Incumplimiento de Servicio</option>
                                    <option value="Otros">Otros</option>

                                </select>

                            </div>

                            <br>

                            <div class="input-group mb-3">

                                <span class="input-group-addon">N° de Pedido/Factura:</span>

                                <input type="text" class="form-control" name="npedido">

                            </div>

                            <br>

                            <!--=====================================
                            EL MENSAJE DEL TICKET
                            ======================================-->

                            <div class="form-group">

                                <textarea class="form-control" id="editor" name="mensaje" cols="20" rows="5" style="width: 100%; resize: both;"></textarea>

                                <br>

                                <FONT COLOR="red">
                                    <h6>- (*) Campos requeridos</h6>

                                    <H6>- La descripcion es obligatoria</H6>
                                </FONT>
                                <br>

                                <!--=====================================
                                LOS ADJUNTOS DEL TICKET
                                ======================================-->

                                <div class="form-group my-2">

                                    <div class="btn btn-default btn-file">

                                        <i class="fa fa-paperclip"></i> Adjuntar

                                        <input type="file" class="subirAdjuntos" multiple>

                                        <input type="hidden" name="adjuntos" class="archivosTemporales">

                                    </div>

                                    <p class="help-block small">Archivos con peso máximo de 32MB</p>

                                </div>

                            </div>

                        </div>

                        <div class="box-footer">

                            <ul class="mailbox-attachments d-flex align-items-stretch clearfix">

                            </ul>

                            <div class="row">

                                <div class="col-xs-6">

                                    <a href="tickets" class="btn btn-default">

                                        <i class="fa fa-times"></i> Cancelar

                                    </a>

                                </div>

                                <div class="col-xs-6">

                                    <button type="submit" class="btn btn-primary" style="float: right;">

                                        <i class="fa fa-envelope"></i> Enviar

                                    </button>

                                </div>

                            </div>

                        </div>

                        <?php

                        $crearTicket = new ControladorTickets();
                        $crearTicket->ctrCrearTicket();

                        ?>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>