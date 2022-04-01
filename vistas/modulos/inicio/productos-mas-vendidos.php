<?php

$colores = array("red","green","yellow","aqua","purple","blue","cyan","magenta","orange","gold");

$productos = ControladorVentas::ctrProdMasVendidosxSem();

$totalVentas = 0;

foreach ($productos as $key => $value) {

    $totalVentas += $value["ventas"];
    // $cant = $cant+1;
}

 ?>


<div class="box box-default">

  <!-- /.box-header -->
  <div class="box-header with-border">

    <h3 class="box-title">Top 10 de Productos Vendidos en la semana</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

    </div>

  </div>

  <!-- /.box-header -->


  <!-- /.box-body -->
  <div class="box-body">

    <div class="row">

      <div class="col-md-7">

        <div class="chart-responsive">

          <canvas id="pieChart" height="240" width="250"></canvas>

        </div>
        <!-- ./chart-responsive -->
      </div>

      <!-- /.col -->
      <div class="col-md-5">

        <ul class="chart-legend clearfix">

          <?php

					for($i = 0; $i < 10; $i++){

          $porcentaje = $productos[$i]["ventas"]*100/$totalVentas;

					echo '<li><i class="fa fa-circle-o text-'.$colores[$i].'"></i> '.$productos[$i]["ID_prod"].' - '.$productos[$i]["descripcion"].'</li>';

					}


		  	 	?>

        </ul>

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer no-padding">

    <ul class="nav nav-pills nav-stacked">

      <?php

            for($i = 0; $i < 5; $i++){

              $porcentaje = $productos[$i]["ventas"]*100/$totalVentas;
              $cod6 = substr($productos[$i]["ID_prod"], -6);
              $rutaimg = "http://161.132.174.22:8088/Images/".$productos[$i]["ID_prod"]."/".$cod6."_1.jpg";

             echo '<li>

                    <a>

                    <img src="'.$rutaimg.'" class="img-thumbnail" width="60px" style="margin-right:10px">
                    '.$productos[$i]["descripcion"].'

                    <span class="pull-right text-'.$colores[$i].'">
                    '.ceil($porcentaje).'%
                    </span>

                    </a>

             </li>';

     }

     ?>

    </ul>

  </div>
  <!-- /.footer -->
</div>



<script>

// -------------
// - PIE CHART -
// -------------
// Get context with jQuery - using jQuery's .get() method.
var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
var pieChart       = new Chart(pieChartCanvas);
var PieData        = [

    <?php
    // $totl = count($productos);
    // echo $totl;

    for($i = 0; $i < 10; $i++){

    	echo "{
        value    : ".$productos[$i]["ventas"].",
        color    : '".$colores[$i]."',
        highlight: '".$colores[$i]."',
        label    : '".$productos[$i]["descripcion"]."'
      },";

    }

     ?>

];
var pieOptions     = {
// Boolean - Whether we should show a stroke on each segment
segmentShowStroke    : true,
// String - The colour of each segment stroke
segmentStrokeColor   : '#fff',
// Number - The width of each segment stroke
segmentStrokeWidth   : 2,
// Number - The percentage of the chart that we cut out of the middle
percentageInnerCutout: 50, // This is 0 for Pie charts
// Number - Amount of animation steps
animationSteps       : 100,
// String - Animation easing effect
animationEasing      : 'easeOutBounce',
// Boolean - Whether we animate the rotation of the Doughnut
animateRotate        : true,
// Boolean - Whether we animate scaling the Doughnut from the centre
animateScale         : false,
// Boolean - whether to make the chart responsive to window resizing
responsive           : true,
// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
maintainAspectRatio  : false,
// String - A legend template
legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
// String - A tooltip template
tooltipTemplate      : '<%=label%> : <%=value %>'
};
// Create pie or douhnut chart
// You can switch between pie and douhnut using the method below.
pieChart.Doughnut(PieData, pieOptions);
// -----------------
// - END PIE CHART -
// -----------------

</script>
