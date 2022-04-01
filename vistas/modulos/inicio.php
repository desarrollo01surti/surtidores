<!-- <script type="text/javascript">

//VALIDAR EL STOCK DE PRODUCTOS CON IF PARA ENVIAR ALERTA
$(document).ready(function(){

  swal({
		 title: "¡ALERTA!",
		 text: "¡El codigo 0010038091191 esta a punto de quedarse sin stock!",
		 type: "error",
		 confirmButtonText: "¡Cerrar!"
	 });

})

</script> -->

<!--=====================================
PÁGINA DE INICIO
======================================-->
<!-- content-wrapper -->
<div class="content-wrapper">

  <!-- content-header -->
  <section class="content-header">

    <h1>
    Tablero
    <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Tablero</li>

    </ol>

  </section>
  <!-- content-header -->

  <!-- content -->
  <section class="content">

    <!-- row -->
    <div class="row">

      <div class="col-lg-12">

           <div class="box box-success">

               <div class="box-header">

                 <div class="row">

                   <div class="col-lg-3">

                     <img src="vistas/img/plantilla/surtidor.png" alt="">

                   </div>

                   <div class="col-lg-9">
                        <h3>Bienvenid@ <?php echo $_SESSION["nombre"]." - ".$_SESSION["perfil"]; ?></h3> a la intranet de Surtidores S.A.C.
                   </div>

                 </div>

               </div>

           </div>

     </div>

    </div>
    <!-- row -->

    <!-- row -->
    <div class="row">

      <div class="col-lg-12">

         <?php

           // if ($_SESSION["idArea"] == 1) {
           //
           //   // include "inicio/grafico-ventas.php";
           //
           // }

        ?>

      </div>

    </div>
    <!-- row -->

    <div class="row">

      <div class="col-lg-12">

            <?php

                // $productos = ControladorVentas::ctrProdMasVendidosxSem();

                // if ($productos) {
                //
                //    include "inicio/productos-mas-vendidos.php";
                //
                // }

               // include "inicio/prod-ventas.php";

             ?>

      </div>

    </div>

    <div class="row">

      <div class="col-lg-6">

            <?php

                // include "inicio/productos-mas-vendidos.php";

             ?>

      </div>

    </div>

 </section>
  <!-- content -->

</div>
<!-- content-wrapper -->
