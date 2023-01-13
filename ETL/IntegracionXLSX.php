<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    // (A) LOAD PHPSPREADSHEET LIBRARY
    require "vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    session_start();
    $Archivo = $_SESSION['ArchivoSubido'];
    $NombreArchivo = $_SESSION['ArchivoNombre'];
    $TipoArchivo = $_SESSION['ArchivoExtension'];
    
    // (B) READ FILE
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
    $spreadsheet = $reader->load($Archivo);

    $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    // Reestablecer Tabla
    mysqli_query($Con, "TRUNCATE mar11;");
    
    // (C) READ CELLS
    $sheet = $spreadsheet->getActiveSheet();

    $Contador = 0;
    $Contador2 = 0;
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
            $Contador2++;
            $Valores = substr($Valores, 0, -1);
            $SQL = "INSERT INTO mar11 VALUES (".$Valores.");";
            mysqli_query($Con, $SQL);
        }
        $Total = $Contador;
        $Insertados = $Contador2;
        $Errores = $Contador - $Contador2;
        $array = array($NombreArchivo, $TipoArchivo, $Total, $Insertados, $Errores, $array);
        $_SESSION['arrayEstadisticas'] = $array;
    }

    mysqli_close($Con);
    unlink($Archivo);
    header("Location: ../Sistema/Estadisticas.php");

?>

// require "vendor/autoload.php";
    // use PhpOffice\PhpSpreadsheet\Spreadsheet;

    // session_start();
    // $Archivo = $_SESSION['ArchivoSubido'];
    // // echo $Archivo;
    // require 'vendor/autoload.php';

    // use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

    // $path = $Archivo;
    // # open the file
    // $reader = ReaderEntityFactory::createXLSXReader();
    // $reader->open($path);

    // $Con = mysqli_connect('127.0.0.1', 'root', '', 'cucage');
    // mysqli_query($Con, "TRUNCATE mar11;");
  
    // foreach ($reader->getSheetIterator() as $sheet) {
    //     $contador=1;
    //     $Contador2 = 0;
    //     foreach ($sheet->getRowIterator() as $row) {
    //         if($contador >4){
                
    //             $Valores = "'',";
    //             foreach ($row->getCells() as $cell) {
    //                 $valor = str_replace("'", "\'", $cell->getValue());
    //                 $Valores = $Valores . "'" . $valor . "',";
    //                 // var_dump($cell->getValue());
    //                 //echo $cell->getValue();
    //             }
    //             $Valores = substr($Valores, 0, -1);
                
    //             $SQL = "INSERT INTO mar11 VALUES (".$Valores.");";
    //             // echo $SQL . "<br>";

    //             $Result = mysqli_query($Con, $SQL);
    //             // // if($Result <> 0){
    //             // echo $Result . "<br>";
    //             // // }                            
    //         }
    //         $contador ++;
    //         $Contador2 ++;
    //     }
    // }
    // $reader->close();
    // mysqli_close($Con);