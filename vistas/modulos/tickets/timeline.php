<?php

$itemHis = "id_ticket";

$historial = ControladorTickets::ctrMostrarHistorial($itemHis, $valor2); //campo  y valor a consultar

?>

<div class="box box-success">

  <div class="box-header">

    <h3 class="box-title">HISTORIAL DE TICKET</h3>

    <?php

    if ($VerTicket["estado"] != "cerrado" && $VerTicket["asignado"] != 0) {

      if ($VerTicket["asignado"] == $_SESSION["idUsuario"]) {

        echo '<button class="btn btn-success btnAgregarRespuesta" codigoTicket="' . $valor2 . '" style="float: right;" data-toggle="modal" data-target="#modalAgregarRespuesta">
                      Agregar Respuesta
                    </button>';

        echo '<button class="btn btn-danger btnCerrarTicket" codigoTicket="' . $valor2 . '" style="float: right;">
                            Cerrar Ticket
                          </button>';
      } else if ($VerTicket["asignado"] == 18) {

        if ($_SESSION["idUsuario"] == 19) { //PARA EL TICKET ASIGNADO A NESTOR SE DA ACCESO DE RESPONDER A YURI

          echo '<button class="btn btn-success btnAgregarRespuesta" codigoTicket="' . $valor2 . '" style="float: right;" data-toggle="modal" data-target="#modalAgregarRespuesta">
                      Agregar Respuesta
                    </button>';

          echo '<button class="btn btn-danger btnCerrarTicket" codigoTicket="' . $valor2 . '" style="float: right;">
                            Cerrar Ticket
                          </button>';
        }
      } else if ($VerTicket["asignado"] == 6) { //PARA EL TICKET ASIGNADO A FIORELLA SE DA ACCESO DE RESPONDER A KELLI 

        if ($_SESSION["idUsuario"] == 2) {

          echo '<button class="btn btn-success btnAgregarRespuesta" codigoTicket="' . $valor2 . '" style="float: right;" data-toggle="modal" data-target="#modalAgregarRespuesta">
                      Agregar Respuesta
                    </button>';

          echo '<button class="btn btn-danger btnCerrarTicket" codigoTicket="' . $valor2 . '" style="float: right;">
                            Cerrar Ticket
                          </button>';
        }
      }
    }



    ?>

  </div>

  <div class="box-body">

    <ul class="timeline">

      <?php

      //SE MUESTRA EL HISTORIAL DEL TICKET EN EL TIMELINE
      if ($historial != null) {

        foreach ($historial as $key => $valueHis) {

          /*=============================================
       				EMAIL / FECHA - HORA
       				=============================================*/
          //Conociendo fecha formateada con letras
          $num = date("j", strtotime($valueHis["fecha"]));
          $anno = date("Y", strtotime($valueHis["fecha"]));
          $mes = array('ener.', 'febr.', 'marz.', 'abril', 'mayo', 'jun.', 'jul.', 'ago.', 'sept.', 'oct.', 'nov.', 'dic.');
          $mes = $mes[(date('m', strtotime($valueHis["fecha"])) * 1) - 1];
          $datanew = $num . ' ' . $mes . ' ' . $anno;
          $fecha_soport = $datanew;

          //obteniendo hora y colores random
          $hora = date("H:i:s", strtotime($valueHis["fecha"]));
          $colores = array('blue', 'yellow', 'red', 'green', 'info', 'secondary', 'purple', 'orange', 'teal', 'pink', 'olive');
          $color_random = $colores[array_rand($colores)];

          //obteniendo nombre de usuario
          if ($valueHis["tipoUser"] == "soporte") {

            $itemUsr = "idusuario";
            $valorUsr = $valueHis["usuario"];

            $nomUser = ControladorUsuario::ctrMostrarUsuariosFiltro($itemUsr, $valorUsr);
            $nombreUsuario = $nomUser["usuario"];
          } else {

            $itemUsr = "id";
            $valorUsr = $valueHis["usuario"];

            $nomUser = ControladorUsuario::ctrMostrarUsuariosTick($itemUsr, $valorUsr);
            $nombreUsuario = $nomUser["nombres"];
          }


          echo '<li class="time-label">';

          if ($valueHis["tipoUser"] == "soporte") {

            if ($valueHis["descripcion"] == "Asignación de Ticket") {

              echo '<span class="bg-green">' . $fecha_soport . '</span>';
            } else {

              echo '<span class="bg-blue">' . $fecha_soport . '</span>';
            }
          } else {

            echo '<span class="bg-yellow">' . $fecha_soport . '</span>';
          }

          echo '</li>

                    <li>';

          if ($valueHis["tipoUser"] == "soporte") {

            if ($valueHis["descripcion"] == "Asignación de Ticket") {

              echo '<i class="fa fa-envelope bg-green"></i>';
            } else {

              echo '<i class="fa fa-envelope bg-blue"></i>';
            }
          } else {

            echo '<i class="fa fa-user bg-yellow"></i>';
          }


          echo '<div class="timeline-item">

                             <span class="time"><i class="fa fa-clock"></i> ' . $hora . '</span>

                             <h3 class="timeline-header"><a href="#">' . $nombreUsuario . '</a> ' . $valueHis["descripcion"] . '</h3>

                             <div class="timeline-body">
                               ' . $valueHis["respuesta"] . '
                             </div>

                             <div class="timeline-footer">';

          if ($valueHis["adjunto"] != "") {

            $adjunto = json_decode($valueHis["adjunto"], true);

            foreach ($adjunto as $key => $valueAdj) {

              if ($valueHis["tipoUser"] == "soporte") {

                $link = 'http://161.132.174.23/surtidores/' . $valueAdj;
                // $link = 'http://localhost/surtidores/'.$valueAdj;

              } else {

                $link = 'https://www.surtidores.com.pe/tickets/backoffice/' . $valueAdj;
              }



              if (substr($valueAdj, -3) == "png" || substr($valueAdj, -3) == "jpg" || substr($valueAdj, -4) == "jpeg") {

                echo '<a href="' . $link . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-image-o"></i> Imagen</a>';
              }

              if (substr($valueAdj, -3) == "pdf") {

                echo '<a href="' . $link . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-pdf-o"></i> PDF</a>';
              }

              if (substr($valueAdj, -3) == "doc" || substr($valueAdj, -4) == "docx") {

                echo '<a href="' . $link . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-word-o"></i> Word</a>';
              }

              if (substr($valueAdj, -3) == "xls" || substr($valueAdj, -4) == "xlsx") {

                echo '<a href="' . $link . '" target="_blank" class="link-black text-lg"><i class="fa fa-file-excel-o"></i> Excel</a>';
              }
            }
          }


          echo '</div>
                       </div>
                     </li>';
        }
      }


      if ($VerTicket["estado"] != "cerrado") {
        echo '<li>
                      <i class="fa fa-clock-o bg-gray"></i>
                    </li>';
      } else {
        echo '<li>
                     <i class="fa fa-times-circle bg-red"></i>
                   </li>';
      }

      ?>



    </ul>

  </div>

