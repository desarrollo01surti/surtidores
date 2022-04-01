<?php
//DEVOLVER DATA DEL TICKET
$item2 = "codigo";
$valor2 = $_GET["cod"];

$VerTicket = ControladorTickets::ctrMostrarTicketsDatos($item2, $valor2);

//DEVOLVER DATA DE USUARIO DEL TICKET

if ($VerTicket["remitente"] == 0) {

  $usuario = "Registrado por Recepción";
} else {

  $itemUs = "id";
  $valorUs = $VerTicket["remitente"];

  if ($VerTicket["tipo_remitente"] == "cliente") {

    $itemUs = "id";
    $valorUs = $VerTicket["remitente"];
    $usr = ControladorUsuario::ctrMostrarUsuariosTick($itemUs, $valorUs);
    $usuario = $usr["nombres"];
  } else {

    $itemUs = "idusuario";
    $valorUs = $VerTicket["remitente"];
    $usr = ControladorUsuario::ctrMostrarUsuariosFiltro($itemUs, $valorUs);
    $usuario = $usr["usuario"];
  }
}



/*=============================================
  USUARIO ASIGNADO AL TICKET
=============================================*/

if ($VerTicket["asignado"] == 0) {

  $asignado = "Sin Asignar";
} else {

  $it = "idusuario";
  $val = $VerTicket["asignado"];
  $us = ControladorUsuario::ctrMostrarUsuariosFiltro($it, $val);

  $asignado = $us["usuario"];
}

/*=============================================
  ULTIMA ACTUALIZACION
=============================================*/
if ($VerTicket["fecha_update"] == null) {

  $fechaupdate = "-";
} else {

  //conociendo fecha en letras
  $dias = array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');
  $dia = $dias[date('w', strtotime($VerTicket["fecha_update"]))];
  //Conociendo meses en letras
  $num = date("j", strtotime($VerTicket["fecha_update"]));
  $anno = date("Y", strtotime($VerTicket["fecha_update"]));
  $mes = array('ener', 'febr', 'marz', 'abril', 'mayo', 'jun', 'jul', 'ago', 'sept', 'oct', 'nov', 'dic');
  $mes = $mes[(date('m', strtotime($VerTicket["fecha_update"])) * 1) - 1];
  $fechaAct = $dia . ', ' . $num . ' de ' . $mes . ' del ' . $anno;

  $fechaupdate = $fechaAct;
}

/*=============================================
  FECHA DE REGISTRO
=============================================*/

//conociendo fecha en letras
$dias = array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');
$dia = $dias[date('w', strtotime($VerTicket["fecha_soporte"]))];
//Conociendo meses en letras
$num = date("j", strtotime($VerTicket["fecha_soporte"]));
$anno = date("Y", strtotime($VerTicket["fecha_soporte"]));
$mes = array('ener', 'febr', 'marz', 'abril', 'mayo', 'jun', 'jul', 'ago', 'sept', 'oct', 'nov', 'dic');
$mes = $mes[(date('m', strtotime($VerTicket["fecha_soporte"])) * 1) - 1];
$fechaActua = $dia . ', ' . $num . ' de ' . $mes . ' del ' . $anno;

$fechasopor = $fechaActua;

?>

<div class="box box-primary">

  <div class="box-header with-border">

    <h3 class="box-title">Ticket N° <?php echo $valor2; ?></h3>

    <a href="tickets" class="btn btn-danger" style="float: right;"><i class="fa fa-reply"></i>
      Volver
    </a>

  </div>

  <div class="box-body">

    <div class="row">

      <div class="col-12 col-md-12">

        <h3 class="text-primary"><i class="fa fa-cogs"></i> <?php echo $VerTicket["asunto"]; ?></h3>

        <p class="text-muted"><?php echo $VerTicket["mensaje"]; ?></p>

        <br>

        <div class="text-muted">

          <div class="row">

            <div class="col-12 col-md-4">

              <p class="text-lg">Usuario:
                <b class="d-block"><?php echo $usuario; ?></b>
              </p>

              <p class="text-lg">Asignado:
                <b class="d-block"><?php echo $asignado; ?></b>
              </p>

              <p class="text-lg">Estado:
                <b class="d-block"><?php echo $VerTicket["estado"]; ?></b>
              </p>

              <p class="text-lg">Fecha Registro:
                <b class="d-block"><?php echo $fechasopor; ?></b>
              </p>

              <p class="text-lg">Fecha Ultima Respuesta:
                <b class="d-block"><?php echo $fechaupdate; ?></b>
              </p>

            </div>

            <div class="col-12 col-md-4">

              <p class="text-lg">RUC:
                <b class="d-block"><?php echo $VerTicket["ruc"]; ?></b>
              </p>

              <p class="text-lg">Razon Social:
                <b class="d-block"><?php echo $VerTicket["razonsoc"]; ?></b>
              </p>

              <p class="text-lg">Email:
                <b class="d-block"><?php echo $VerTicket["email"]; ?></b>
              </p>

            </div>

            <div class="col-12 col-md-4">

              <p class="text-lg">Telefono:
                <b class="d-block"><?php echo $VerTicket["telefono"]; ?></b>
              </p>

              <p class="text-lg">Contacto:
                <b class="d-block"><?php echo $VerTicket["contacto"]; ?></b>
              </p>

              <p class="text-lg">N° Pedido:
                <b class="d-block"><?php echo $VerTicket["nropedido"]; ?></b>
              </p>

            </div>

          </div>

        </div>

        <h5 class="mt-5 text-muted">Archivos</h5>

        <ul class="list-unstyled">

          <?php

          if ($VerTicket["adjuntos"] != "") {

            $adjuntos = json_decode($VerTicket["adjuntos"], true);

            foreach ($adjuntos as $key => $value) {

              $linkInfo = 'http://161.132.174.23/surtidores/' . $value;
              // $linkInfo = 'http://localhost/surtidores/' . $value;

              if (substr($value, -3) == "png" || substr($value, -3) == "jpg" || substr($value, -4) == "jpeg") {

                echo '<li>
                             <a href="' . $linkInfo . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-image-o"></i> Imagen</a>
                           </li>';
              }

              if (substr($value, -3) == "pdf") {

                echo '<li>
                           <a href="' . $linkInfo . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-pdf-o"></i> PDF</a>
                         </li>';
              }

              if (substr($value, -3) == "doc" || substr($value, -4) == "docx") {

                echo '<li>
                             <a href="' . $linkInfo . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-word-o"></i> Word</a>
                           </li>';
              }

              if (substr($value, -3) == "xls" || substr($value, -4) == "xlsx") {

                echo '<li>
                             <a href="' . $linkInfo . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-excel-o"></i> Excel</a>
                           </li>';
              }
            }
          }

          ?>

        </ul>

      </div>

    </div>

  </div>

  <div class="card-footer">

  </div>

</div>