<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxAcceder
{

    /*=============================================
    CONSULTA ACCESO AL SISTEMA
    =============================================*/
    public $idSucursal;
    public $idPerfil;
    public $idUsuario;

    public function ajaxConsultaAccesoSistema()
    {

        $sucursal = $this->idSucursal;
    }

    /*=============================================
    CONSULTA BUSQUEDA DE PRODUCTOS
    =============================================*/
    public $texto;

    public function ajaxConsultaProductos()
    {

        $item = "codigo";
        $valor = $this->texto;
        $nuevoVal = "%" . $valor . "%";

        $respuesta = ControladorProductos::ctrMostrarProductosLike($item, $nuevoVal);

        foreach ($respuesta as $key => $value) {

            echo '<a href="" style="text-decoration:none;" > <!--Recuperamos el id para pasarlo a otra pagina -->
                     <div class="display_box" align="left">
                       <div style="float:left; margin-right:6px;"><img src="' . $value["url"] . '" width="60" height="60" /></div> <!--Colocamos la foto Recuperada de la bd -->
                       <div style="margin-center:6px;"><b>' . $value["nombre"] . '</b></div> <!--Recuperamos el nombre recuperado de la bd -->
                       <div style="margin-right:6px; font-size:14px;" class="desc">' . $value["codigo"] . '</div> <!--Recuperamos la direccion recuperada de la bd -->
                     </div>
               </a>';
        }
    }
}

/*=============================================
  CONSULTA ACCESO AL SISTEMA
  =============================================*/
if (isset($_POST["idSucursal"])) {

    $validarAcceso = new AjaxAcceder();
    $validarAcceso->idSucursal = $_POST["idSucursal"];
    $validarAcceso->ajaxConsultaAccesoSistema();
}

/*=============================================
  CONSULTA BUSQUEDA DE PRODUCTOS
  =============================================*/
if (isset($_POST["texto"])) {

    $buscarProducto = new AjaxAcceder();
    $buscarProducto->texto = $_POST["texto"];
    $buscarProducto->ajaxConsultaProductos();
}
