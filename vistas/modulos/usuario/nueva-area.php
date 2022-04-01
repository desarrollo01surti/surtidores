<!--=====================================
PANEL NUEVA AREA
======================================-->

<div class="panel box box-danger">

  <div class="box-header with-border">

    <h4 class="box-title">

      <a data-toggle="collapse" data-parent="#accordion" href="#nuevarea" class="collapsed" aria-expanded="false">
        NUEVA AREA
      </a>

    </h4>

  </div>

  <div id="nuevarea" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">

    <div class="box-body">

      <form role="form" method="post">

        <div class="box-body" style="display: block;">

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">
               AREA:
            </label>
            <div class="input-group col-sm-5">

              <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <input type="text" class="form-control" name="nuevaArea" id="nuevaArea" placeholder="Ingresar Area" required>

            </div>
          </div>

          <div class="form-group">

            <label for="slug" class="col-sm-3 control-label">
              ACRÓNIMO:
            </label>

            <div class="input-group col-sm-5">

              <span class="input-group-addon"><i class="fa fa-users"></i></span>

              <input type="text" class="form-control" name="nuevoAcro" id="nuevoAcro" placeholder="Ingresar acrónimo" required>

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

          // $crearPerfil = new ControladorPerfiles();
          // $crearPerfil -> ctrCrearPerfil();

        ?>

      </form>

    </div>

  </div>

</div>
