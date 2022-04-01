<!-- <form method="post" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="" id="caja_busqueda" class="form-control buscar" placeholder="Buscar Producto">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
				<div id="display"></div>
</form> -->
<!--=====================================
MENU
======================================-->

<ul class="sidebar-menu" data-widget="tree">

	<li class="active"><a href="inicio"><i class="fa fa-home"></i> <span>Inicio</span></a></li>

	<?php

	$item = null;
	$valor = null;

	$modulos = ControladorModulos::ctrMostrarModulos($item, $valor);

	//SI EL PERFIL ES SUPERADMIN SE DA ACCESO SIN RESTRICCION
	if ($_SESSION["idPerfil"] == 1) {

		foreach ($modulos as $key => $value) {

			//VALIDAR SI EL MODULO TIENE SUBMODULOS
			$item = "idmodulo";
			$valor = $value["idmodulo"];
			$valida = ControladorModulos::ctrValidarsubModulos($item, $valor);

			//SE MUESTRAN LOS SUBMODULOS
			if ($valida) {

				$item = "idmodulo";
				$valor = $value["idmodulo"];
				$submodulos = ControladorModulos::ctrMostrarSubModulos($item, $valor);

				echo '<li class="treeview">

											<a href="#">
												<i class="fa ' . $value["icono"] . '"></i>
												<span>' . $value["descripcion"] . '</span>
												<span class="pull-right-container">
														<i class="fa fa-angle-left pull-right"></i>
												</span>
											</a>

											<ul class="treeview-menu">';

				foreach ($submodulos as $key => $value2) {

					//VALIDAR SI EL SUBMODULO TIENE TRIMODULO
					$item2 = "idsubmod";
					$valor2 = $value2["idsubmod"];
					$valida2 = ControladorModulos::ctrValidartriModulos($item2, $valor2);

					//SE MUESTRAN LOS TRIMODULOS
					if ($valida2) {

						$item3 = "idsubmod";
						$valor3 = $value2["idsubmod"];
						$trimodulos = ControladorModulos::ctrMostrarTriModulos($item3, $valor3);

						echo '<li class="treeview" style="height: auto;">
																	<a href="#"><i class="fa fa-circle-o"></i> ' . $value2["descripcion"] . '
																			 <span class="pull-right-container">
																				 <i class="fa fa-angle-left pull-right"></i>
																			 </span>
																	 </a>
																	 <ul class="treeview-menu" style="display: none;">';

						foreach ($trimodulos as $key => $value3) {

							echo   '<li><a href="' . $value3["ruta"] . '"><i class="fa fa-circle-o"></i> ' . $value3["descripcion"] . '</a></li>';
						}

						echo '</ul>
															</li>';
					} else { //SE MUESTRAN SOLO LOS SUBMODULOS

						echo '<li><a href="' . $value2["ruta"] . '"><i class="fa fa-circle-o"></i> ' . $value2["descripcion"] . '</a></li>';
					}
				}

				echo '</ul>

							</li>';
			} else { //SE MUESTRAN SOLO LOS MODULOS

				echo '<li><a href="' . $value["ruta"] . '"><i class="fa fa-files-o"></i> <span>' . $value["descripcion"] . '</span></a></li>';
			}
		}
	} else { //SI EL PERFIL ES DIFERENTE A SUPERADMIN SE RESTRINGE ACCESOS SEGUN BASE DE DATOS

		foreach ($modulos as $key => $value) {

			//VALIDAR SI EL MODULO TIENE SUBMODULOS
			$item = "idmodulo";
			$valor = $value["idmodulo"];
			$valida = ControladorModulos::ctrValidarsubModulos($item, $valor);

			//DEVOLVER ACCESOS DE LA BASE DE DATOS
			$listaAccesos = ControladorPerfiles::ctrConsultaPerfil($_SESSION["idPerfil"]);

			$listaAc = json_decode($listaAccesos["accesos"], true);

			//SE MUESTRAN LOS SUBMODULOS
			if ($valida) {

				$item = "idmodulo";
				$valor = $value["idmodulo"];
				$submodulos = ControladorModulos::ctrMostrarSubModulos($item, $valor);

				if (!is_null($listaAc)) { //SE VALIDA SI VIENEN DATOS VACIOS

					foreach ($listaAc as $key => $valorr) {

						if ($valorr["modulo"] == "modulo" && $value["descripcion"] == $valorr["nombre"] && $valorr["activo"] == "1") {

							echo '<li class="treeview">

														<a href="#">
															<i class="fa ' . $value["icono"] . '"></i>
															<span>' . $value["descripcion"] . '</span>
															<span class="pull-right-container">
																	<i class="fa fa-angle-left pull-right"></i>
															</span>
														</a>

														<ul class="treeview-menu">';

							foreach ($submodulos as $key => $value2) {

								//VALIDAR SI EL SUBMODULO TIENE TRIMODULO
								$item2 = "idsubmod";
								$valor2 = $value2["idsubmod"];
								$valida2 = ControladorModulos::ctrValidartriModulos($item2, $valor2);

								//SE MUESTRAN LOS TRIMODULOS
								if ($valida2) {

									$item3 = "idsubmod";
									$valor3 = $value2["idsubmod"];
									$trimodulos = ControladorModulos::ctrMostrarTriModulos($item3, $valor3);


									foreach ($listaAc as $key => $valorq) {

										if ($valorq["modulo"] == "submodulo" && $value2["descripcion"] == $valorq["nombre"] && $valorq["activo"] == "1") {

											echo '<li class="treeview" style="height: auto;">
		 																					 <a href="#"><i class="fa fa-circle-o"></i> ' . $value2["descripcion"] . '
		 																								<span class="pull-right-container">
		 																									<i class="fa fa-angle-left pull-right"></i>
		 																								</span>
		 																						</a>
		 																						<ul class="treeview-menu" style="display: none;">';

											foreach ($trimodulos as $key => $value3) {

												foreach ($listaAc as $key => $valorqq) {

													if ($valorqq["modulo"] == "trimodulo" && $value3["descripcion"] == $valorqq["nombre"] && $valorqq["activo"] == "1") {

														echo   '<li><a href="' . $value3["ruta"] . '"><i class="fa fa-circle-o"></i> ' . $value3["descripcion"] . '</a></li>';
													}
												}
											}

											echo '</ul>

		 																			 </li>';
										}
									}
								} else { //SE MUESTRAN SOLO LOS SUBMODULOS

									foreach ($listaAc as $key => $valores) {

										if ($valores["modulo"] == "submodulo") {

											if ($valores["id"] == $value2["idsubmod"] && $valores["activo"] == "1") {

												echo '<li><a href="' . $value2["ruta"] . '"><i class="fa fa-circle-o"></i> ' . $value2["descripcion"] . '</a></li>';
											}
										}
									}
								}
							}

							echo '</ul>

										</li>';
						}
					}
				}
			} else { //SE MUESTRAN SOLO LOS MODULOS

				foreach ($listaAc as $key => $valor) {

					if ($valor["modulo"] == "modulo") {

						if ($valor["id"] == $value["idmodulo"] && $valor["activo"] == "1") {

							echo '<li><a href="' . $value["ruta"] . '"><i class="fa ' . $value["icono"] . '"></i> <span>' . $value["descripcion"] . '</span></a></li>';
						}
					}
				}
			}
		}
	}



	?>

</ul>