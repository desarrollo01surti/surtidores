<?php

session_start();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Surtidores | Panel de Control</title>

  <link rel="icon" href="vistas/img/plantilla/favicon.ico">

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!--=====================================
  PLUGINS DE CSS
  ======================================-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Select 2 -->
  <link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="vistas/dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="vistas/dist/css/skins/skin-yellow-light.min.css">

  <link rel="stylesheet" href="vistas/dist/css/skins/skin-blue-light.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/square/blue.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

  <!-- jvectormap -->
  <link rel="stylesheet" href="vistas/bower_components/jvectormap/jquery-jvectormap.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

  <!-- bootstrap slider -->
  <link rel="stylesheet" href="vistas/plugins/bootstrap-slider/slider.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- <link rel="stylesheet" type="text/css" href="vistas/bower_components/datatablesv2/DataTables-1.11.2/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" type="text/css" href="vistas/bower_components/datatablesv2/Buttons-2.0.0/css/buttons.bootstrap4.min.css" /> -->

  <!-- Toastr -->
  <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">

  <!--=====================================
  CSS PERSONALIZADO
  ======================================-->

  <link rel="stylesheet" href="vistas/css/plantilla.css">
  <link rel="stylesheet" href="vistas/css/slide.css">


  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <!-- <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script> -->
  <script src="vistas/plugins/toastr/jquery.min.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="vistas/bower_components/jquery-ui/jquery-ui.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Select 2 -->
  <script src="vistas/bower_components/select2/dist/js/select2.full.min.js"></script>

  <!-- Select 2 spanish-->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/es.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/demo.js"></script>

  <!-- iCheck http://icheck.fronteed.com/-->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- Morris.js charts -->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>

  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- jQuery Knob Chart -->
  <script src="vistas/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

  <!-- jvectormap -->
  <script src="vistas/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

  <script src="vistas/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

  <!-- ChartJS -->
  <script src="vistas/bower_components/chart.js/Chart.js"></script>

  <!-- SweetAlert 2 https://sweetalert2.github.io/-->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- Toastr -->
  <script src="vistas/plugins/toastr/toastr.min.js"></script>

  <!-- bootstrap color picker https://farbelous.github.io/bootstrap-colorpicker/v2/-->
  <script src="vistas/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

  <!-- Bootstrap slider http://seiyria.com/bootstrap-slider/-->
  <script src="vistas/plugins/bootstrap-slider/bootstrap-slider.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <script type="text/javascript" src="vistas/bower_components/datatablesv2/JSZip-2.5.0/jszip.min.js"></script>
  <script type="text/javascript" src="vistas/bower_components/datatablesv2/pdfmake-0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="vistas/bower_components/datatablesv2/pdfmake-0.1.36/vfs_fonts.js"></script>
  <!-- <script type="text/javascript" src="vistas/bower_components/datatablesv2/DataTables-1.11.2/js/jquery.dataTables.min.js"></script> -->
  <!-- <script type="text/javascript" src="vistas/bower_components/datatablesv2/DataTables-1.11.2/js/dataTables.bootstrap4.min.js"></script> -->
  <script type="text/javascript" src="vistas/bower_components/datatablesv2/Buttons-2.0.0/js/dataTables.buttons.min.js"></script>
  <!-- <script type="text/javascript" src="vistas/bower_components/datatablesv2/Buttons-2.0.0/js/buttons.bootstrap4.min.js"></script> -->
  <script type="text/javascript" src="vistas/bower_components/datatablesv2/Buttons-2.0.0/js/buttons.html5.min.js"></script>
  <script type="text/javascript" src="vistas/bower_components/datatablesv2/Buttons-2.0.0/js/buttons.print.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

</head>

