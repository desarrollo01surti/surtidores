<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require_once "../controladores/consultareclamo.controlador.php";
require_once "../modelos/reclamaciones.modelo.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once '../extensiones/vendor/autoload.php';
require_once '../extensiones/tcpdf/pdf/reclamo.php';

class AjaxRespReclamaciones
{

  /*=============================================
    RESPONDER RECLAMO
    =============================================*/
  public $respReclamo;
  public $codReclamo;
  public $usuarioReclamo;

  public function ajaxReclamoRpta()
  {

    //REGISTRO DE RESPUESTA DE RECLAMO A LA BASE DE DATOS
    $codRecla = $this->codReclamo;
    $recla = $this->respReclamo;
    $idUserResp = $this->usuarioReclamo;

    date_default_timezone_set('America/Lima');
    $fechaHoy = date('Y-m-d H:i:s');

    $tabla = "tb_reclamaciones";

    $datos = array(
      "detalle_respuesta" => $recla,
      "fecha_respuesta" => $fechaHoy,
      "responsable" => $idUserResp,
      "estado" => 2,
      "codigo" => $codRecla
    );

    $respuesta = ModeloReclamos::mdlRegistrarReclamo($tabla, $datos);

    if ($respuesta == "ok") {

      //GENERA PDF
      $pdfejec = new imprimirPDFReclamo2();
      $pdfejec->traerImpresionReclamo2($codRecla);

      //CONSULTA DATOS DE RECLAMO, PARA OBTENER RUTA
      $itemSolc = "codigo";
      $valorSolc = $codRecla;

      $respuestaSolCS = ModeloReclamos::mdlMostrarReclamos($tabla, $itemSolc, $valorSolc);

      // ENVIO DE CORREO DE CONFIRMACION DE REGISTRO DE reclamo
      $mail = new PHPMailer;
      $mail->Charset = "utf-8";

      //Server settings
      $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'sursa@surtidores.com.pe';
      $mail->Password   = 'Surt1Cobr@_Su';
      $mail->SMTPSecure = 'tls';                                   //Enable implicit TLS encryption
      $mail->Port       = 587;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


      //Recipients
      $mail->setFrom("sursa@surtidores.com.pe", "SURTIDORES SAC");
      $mail->addAddress($respuestaSolCS["correo"]);
      $mail->addReplyTo("sursa@surtidores.com.pe", "SURTIDORES SAC");

      //Attachments
      $mail->AddAttachment($respuestaSolCS["ruta"], $codRecla . '.pdf');         //Add attachments (Archivo)

      //Content
      $mail->msgHTML('<div style="width:100%; background: #eee; position:relative; font-family:sans-serif; padding-bottom:40px">

                        <center>
                             <img style="padding:20px; width:10%" src="http://www.surtidores.com.pe/images/logo_surtidore.png">
                        </center>

                        <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">

                          <center>
                               <img style="padding:20px; width:15%" src="http://icons555.com/images/icons-black/image_icon_email_5_pic_512x512.png">

                               <h3 style="font-weight:100; color:#999">HOJA DE RECLAMACIÓN SURTIDORES SAC</h3>

                               <hr style="border:1px solid #ccc; width:80%">

                               <h4 style="font-weight:100; color:#121212; padding:0 20px">Identificación del consumidor reclamante</h4>

                              <h5 style="font-weight:100; color:#999; padding:0 20px; text-align:left">Nombres: ' . $respuestaSolCS["nombre"] . '</h5>
                              <h5 style="font-weight:100; color:#999; padding:0 20px; text-align:left">Documento(DNI/CE): ' . $respuestaSolCS["documento"] . '</h5>
                              <h5 style="font-weight:100; color:#999; padding:0 20px; text-align:left">Telefono: ' . $respuestaSolCS["telefono"] . '</h5>
                              <h5 style="font-weight:100; color:#999; padding:0 20px; text-align:left">Correo: ' . $respuestaSolCS["correo"] . '</h5>
                              <h5 style="font-weight:100; color:#999; padding:0 20px; text-align:left">Domicilio: ' . $respuestaSolCS["domicilio"] . '</h5>

                              <br>

                              <hr style="border:1px solid #ccc; width:80%">

                              <h5 style="font-weight:100; color:#999; padding:0 20px; text-align:left">Estimado cliente, su hoja de reclamación N° ' . $codRecla . ' ha sido revisada por nuestro equipo y la respuesta está detallada a continuacion en el siguiente documento pdf.</h5>

                              <hr style="border:1px solid #ccc; width:80%">

                              <h5 style="font-weight:100; color:#999">Este mensaje se ha enviado desde un formulario de contacto en Web Surtidores (http://www.surtidores.com.pe/). Por favor no responda a este correo. Si tiene dudas llámenos al (01) 441-7425.</h5>
                          </center>

                        </div>

                      </div>');

      $mail->Subject = utf8_decode("Respuesta Hoja de Reclamación N° " . $codRecla . " - SURTIDORES SAC");

      $envio = $mail->Send();

      if (!$envio) {

        echo '¡Ha ocurrido un problema enviando la respuesta de la hoja de reclamacion al correo ' . $respuestaSolCS["correo"] . ' ' . $mail->ErrorInfo . ', por favor intentelo nuevamente!';
      } else {

        unlink($respuestaSolCS["ruta"]);

        $tabla3 = "tb_reclamaciones";
        $item1 = "ruta";
        $valor1 = "";
        $item2 = "codigo";
        $valor2 = $codRecla;

        ModeloReclamos::mdlActualizarReclamo($tabla3, $item1, $valor1, $item2, $valor2);

        echo '1';
      }
    }
  }
}


/*=============================================
RESPONDER A RECLAMO
=============================================*/
if (isset($_POST["respReclamo"])) {

  $respuestReclamo = new AjaxRespReclamaciones();
  $respuestReclamo->respReclamo = $_POST["respReclamo"];
  $respuestReclamo->codReclamo = $_POST["codReclamacion2"];
  $respuestReclamo->usuarioReclamo = $_POST["idUsua"];
  $respuestReclamo->ajaxReclamoRpta();
}
