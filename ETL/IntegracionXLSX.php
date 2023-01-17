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
    
    // (C) READ CELLS
    $sheet = $spreadsheet->getActiveSheet();

    $Contador = 0;
    $Contador2 = 0;
    foreach($sheet->getRowIterator() as $ManejadorXLSX){
        $Contador++;
        if($Contador > 4){
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
    }
    
    mysqli_close($Con);
    unlink($Archivo);
    $Total = $Contador;
    $Insertados = $Contador2;
    $Errores = $Contador - $Contador2;
    $array = array($NombreArchivo, $TipoArchivo, $Total, $Insertados, $Errores, $array);
    $_SESSION['arrayEstadisticas'] = $array;
    header("Location: ../Sistema/Estadisticas.php");
?>