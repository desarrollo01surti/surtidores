<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class AjaxProductosProve
{

    /*=============================================
    CONSULTA PRODUCTOS POR PROVEEDOR SELECCIONADO
    =============================================*/
    public $idProveedor;

    public function ajaxConsultaProductosProve()
    {

        $valor = $this->idProveedor;

        $productos = ControladorProductos::ctrMostrarProductosProve($valor);

        echo '<option value="0">Buscar Producto</option>';


        foreach ($productos as $key => $value) {

            echo '<option value="' . $value["id_provprod"] . '">' . $value["ID_prod"] . ' - ' . $value["descripcion"] . '</option>';
        }
    }

    /*=============================================
    CONSULTA PRECIO DE PRODUCTO SELECCIONADO
    =============================================*/
    public $idProvProd;

    public function ajaxConsultaPrecioProd()
    {

        $valor = $this->idProvProd;

        $respuesta = ControladorProductos::ctrMostrarPreciosProd($valor);

        echo json_encode($respuesta);
    }

    /*=============================================
    CONSULTA PROVEEDORES
    =============================================*/
    public $idProv;

    public function ajaxConsultaProveedores()
    {

        $valor = $this->idProv;
        $item = "id_proveedor";

        $respuesta = ControladorProveedor::ctrMostrarProveedor($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
  CONSULTA PRODUCTOS POR PROVEEDOR SELECCIONADO
  =============================================*/
if (isset($_POST["idProveedor"])) {

    $mostrarProductosProve = new AjaxProductosProve();
    $mostrarProductosProve->idProveedor = $_POST["idProveedor"];
    $mostrarProductosProve->ajaxConsultaProductosProve();
}


/*=============================================
  CONSULTA PRECIO DE PRODUCTO SELECCIONADO
  =============================================*/
if (isset($_POST["idProvProd"])) {

    $mostrarPrecioProductos = new AjaxProductosProve();
    $mostrarPrecioProductos->idProvProd = $_POST["idProvProd"];
    $mostrarPrecioProductos->ajaxConsultaPrecioProd();
}

/*=============================================
  DEVOLVER PROVEEDORES
  =============================================*/
if (isset($_POST["idProv"])) {

    $mostrarProveedores = new AjaxProductosProve();
    $mostrarProveedores->idProv = $_POST["idProv"];
    $mostrarProveedores->ajaxConsultaProveedores();
}
