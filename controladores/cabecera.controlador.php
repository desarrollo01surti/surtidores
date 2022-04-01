<?php

class ControladorCabecera{

			/*=============================================
			MOSTRAR CABECERA
			=============================================*/

			static public function ctrMostrarCabecera(){

				$tabla = "texc_pre_ingreso";

				$respuesta = ModeloCabecera::mdlMostrarCabecera($tabla);

				return $respuesta;

			}

			/*=============================================
			MOSTRAR RUTA
			=============================================*/

			static public function ctrMostrarRuta($item, $valor){

						$tabla = "texc_tabla_actual";

						$respuesta = ModeloCabecera::mdlMostrarRuta($tabla, $item, $valor);

						return $respuesta;

					}

			/*=============================================
			INGRESO DE CABECERA
			=============================================*/

			static public function ctrIngresoCabecera($datos){

        $tabla = "texc_pre_ingreso";

        $respuesta = ModeloCabecera::mdlIngresarCabecera($tabla, $datos);

				return $respuesta;

      }

			/*=============================================
			INGRESO RUTA
			=============================================*/

			static public function ctrIngresoRuta($datos){

						$tabla = "texc_tabla_actual";

						$respuesta = ModeloCabecera::mdlIngresarRuta($tabla, $datos);

						return $respuesta;

					}

  }
