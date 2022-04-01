<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Importar Excel

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="importexcel"><i class="fa fa-dashboard"></i> Importe Excel</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>

  <section class="content">

      <div class="row">

        <div class="col-md-6 col-xs-12">

        <!--=====================================
        BLOQUE 1
        ======================================-->

        <?php

          /*=============================================
          ADMINISTRACIÓN DE SOLICITUD DE EXCEL
          =============================================*/

          include "excel/solicitudexcel.php";


        ?>

        </div>


        <div class="col-md-6">

        <!--=====================================
        BLOQUE 2
        ======================================-->

          <?php

         /*=====================================
          ADMINISTRAR CÓDIGOS
          ======================================*/

           include "excel/elegircolum.php";


          ?>

        </div>

      </div>

    </section>

</div>
