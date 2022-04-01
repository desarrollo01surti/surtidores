<?php
$existe = "no";

$listaAc = json_decode($_SESSION["accesos"], true);

foreach ($listaAc as $key => $value) {

  if ($value["nombre"] == "Trabajador" && $value["activo"] == 1) {

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
      Gestor Empleados
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Gestor Empleados</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <!--=====================================
        PANEL LISTA DE SUCURSALES
        ======================================-->
        <div class="box box-success">

          <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpleado">

              Agregar Empleado

            </button>

            <!-- <button class="btn btn-primary alertaPrueba">

              ALERTA PRUEBA

            </button> -->

          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaEmpleado" width="100%">

              <thead>

                <tr>

                  <th style="width:10px">#</th>
                  <th>Codigo</th>
                  <th>Nombres</th>
                  <th>Area</th>
                  <th>Documento</th>
                  <th>Correo</th>
                  <th>Telefono</th>
                  <th>Foto</th>
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

<!--=====================================
       MODAL AGREGAR EMPLEADO
======================================-->
<div id="modalAgregarEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Empleado</h4>

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

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <?php

                $item = null;
                $valor = null;

                $empleado = ControladorEmpleado::ctrMostrarEmpleado($item, $valor);

                if (!$empleado) {

                  echo '<input type="text" class="form-control input-lg" id="nuevoEmpleado" name="nuevoEmpleado" value="101" readonly>';
                } else {

                  foreach ($empleado as $key => $value) {
                  }

                  $codigo = $value["codigo"] + 1;



                  echo '<input type="text" class="form-control input-lg" id="nuevoEmpleado" name="nuevoEmpleado" value="' . $codigo . '" readonly>';
                }

                ?>


              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" id="nuevoNombre" placeholder="Nombres y Apellidos" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DE DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                <select class="form-control input-lg" id="seleccionaTipoDoc" name="seleccionaTipoDoc" required>

                  <option value="">Selecionar Tipo Doc.</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $empleados = ControladorEmpleado::ctrMostrarTipoDoc($item, $valor);

                  foreach ($empleados as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NRO DE DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNroDoc" id="nuevoNroDoc" placeholder="Nro Documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

            <!-- <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaDirecc" id="nuevaDirecc" placeholder="Direccion">

              </div>

            </div> -->

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Teléfono" data-inputmask="'mask':'999999999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            <!-- 
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="yyyy/mm/dd" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div> -->

            <!-- ENTRADA PARA SELECCIONAR AREA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" id="seleccionaArea" name="seleccionaArea" required>

                  <option value="">Selecionar Area</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

                  foreach ($areas as $key => $value) {

                    echo '<option value="' . $value["idarea"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFotoEmpleado" name="nuevaFotoEmpleado">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEmpleado" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
                PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Empleado</button>

        </div>

        <?php

        $crearEmpleado = new ControladorEmpleado();
        $crearEmpleado->ctrCrearEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
       MODAL EDITAR EMPLEADO
======================================-->
<div id="modalEditarEmpleado" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
                CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Empleado</h4>

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

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="editarEmpleado" name="editarEmpleado" readonly>


              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR TIPO DE DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                <select class="form-control input-lg" id="editarTipoDoc" name="editarTipoDoc" required>

                  <option value="" id="editTipDoc"></option>

                  <?php

                  $item = null;
                  $valor = null;

                  $documento = ControladorEmpleado::ctrMostrarTipoDoc($item, $valor);

                  foreach ($documento as $key => $value) {

                    echo '<option value="' . $value["id"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NRO DE DOCUMENTO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-list-alt"></i></span>

                <input type="text" class="form-control input-lg" name="editarNroDoc" id="editarNroDoc" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCION -->

            <!-- <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input type="text" class="form-control input-lg" name="editarDirecc" id="editarDirecc">

              </div>

            </div> -->

            <!-- ENTRADA PARA EL EMAIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                <input type="email" class="form-control input-lg" name="editarEmail" id="editarEmail">

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'999999999'" data-mask>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->

            <!-- <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div> -->

            <!-- ENTRADA PARA SELECCIONAR AREA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>

                <select class="form-control input-lg" id="editarArea" name="editarArea" required>

                  <option value="" id="editArea"></option>

                  <?php

                  $item = null;
                  $valor = null;

                  $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

                  foreach ($areas as $key => $value) {

                    echo '<option value="' . $value["idarea"] . '">' . $value["descripcion"] . '</option>';
                  }

                  ?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFotoEmpleado" name="nuevaFotoEmpleado">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizarEmpleado" width="100px">

              <input type="hidden" name="fotoActualEmpl" id="fotoActualEmpl">

            </div>

          </div>

        </div>

        <!--=====================================
                PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Actualizar Empleado</button>

        </div>

        <?php

        $editarEmpleado = new ControladorEmpleado();
        $editarEmpleado->ctrEditarEmpleado();

        ?>

      </form>

    </div>

  </div>

</div>