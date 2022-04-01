<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', "C:/xampp2/htdocs/surtidores/php_error_log");

require_once "controladores/plantilla.controlador.php";

require_once "controladores/cabecera.controlador.php";
require_once "controladores/tablaexcel.controlador.php";
require_once "controladores/area.controlador.php";
require_once "controladores/modulos.controlador.php";
require_once "controladores/perfiles.controlador.php";
require_once "controladores/permisos.controlador.php";
require_once "controladores/empresas.controlador.php";
require_once "controladores/sucursal.controlador.php";
require_once "controladores/empleado.controlador.php";
require_once "controladores/usuario.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/movimientosimp.controlador.php";
require_once "controladores/proveedor.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/notificaciones.controlador.php";
require_once "controladores/consultareclamo.controlador.php";
require_once "controladores/tickets.controlador.php";
require_once "controladores/roles.controlador.php";
require_once "controladores/orden.controlador.php";

require_once "modelos/cabecera.modelo.php";
require_once "modelos/tablaexcel.modelo.php";
require_once "modelos/area.modelo.php";
require_once "modelos/modulos.modelo.php";
require_once "modelos/perfiles.modelo.php";
require_once "modelos/permisos.modelo.php";
require_once "modelos/empresas.modelo.php";
require_once "modelos/sucursal.modelo.php";
require_once "modelos/empleado.modelo.php";
require_once "modelos/usuario.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/movimientosimp.modelo.php";
require_once "modelos/proveedor.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/notificaciones.modelo.php";
require_once "modelos/reclamaciones.modelo.php";
require_once "modelos/tickets.modelo.php";
require_once "modelos/roles.modelo.php";
require_once "modelos/orden.modelo.php";

require_once "modelos/rutas.php";

$plantilla = new ControladorPlantilla();
$plantilla->plantilla();
