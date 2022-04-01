<!--=====================================
PANEL NUEVO ROL
======================================-->

<div class="panel box box-danger">

  <div class="box-header with-border">

    <h4 class="box-title">

      <a data-toggle="collapse" data-parent="#accordion" href="#nuevorol" class="collapsed" aria-expanded="false">
        NUEVO PERFIL
      </a>

    </h4>

  </div>

  <div id="nuevorol" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

    <div class="box-body">

      <form role="form" method="post">

        <div class="box-body" style="display: block;">

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">
               AREA:
            </label>
            <div class="input-group col-sm-5">

              <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <select class="form-control" id="seleccionarArea" name="seleccionarArea" required>

              <option value="">Seleccionar Area</option>

              <?php

                $item = null;
                $valor = null;

                $areas = ControladorAreas::ctrMostrarAreas($item, $valor);

                 foreach ($areas as $key => $value) {

                   echo '<option value="'.$value["idarea"].'">'.$value["descripcion"].'</option>';

                 }

              ?>

              </select>

            </div>
          </div>

          <div class="form-group">

            <label for="slug" class="col-sm-3 control-label">
              PERFIL:
            </label>

            <div class="input-group col-sm-5">

              <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <input type="text" class="form-control" name="nuevoPerfil" id="nuevoPerfil" placeholder="Ingresar perfil" required>

            </div>

          </div>

          <div class="form-group">

            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-7">

              <button class="btn btn-info" type="submit"><span class="fa fa-fw fa-save"></span> GUARDAR </button>

            </div>

          </div>

        </div>

        <?php

          $crearPerfil = new ControladorPerfiles();
          $crearPerfil -> ctrCrearPerfil();

        ?>

      </form>

    </div>

  </div>

</div>
