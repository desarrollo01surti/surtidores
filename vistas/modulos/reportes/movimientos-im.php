<div class="box">

  <!-- Combobox de Proveedores -->
  <div class="box-header with-border">

    <div class="row">

      <div class="col-xs-4" id="selectProve">

      </div>

      <div class="col-xs-4"> </div>

      <!-- SE DEBE FILTRAR POR MESES -->
      <!-- <div class="col-xs-4">

        <select class="form-control input-lg-3" id="meses">
          <option value="">SELECCIONAR MESES</option>
          <option value="1">1 MES</option>
          <option value="3">3 MESES</option>
          <option value="6">6 MESES</option>
          <option value="8">8 MESES</option>
          <option value="12">12 MESES</option>
          <option value="15">15 MESES</option>
        </select>

      </div> -->

    </div>

  </div>

  <div class="box-body">

    <?php
    for ($i = 1; $i <= 6; $i++) {
      $mes = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
      $meses[] = $mes[(date('m', strtotime("first day of -$i month")) * 1) - 1];
    }
    $meses = array_reverse($meses);
    // print_r($meses);

    ?>

    <table class="table table-bordered table-striped dt-responsive compact tablaRepMovimientos">

      <thead>

        <tr>

          <th rowspan="2" style="width:30px">Codigo</th>
          <th rowspan="2" style="width:80px">Proveedor</th>
          <th rowspan="2" style="width:50px">Descripcion</th>
          <th colspan="2">
            <center><?php echo $meses[0]; ?></center>
          </th>
          <th colspan="2">
            <center><?php echo $meses[1]; ?></center>
          </th>
          <th colspan="2">
            <center><?php echo $meses[2]; ?></center>
          </th>
          <th colspan="2">
            <center><?php echo $meses[3]; ?></center>
          </th>
          <th colspan="2">
            <center><?php echo $meses[4]; ?></center>
          </th>
          <th colspan="2">
            <center><?php echo $meses[5]; ?></center>
          </th>
          <th rowspan="2" style="width:20px">
            <center>Prom. Ventas 6 Meses</center>
          </th>
          <th rowspan="2" style="width:30px">Stock Actual</th>
          <th rowspan="2" style="width:50px">Ultima Imp.</th>
          <th rowspan="2" style="width:50px">Fecha Ultima Imp.</th>
          <th rowspan="2" style="width:30px">Demanda</th>

        </tr>

        <tr>
          <th style="width:4px">ING.</th>
          <th style="width:4px">SAL.</th>
          <th style="width:4px">ING.</th>
          <th style="width:4px">SAL.</th>
          <th style="width:4px">ING.</th>
          <th style="width:4px">SAL.</th>
          <th style="width:4px">ING.</th>
          <th style="width:4px">SAL.</th>
          <th style="width:4px">ING.</th>
          <th style="width:4px">SAL.</th>
          <th style="width:5px">ING.</th>
          <th style="width:5px">SAL.</th>
        </tr>

      </thead>

      <tbody>

      </tbody>

    </table>

  </div>

</div>