</div>

<!--=====================================
 MODAL AGREGAR RESPUESTA DE TICKET (SOPORTE)
 ======================================-->

<div id="modalAgregarRespuesta" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
                 CABEZA DEL MODAL
         ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Respuesta de Ticket</h4>

        </div>

        <!--=====================================
                 CUERPO DEL MODAL
         ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
                     ENTRADA DEL CÓDIGO
             ======================================-->

            <div class="form-group">

              <div class="input-group">

                <label for="recipient-name" class="control-label">Ticket N° </label>

                <input type="text" class="form-control input-lg" id="nroticket" name="nroticket" disabled>

                <input type="hidden" class="form-control" id="nroticket2" name="nroticket2">

                <input type="hidden" name="idUser" value="<?php echo $_SESSION["idUsuario"]; ?>">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR EMPRESA -->

            <div class="form-group">

              <div class="input-group">

                <label for="respuesta-text" class="control-label">Respuesta:</label>

                <textarea class="form-control input-lg" id="respuesta-text" name="respuesta-text" required></textarea>

              </div>

            </div>

            <!--=====================================
               LOS ADJUNTOS DEL TICKET
               ======================================-->
            <div class="form-group">

              <div class="input-group">

                <div class="btn btn-default btn-file">

                  <i class="fa fa-paperclip"></i> Adjuntar

                  <input type="file" class="subirAdjuntos2" multiple="">

                  <input type="hidden" name="adjuntos2" class="archivosTemporales2">

                </div>

                <p class="help-block small">Archivos con peso máximo de 32MB</p>

              </div>

            </div>

            <div class="form-group">

              <ul class="mailbox-attachments d-flex align-items-stretch clearfix Archivos22">

              </ul>

            </div>



          </div>

        </div>

        <!--=====================================
                 PIE DEL MODAL
         ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Enviar Respuesta</button>

        </div>

        <?php

        $agregarRespuestaTk = new ControladorTickets();
        $agregarRespuestaTk->ctrAgregarRespuestaTicket();

        ?>

      </form>

    </div>

  </div>

</div>