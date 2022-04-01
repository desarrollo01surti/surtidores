<!--=====================================
USUARIOS
======================================-->

<!-- user-menu -->
<li class="dropdown user user-menu">

	<!-- dropdown-toggle -->
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">

		<?php

				if ($_SESSION["foto"] != "") {

						echo '<img class="user-image" src="'.$_SESSION["foto"].'" alt="User Image">';

				}else{

						echo '<img class="user-image" src="vistas/img/usuarios/default/anonymous.png" alt="User Image">';

				}

		 ?>

		<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>

	</a>
	<!-- dropdown-toggle -->

	<!-- dropdown-menu -->
	<ul class="dropdown-menu">

		<li class="user-header">

			<?php

					if ($_SESSION["foto"] != "") {

							echo '<img src="'.$_SESSION["foto"].'" class="img-circle" alt="User Image">';

					}else{

							echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle" alt="User Image">';

					}

			 ?>
      <p>
      <?php echo $_SESSION["nombre"]." - ".$_SESSION["perfil"]; ?>
			</p>

			<p id="SucursalPrinc"></p>

		</li>

		<li class="user-footer">

			<div class="pull-left">

				<a href="acceder" class="btn btn-default btn-flat">Cambiar Sucursal</a>

			</div>

			<div class="pull-right">

				<a href="salir" class="btn btn-default btn-flat">Salir</a>

			</div>
		</li>

	</ul>
	<!-- dropdown-menu -->

</li>
<!-- user-menu -->
