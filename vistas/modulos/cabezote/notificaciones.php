<?php
//SUMATORIA DE NOTIFICACIONES POR USUARIO
$notificaciones = ControladorNotificaciones::ctrMostrarNotificaciones("cod_empleado", $_SESSION["idUsuario"]);

$totalNotificaciones = 0;

if ($notificaciones) {

	foreach ($notificaciones as $key => $valueNot) {

	   $totalNotificaciones += (int)$valueNot["nueva_not"];

	}

}else{

	$totalNotificaciones;

}

?>

<!--=====================================
NOTIFICACIONES
======================================-->

<!-- notifications-menu -->
<li class="dropdown notifications-menu">

	<!-- dropdown-toggle -->
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">

		<i class="fa fa-bell-o"></i>

		<?php if ($totalNotificaciones != 0): ?>

      <span class="label label-danger"><?php  echo $totalNotificaciones; ?></span>

		<?php endif; ?>

	</a>
	<!-- dropdown-toggle -->

	<!--dropdown-menu -->
	<ul class="dropdown-menu">

		<li class="header">Tu tienes <?php  echo $totalNotificaciones; ?> notificaciones</li>

		<li>
			<!-- menu -->
			<ul class="menu">


        <?php if ($notificaciones): ?>

					<?php foreach ($notificaciones as $key => $val): ?>

						<?php if ($val["tipo"] == "ticket"): ?>

							<!-- Tickets -->
							<li>

								<a href="" class="actualizarNotificaciones" tipo="ticket" codnot="<?php  echo $val["id_not"] ?>">

									<i class="fa fa-file text-aqua"></i> <?php  echo $val["nueva_not"] ?> nuevos tickets asignados

								</a>

							</li>

						<?php else: ?>

								<!-- Reclamos -->
								<li>

									<a href="" class="actualizarNotificaciones" tipo="reclamo" codnot="<?php  echo $val["id_not"] ?>">

										<i class="fa fa-book text-aqua"></i>  <?php  echo $val["nueva_not"] ?> nuevos reclamos asignados

									</a>

								</li>


						<?php endif; ?>

					<?php endforeach; ?>

        <?php endif; ?>

			</ul>
			<!-- menu -->

		</li>

	</ul>
	<!--dropdown-menu -->

</li>
<!-- notifications-menu -->