<body class="hold-transition skin-blue-light sidebar-mini login-page">

  <div id="loading-screen" style="display:none">
    <img src="vistas/img/plantilla/spinning-circles.svg">
  </div>

  <?php

  if (isset($_SESSION["iniciarSesion"]) && $_SESSION["acceder"] === "ok") {

    $item = "idusuario";
    $valor = $_SESSION["idUsuario"];

    $usuario = ControladorUsuario::ctrMostrarUsuariosFiltro($item, $valor);

    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "importexcel" ||
        $_GET["ruta"] == "perfil" ||
        $_GET["ruta"] == "empresa" ||
        $_GET["ruta"] == "sucursal" ||
        $_GET["ruta"] == "empleado" ||
        $_GET["ruta"] == "usuario" ||
        $_GET["ruta"] == "areas" ||
        $_GET["ruta"] == "modulos" ||
        $_GET["ruta"] == "movimientos-imp" ||
        $_GET["ruta"] == "ingresosalida" ||
        $_GET["ruta"] == "sin-movimiento" ||
        $_GET["ruta"] == "reclamacionesweb" ||
        $_GET["ruta"] == "tickets" ||
        $_GET["ruta"] == "nuevo-ticket" ||
        $_GET["ruta"] == "ticket-vista" ||
        $_GET["ruta"] == "stock" ||
        $_GET["ruta"] == "proveedor" ||
        $_GET["ruta"] == "ordencompra" ||
        $_GET["ruta"] == "nueva-orden" ||
        $_GET["ruta"] == "roles" ||
        $_GET["ruta"] == "salir"
      ) {

        echo '<div class="wrapper">';

        /*=============================================
                    CABEZOTE
        =============================================*/

        include "modulos/cabezote.php";

        /*=============================================
                    LATERAL
        =============================================*/

        include "modulos/lateral.php";

        /*=============================================
                    CONTENIDO
        =============================================*/


        include "modulos/" . $_GET["ruta"] . ".php";

        /*=============================================
                   FOOTER
        =============================================*/

        include "modulos/footer.php";


        echo '</div>';
      } else if ($_GET["ruta"] == "acceder") {

        include "modulos/" . $_GET["ruta"] . ".php";
      } else {

        echo '<div class="wrapper">';

        /*=============================================
                 CABEZOTE
        =============================================*/

        include "modulos/cabezote.php";

        /*=============================================
                 LATERAL
        =============================================*/

        include "modulos/lateral.php";

        /*=============================================
                 CONTENIDO
        =============================================*/

        include "modulos/404.php";

        /*=============================================
                 FOOTER
        =============================================*/

        include "modulos/footer.php";


        echo '</div>';
      }
    } else {

      echo '<div class="wrapper">';

      /*=============================================
                 CABEZOTE
        =============================================*/

      include "modulos/cabezote.php";

      /*=============================================
                 LATERAL
        =============================================*/

      include "modulos/lateral.php";

      /*=============================================
                 CONTENIDO
        =============================================*/

      include "modulos/404.php";

      /*=============================================
                 FOOTER
        =============================================*/

      include "modulos/footer.php";


      echo '</div>';
    }
  } else {

    include "modulos/login.php";
  }

  ?>

  <!--=====================================
JS PERSONALIZADO
======================================-->

  <script src="vistas/js/plantilla.js"></script>
  <script src="vistas/js/permisos.js"></script>
  <script src="vistas/js/excel.js"></script>
  <script src="vistas/js/perfiles.js"></script>
  <script src="vistas/js/empresa.js"></script>
  <script src="vistas/js/sucursal.js"></script>
  <script src="vistas/js/empleado.js"></script>
  <script src="vistas/js/usuario.js"></script>
  <script src="vistas/js/acceder.js"></script>
  <script src="vistas/js/modulo.js"></script>
  <script src="vistas/js/area.js"></script>
  <script src="vistas/js/movimientosimp.js"></script>
  <script src="vistas/js/sinmovimiento.js"></script>
  <script src="vistas/js/stock.js"></script>
  <script src="vistas/js/notificaciones.js"></script>
  <script src="vistas/js/reclamaciones.js"></script>
  <script src="vistas/js/ingsal.js"></script>
  <script src="vistas/js/tickets.js"></script>
  <script src="vistas/js/roles.js"></script>
  <script src="vistas/js/ordencompra.js"></script>

</body>

</html>