<?php

require_once "../vistas/bower_components/vendor/autoload.php";

//$ruta = "Demanda.xlsx";

/*=============================================
  GUARDAMOS EL EXCEL EN EL DIRECTORIO TEMPORAL
  =============================================*/

$destino = "../vistas/img/excel/" . $_FILES["archivo"]["name"];
$origen = $_FILES['archivo']['tmp_name'];
move_uploaded_file($origen, $destino);

//nueva ruta del excel
$ruta = $destino;

//OBTENIENDO COLUMNAS
$array1 = explode("-", $_POST["rangoColumnas"]);

$columna1 = $array1[0];
$columna2 = $array1[1];

//OBTENIENDO FILAS
$array2 = explode("-", $_POST["rangoFilas"]);
$fila1 = $array2[0];
$fila2 = $array2[1];

//para extension especifica
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");

$spreadsheet = $reader->load($ruta);

//establecer en que hoja se trabaja,
//getActiveSheet obtiene la hoja activa, por lo general es la primera.
//getSheet(1)=segunda hoja

$sheet = $spreadsheet->getActiveSheet();

//enviamos datos al siguiente formulario para mostrar la tabla
echo '
          <input type="hidden" name="ruta" value="' . $ruta . '">
          <input type="hidden" name="rangoColu" value="' . $_POST["rangoColumnas"] . '">
          <input type="hidden" name="rangoFi" value="' . $_POST["rangoFilas"] . '">';

foreach ($sheet->getRowIterator($fila1, $fila1) as $key => $value3) {
    $cellIterator = $value3->getCellIterator($columna1, $columna2);
    $cellIterator->setIterateOnlyExistingCells(false);

    foreach ($cellIterator as $key => $value4) {
        if (!is_null($value4)) {
            $vale = $value4->getCalculatedValue();

            //OBTENER LETRA DE LA COLUMNA ACTUAL (SE TIENE QUE CONVERTIR A NUMERO PARA ENVIO)
            $colu = $value4->getCoordinate();
            $letra = substr($colu, 0, 1);

            //OBTENIENDO NUMERO DE ACUERDO A LETRA
            $f = 1;
            for ($i = 65; $i <= 90; $i++) {
                $letter = chr($i);
                if ($letra == $letter) {
                    $letranume = $f;
                }
                $f++;
            }

            $datos = array(
                "descripcion" => $vale,
                "columna" => $letranume
            );



            echo '<div class="form-group row" id="' . $letranume . '">

              <div class="col-xs-8">

                  <div class="input-group">

                    <input type="text" class="form-control input-lg cambiarUrlRed" value="' . $vale . '">


                  </div>

                </div>

                <div class="col-xs-2">

                    <input type="checkbox" class="seleccionarColumna" colum="' . $letranume . '" valorExc="" checked>

                </div>

              </div>';
        }
    }
}

echo '
        <input type="text" id="valorExcel">
';
