 <!-- main-header -->
 <header class="main-header">

	<!-- logo -->
    <a href="inicio" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini logoSmall"><img src="vistas/img/plantilla/favicon.ico" class="img-responsive"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg logoGrande"><img src="vistas/img/plantilla/logo.png" class="img-responsive"></span>

    </a>
    <!-- logo -->

     <!-- navbar -->
    <nav class="navbar navbar-static-top" role="navigation">

		 <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <!-- <input type="text" id="caja_busqueda" class="form-control buscar" placeholder="Buscar Producto"> -->
              
              <!-- buscar producto a futuro v2 -->
              <!-- <input type="text" class="form-control buscar" id="navbar-search-input" placeholder="Buscar Producto"> -->
            </div>
            <div id="display"></div>
          </form>
        </div>

		<!-- navbar-custom-menu -->
    	<div class="navbar-custom-menu">
        <!-- <ul class="nav navbar-nav left">

        </ul> -->

    		<ul class="nav navbar-nav">

          <!-- <li>
            <form method="post" class="sidebar-form">
                    <div class="input-group input-group-sm">
                      <input type="text" name="" id="caja_busqueda" class="form-control buscar" placeholder="Buscar Producto">
                    </div>
                    <div id="display"></div>

            </form>
          </li> -->

				<?php

					include "cabezote/notificaciones.php";

					include "cabezote/usuario.php";

				?>

    		</ul>

    	</div>
		<!-- navbar-custom-menu -->

    </nav>
    <!-- navbar -->

 </header>
 <!-- main-header -->
