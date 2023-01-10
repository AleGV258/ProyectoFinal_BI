<?php

    /* 
    Nombre: Michell Alejandro García Vargas
    Expediente: 259663
    Grupo: 30
    Semestre: 7mo
    */

    // (A) LOAD PHPSPREADSHEET LIBRARY
    require "vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    
    // (B) READ FILE
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load("2011+/AGEEML_202211281517390.xlsx");

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    
    // (C) READ CELLS
    $sheet = $spreadsheet->getActiveSheet();

    $Contador = 0;
    foreach($sheet->getRowIterator() as $ManejadorXLSX){
        $Contador++;
        if($Contador > 3){
            $Valores = "'',";
            $cellIterator = $ManejadorXLSX->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);
            foreach($cellIterator as $cell){
                if(!is_null($cell)){
                    $value = $cell->getCalculatedValue();
                    if(strpos($value, "'")){
                        $Valores = $Valores."\"".$value."\",";
                    }else{
                        $Valores = $Valores."'".$value."',";
                    }
                }
            }
            $Valores = substr($Valores, 0, -1);
            $SQL = "INSERT INTO mar11 VALUES (".$Valores.");";
            print(($Contador-3)." - ".$SQL."<br><br>");
            mysqli_query($Con, $SQL);
        }
    }

    mysqli_close($Con);

?>