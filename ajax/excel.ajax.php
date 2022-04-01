<?php

require_once "../vistas/bower_components/vendor/autoload.php";

    //$ruta = "Demanda.xlsx";
    $ruta = $_POST["ruta"];

    //OBTENIENDO COLUMNAS
    $array1 = explode("-", $_POST["rangoColu"]);

    $columna1 = $array1[0];
    $columna2 = $array1[1];

    //OBTENIENDO FILAS
    $array2 = explode("-", $_POST["rangoFi"]);
    $fila1 = $array2[0];
    $fila2 = $array2[1];


    //para extension especifica
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");

    $spreadsheet = $reader->load($ruta);

    //establecer en que hoja se trabaja,
    //getActiveSheet obtiene la hoja activa, por lo general es la primera.
    //getSheet(1)=segunda hoja

    $sheet = $spreadsheet->getActiveSheet();

    //$sheet = $spreadsheet->getSheet(0);
    //$sheet = $spreadsheet->getSheetByName("hojaprecios");

    //ELIMINAR COLUMNAS NO SELECCIONADAS (N° columna inicial,Conteo hacia la derecha)
    $sheet->removeColumnByIndex(4,1);


    //OBTENER SOLO PRIMERA FILA QUE ES LA CABECERA DE LA TABLA ($fila1)
    echo'<table class="table-bordered table-striped dt-responsive tablas" width="100%">
              <thead>
                  <tr>';
              foreach ($sheet->getRowIterator($fila1,$fila1) as $key => $value3) {
                 $cellIterator = $value3->getCellIterator($columna1,$columna2);
                 $cellIterator->setIterateOnlyExistingCells(false);

                 foreach ($cellIterator as $key => $value4) {
                   if (!is_null($value4)) {
                      $vale = $value4->getCalculatedValue();
                      echo '<th>'.$vale.'</th>';
                   }
                 }
                 echo '</tr>';
              }

        echo '</thead>
              <tbody>
                 <tr>';

    //QUITAMOS LA PRIMERA FILA

    $filainicio = number_format($fila1)+1;

    foreach ($sheet->getRowIterator($filainicio,$fila2) as $key => $value1) {
       $cellIterator = $value1->getCellIterator($columna1,$columna2);
       $cellIterator->setIterateOnlyExistingCells(false);


       foreach ($cellIterator as $key => $value2) {
         if (!is_null($value2)) {
            $val = $value2->getCalculatedValue();
            echo '<td>'.$val.'</td>';
         }
       }
           echo '</tr>';
    }


    echo '</tbody>
     </table>';



?>
