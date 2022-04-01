<?php

require_once "vistas/bower_components/vendor/autoload.php";

class ControladorTablaExcel{

			/*=============================================
			MOSTRAR CABECERA
			=============================================*/

			static public function ctrCrearTablaExcel(){

        if(isset($_POST["nombreTabla"])){

          $nomtabla = $_POST["nombreTabla"];

					$existe = ModeloTablaExcel::mdlValidarTabla($nomtabla);

					if ($existe != "") {

							echo'<script>

							swal({
									type: "error",
									title: "Ya existe una tabla con el mismo nombre, intente con otro nombre nombre",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
									}).then(function(result){
											if (result.value) {

											window.location = "importexcel";

											}
										})

							</script>';

					}else{


						$respuesta = ModeloTablaExcel::mdlCrearTablaExcel($nomtabla);

	          if ($respuesta == "ok"){

							if ($_POST["valorExcel"] != ""){//validamos si existe el dato JSON en el input

								$listaValores = json_decode($_POST["valorExcel"], true);

								foreach ($listaValores as $key => $value) {

									if ($value["activo"] == 1) {

										$nombre = trim($value["nombre"]);

										$respuesta2 = ModeloTablaExcel::mdlAddCamposTabla($nomtabla, $nombre);

									}

								}

								//GUARDANDO LA INFORMACION Y ELIMINANDO COLUMNAS NO CHECKEADAS

								$item = "codigo";
								$valor = $_POST["codigo"];
								$rutaActual = ControladorCabecera::ctrMostrarRuta($item, $valor);

								$sinpunto = str_replace('../', '', $rutaActual["ruta"]);

								$ruta = $sinpunto;

								//OBTENIENDO COLUMNAS
								$array1 = explode("-", $rutaActual["rangoColum"]);

								$columna1 = $array1[0];
								$columna2 = $array1[1];

								//OBTENIENDO FILAS
								$array2 = explode("-", $rutaActual["rangoFila"]);
								$fila1 = $array2[0];
								$fila2 = $array2[1];

								//para extension especifica
								$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");

								$spreadsheet = $reader->load($ruta);

								$sheet = $spreadsheet->getActiveSheet();

								//ELIMINAR COLUMNAS NO SELECCIONADAS (N° columna inicial,Conteo hacia la derecha)
								// $sheet->removeColumnByIndex(4,1);
								//SE INVIERTE EL ORDEN DE LECTURA DEL JSON
								$reversa= array_reverse($listaValores);
								$contar = 0;
								foreach ($reversa as $key => $value2) {

									if ($value2["activo"] == 0) {

										$sheet->removeColumnByIndex($value2["columna"], 1);
										$contar = $contar+1;

									}

								}

								//restar a la ultima columna la cantidad de eliminados
								$ultimacolum = ModeloCabecera::mdlMostrarMaxColum();
								$resta = $ultimacolum["col"] - $contar;
								$suma = 64+$resta; //64 es la letra A de chr();
								$letterfin = chr($suma); //obteniendo la letra FINAL con chr();


								//QUITAMOS LA PRIMERA FILA

								$filainicio = number_format($fila1)+1;

								$data = "";
								foreach ($sheet->getRowIterator($filainicio,$fila2) as $key => $value1) {
									 $cellIterator = $value1->getCellIterator($columna1,$letterfin);
									 $cellIterator->setIterateOnlyExistingCells(false);

									 foreach ($cellIterator as $key => $value2) {
										 if (!is_null($value2)) {

												$val = $value2->getCalculatedValue();

												$data .= "'".$val."',";//concatenamos el valor con comillas simples y coma al final

										 }

									 }

									 $sincoma = "NULL,".rtrim($data, ","); //Eliminamos la ultima coma y agregamos NULL para el id de la tabla que es AI,

									 // Insertamos todos los registros

									 $sql = ModeloTablaExcel::mdlInsertarDatos($nomtabla, $sincoma);

									 $data = "";

								}

								//VACIAMOS LA TABLA TEMPORAL "PRE_INGRESO"
								$tabla = "texc_pre_ingreso";
								$req = ModeloTablaExcel::mdlVaciarTablaTemporal($tabla);

								if ($sql == "ok"){

									echo'<script>

									swal({
											type: "success",
											title: "La tabla se generó correctamente",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"
											}).then(function(result){
													if (result.value) {

													window.location = "importexcel";

													}
												})

									</script>';

								}

							}else{

									echo'<script>

									swal({
											type: "error",
											title: "La tabla debe contener datos",
											showConfirmButton: true,
											confirmButtonText: "Cerrar"
											}).then(function(result){
													if (result.value) {

													window.location = "importexcel";

													}
												})

									</script>';

							}




	          }


					}



        }


			}

    }
