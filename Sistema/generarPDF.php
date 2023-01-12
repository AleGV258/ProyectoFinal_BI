<?php
require('fpdf.php');
// require('./EnviarCorreo.php'); //SE DEBE PONER ANTES DEL REQUIRE DE generarPDF POR QUE SINO NO LO IMPLEMENTA BIEN

function integracionPDF($NombreArchivo, $TipoArchivo, $Errores, $Insertados, $Total)
{
    $PorcentajeInsertados = intval($Insertados / $Total * 100); //PorcentajeInsertados de datos insertados
    $PorcentajeErrores = intval($Errores / $Total * 100); //PorcentajeInsertados de datos no insertados


    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);


    $pdf->SetXY(31, 20);
    $pdf->Cell(25, 3, 'Nombre del archivo: ' . $NombreArchivo, 0, 2, 'L');
    $pdf->SetXY(31, 27);
    $pdf->Cell(25, 3, 'Tipo de archivo: ' . $TipoArchivo, 0, 2, 'L');

    $pdf->SetXY(31, 45);
    $pdf->Cell(25, 3, 'Total de datos que contiene el archivo: ' . $Total, 0, 2, 'L');
    // $pdf->Cell(25, 5, $Total, 0, 0, 'L');

    $pdf->SetXY(31, 54);
    $pdf->Cell(25, 3, 'Datos Insertados correctamente (' . $PorcentajeInsertados . '%).', 0, 2, 'L');
    $pdf->SetXY(48, 60);
    $pdf->Cell(25, 3, $Insertados . ' datos insertados a la base de datos.', 0, 2, 'L');

    $pdf->SetXY(31, 70);
    $pdf->Cell(25, 3, 'Datos no insertados(' . $PorcentajeErrores . '%).', 0, 2, 'L');
    $pdf->SetXY(48, 76);
    $pdf->Cell(25, 3, $Errores . ' datos no insertados debido a un error.', 0, 2, 'L');


    // $pdf->Output();
    //Crear carpeta archivosPDF en caso de no existir
    $path = './archivosPDF';
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    $archivoPDF =  $path . '/' . $NombreArchivo . '.pdf';
    $pdf->Output('F', $archivoPDF); //Guardar en carpeta archivosPDF

    // Envia reporte por correo
    enviarArchivoCorreo($archivoPDF);
}
function analisisPDF($tabla, $k, $j, $m, $a, $pronostico, $Correo, $Usuario)
{
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    $pdf->SetXY(31, 20);
    $pdf->Cell(25, 3, "Usuario: '" . $Usuario . "'", 0, 2, 'L');

    $pdf->SetXY(31, 30);
    $pdf->Cell(25, 3, "Correo: " .  $Correo, 0, 2, 'L');
    $pdf->SetXY(31, 40);
    $pdf->Cell(25, 3, 'Tabla analizada: ' . $tabla, 0, 2, 'L');
    $pdf->SetXY(31, 50);
    $pdf->Cell(25, 3, 'Valor de K: ' . $k, 0, 2, 'L');
    $pdf->SetXY(31, 60);
    $pdf->Cell(25, 3, 'Valor de J: ' . $j, 0, 2, 'L');
    $pdf->SetXY(31, 70);
    $pdf->Cell(25, 3, 'Valor de M: ' . $m, 0, 2, 'L');
    $pdf->SetXY(31, 80);
    $pdf->Cell(25, 3, 'Valor de a: ' . $a, 0, 2, 'L');
    $pdf->SetXY(31, 90);
    $pdf->Cell(25, 3, 'Valor de pronostico: ' . $pronostico, 0, 2, 'L');

    $path = './archivosPDF';
    if (!file_exists($path)) {
        mkdir($path, 0777, true);
    }
    $analisis = 'analisis';

    $archivoPDF =  $path . '/' . $analisis . '.pdf';
    $pdf->Output('F', $archivoPDF); //Guardar en carpeta archivosPDF
    // Envia reporte por correo
    enviarArchivoCorreo($archivoPDF);
}
// analisisPDF('$tabla', ' $k', '$j', '$m', '$a', '$pronostico');
// integracionPDF("ArchivoX", "FBX", 10, 90, 100);
