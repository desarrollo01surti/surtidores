  <section class="content">

    <div class="row">
      <!-- Cuadro Izquierdo (Info Usuario) -->
      <div class="col-md-4">
        <!-- general form elements -->
        <div class="box box-primary">

          <div class="box-header with-border">
            <h3 class="box-title">Datos del Trabajador</h3>
          </div><!-- /.box-header -->

          <form role="form" id="frmAcceder" name="frmAcceder">

            <div class="box-body">

              <div class="row">

                <div class="col-xs-12">

                  <div class="box box-widget widget-user-2">

                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-blue">

                      <div class="widget-user-image">

                        <?php

                           if ($_SESSION["foto"] != "") {

                               echo '<img class="img-circle" src="'.$_SESSION["foto"].'" alt="Usuario">';

                           }else{

                               echo '<img class="img-circle" src="vistas/img/usuarios/default/anonymous.png" alt="Usuario">';

                           }

                         ?>

                      </div><!-- /.widget-user-image -->

                      <h3 class="widget-user-username"><?php echo $_SESSION["nombre"]; ?></h3>
                      <h5 class="widget-user-desc"><?php echo $_SESSION["perfil"]; ?></h5>

                    </div>

                    <div class="box-footer no-padding">
                      <ul class="nav nav-stacked">
                        <li><a href="#"><strong>Documento:</strong>&nbsp; <?php echo $_SESSION["documento"]; ?> <span class="pull-right badge bg-red"><i class="fa fa-fw fa-book"></i></span></a></li>
                        <li><a href="#"><strong>Email:</strong>&nbsp; <?php echo $_SESSION["correo"]; ?> <span class="pull-right badge bg-green"><i class="fa fa-fw fa-envelope"></i></span></a></li>
                        <li><a href="#"><strong>Usuario:</strong>&nbsp; <?php echo $_SESSION["usuario"]; ?> <span class="pull-right badge bg-aqua"><i class="fa fa-fw fa-user"></i></span></a></li>
                      </ul>
                    </div>

                  </div><!-- /.widget-user -->

                </div>

              </div>

            </div><!-- /.box-body -->

            <div class="box-footer">
<!-- corregir el cerrar sesion -->
              <a href="salir" class="btn btn-danger">Cerrar Sesión</a>

            </div>

          </form>

        </div><!-- /.box -->

      </div>
      <!--/.col (Izquierdo) -->


      <!-- cuadro Derecho (Info Sucursales)-->
      <div class="col-md-8">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Acceso a las Sucursales</h3>
          </div><!-- /.box-header -->
          <!-- form start -->

          <div class="box-body">

            <div class="box">

              <div class="box-body no-padding">

                <table class="table table-hover tablaAcceder">

                  <thead>

                    <tr>
                      <th>Opcion</th>
                      <th>Sucursal</th>
                      <th>Logo</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                          $listaSucursales = json_decode($_SESSION["sucursales"], true);

                          foreach ($listaSucursales as $key => $value) {

                              if ($value["activo"] == 1 && $value["nombre"] != "principal") {

                                  echo '<tr>
                                            <td><button type="button" class="btn btn-info pull-left btnAcceder" idSucursal="'.$value["id"].'" NomSucur="'.$value["nombre"].'" idPerfil="'.$_SESSION["idPerfil"].'" idUsuario="'.  $_SESSION["idUsuario"].'" usuario="'.  $_SESSION["usuario"].'">Acceder</button></td>
                                            <td>'.$value["nombre"].'</td>';

                                            if ($_SESSION["logoEmpresa"] != "") {

                                              echo '<td><img class="img-thumbnail" width="100px" height="100px" src="'.$_SESSION["logoEmpresa"].'"></td>';

                                            }else{

                                              echo '<td><img class="img-thumbnail" width="80px" height="80px" src="vistas/img/empresas/default/empresa.png"></td>';

                                            }

                                  echo '</tr>';
                              }
                          }

                          if ($_SESSION["idPerfil"] == "1") {

                            echo '<tr>
                                      <td><button type="button" class="btn btn-success pull-left btnAccederSuperAdmin" idPerfil="'.$_SESSION["idPerfil"].'" idUsuario="'.  $_SESSION["idUsuario"].'">Acceder</button></td>
                                      <td>Acceso Administrador</td>
                                      <td></td>
                                  </tr>';


                          }

                     ?>

                  </tbody>

                </table>

              </div><!-- /.box-body -->

            </div><!-- /.box -->


          </div><!-- /.box -->
          <!-- general form elements disabled -->
        </div>
        <!--/.col (right) -->
      </div> <!-- /.row -->
    </div>

  </section>
