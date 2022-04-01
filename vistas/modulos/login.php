<div class="login-box">

  <div class="login-logo">
    <img src="vistas/img/plantilla/logo.png" class="img-responsive" style="padding:10px 50px;">
  </div>
  <!-- /.login-logo -->

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>

      <?php

      if (isset($_GET["ruta"])) {
        /*=============================================
        Validar token (INICIO DE SESION DESDE CATALOGO)
        =============================================*/

        $item = "token";
        $valor = $_GET["ruta"];

        $respuestaTokenCatalogo = ModeloUsuario::mdlValidarUsuarioCatalogo($valor);

        // var_dump($respuestaTokenCatalogo);

        if (is_array($respuestaTokenCatalogo)) {

          $sesionToken = ControladorUsuario::ctrIngresoUsuarioToken($respuestaTokenCatalogo["login"]);
        }
      }

      /*=============================================
      Validar token (INICIO DE SESION DESDE CATALOGO)
      =============================================*/

      $login = new ControladorUsuario();
      $login->ctrIngresoUsuario();

      ?>

    </form>

  </div>
  <!-- /.login-box-body -->

</div>
<!-- /.login-box -->