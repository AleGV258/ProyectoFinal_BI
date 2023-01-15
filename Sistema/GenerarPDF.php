<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541

    require('fpdf.php');

    function integracionPDF($NombreArchivo, $TipoArchivo, $CErrores, $Insertados, $Total, $Filtro, $Errores, $Correo, $Usuario)
    {
        $PorcentajeInsertados = intval($Insertados / $Total * 100); // PorcentajeInsertados de datos insertados
        $PorcentajeErrores = intval($CErrores / $Total * 100); // PorcentajeInsertados de datos no insertados

        $pdf = new FPDF();              
        $pdf->AddPage(); // Width: 208

        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 20);
        $pdf->Cell(215, 3, "Proyecto Final Inteligencia de Negocios", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 27);
        $pdf->Cell(208, 3, "Materia:                                    ", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 27);
        $pdf->Cell(208, 3, "                    Inteligencia de Negocios", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 34);
        $pdf->Cell(208, 3, "Maestro:                                              ", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 34);
        $pdf->Cell(208, 3, utf8_decode("                       Paulin Martínez Francisco Javier"), 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 41);
        $pdf->Cell(208, 3, "Integrantes:", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 48);
        $pdf->Cell(208, 3, utf8_decode("- García Vargas Michell Alejandro - 259663"), 0, 2, 'C');
        $pdf->SetXY(0, 55);
        $pdf->Cell(208, 3, utf8_decode("- Jiménez Elizalde Andrés - 259678"), 0, 2, 'C');
        $pdf->SetXY(0, 62);
        $pdf->Cell(208, 3, utf8_decode("- León Paulin Daniel - 260541"), 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 69);
        $pdf->Cell(208, 3, "Grupo:                      Semestre:", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 69);
        $pdf->Cell(208, 3, "                       30                                   7mo.", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 76);
        $pdf->Cell(208, 3, "Fecha:                           ", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 76);
        $pdf->Cell(208, 3, "                    18 de enero del 2023", 0, 2, 'C');
        
        $pdf->SetFont('Arial', 'B', 36); $pdf->SetXY(0, 100);
        $pdf->Cell(215, 3, utf8_decode("Integración"), 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 122);
        $pdf->Cell(115, 3, "Usuario:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 122);
        $pdf->Cell(115, 3, $Usuario, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 129);
        $pdf->Cell(115, 3, "Correo:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 129);
        $pdf->Cell(115, 3, $Correo, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 136);
        $pdf->Cell(115, 3, "Nombre del Archivo:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 136);
        $pdf->Cell(115, 3, $NombreArchivo, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 143);
        $pdf->Cell(115, 3, "Tipo de Archivo:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 143);
        $pdf->Cell(115, 3, $TipoArchivo, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 150);
        $pdf->Cell(115, 3, "Total de Datos del Archivo:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 150);
        $pdf->Cell(115, 3, $Total, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 157);
        $pdf->Cell(115, 3, "Datos Insertados correctamente ($PorcentajeInsertados %).", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 164);
        $pdf->Cell(115, 3, "Datos Insertados en la Base de Datos:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 164);
        $pdf->Cell(115, 3, $Insertados, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 171);
        $pdf->Cell(115, 3, "Datos No Insertados($PorcentajeErrores %).", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 178);
        $pdf->Cell(115, 3, "Datos No Insertados en la Base de Datos:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 178);
        $pdf->Cell(115, 3, $CErrores, 0, 2, 'R');

        $Posicion = 185;
        for ($i = 0; $i < count($Errores); $i++) {
            if ($Filtro[$i] != 'NO') {

                $pdf->SetXY(50, $Posicion);
                $Posicion = $Posicion + 7;
                $pdf->Cell(115, 3, "Filtro '$Filtro[$i]': $Errores[$i] Errores Encontrados.", 0, 2, 'C');

            }
        }

        // Crear carpeta ArchivosPDF en caso de no existir
        $path = '../Sistema/ArchivosPDF';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $archivoPDF = $path . '/Reporte BI - Integración.pdf';
        $pdf->Output('F', $archivoPDF); // Guardar en carpeta archivosPDF

        // Envia reporte por correo
        enviarArchivoCorreo($archivoPDF);
    }

    function analisisPDF($tabla, $k, $j, $m, $a, $pronostico, $Correo, $Usuario)
    {
        $pdf = new FPDF();              
        $pdf->AddPage(); // Width: 208

        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 20);
        $pdf->Cell(215, 3, "Proyecto Final Inteligencia de Negocios", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 27);
        $pdf->Cell(208, 3, "Materia:                                    ", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 27);
        $pdf->Cell(208, 3, "                    Inteligencia de Negocios", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 34);
        $pdf->Cell(208, 3, "Maestro:                                              ", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 34);
        $pdf->Cell(208, 3, utf8_decode("                       Paulin Martínez Francisco Javier"), 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 41);
        $pdf->Cell(208, 3, "Integrantes:", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 48);
        $pdf->Cell(208, 3, utf8_decode("- García Vargas Michell Alejandro - 259663"), 0, 2, 'C');
        $pdf->SetXY(0, 55);
        $pdf->Cell(208, 3, utf8_decode("- Jiménez Elizalde Andrés - 259678"), 0, 2, 'C');
        $pdf->SetXY(0, 62);
        $pdf->Cell(208, 3, utf8_decode("- León Paulin Daniel - 260541"), 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 69);
        $pdf->Cell(208, 3, "Grupo:                      Semestre:", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 69);
        $pdf->Cell(208, 3, "                       30                                   7mo.", 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(0, 76);
        $pdf->Cell(208, 3, "Fecha:                           ", 0, 2, 'C');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(0, 76);
        $pdf->Cell(208, 3, "                    18 de enero del 2023", 0, 2, 'C');
        
        $pdf->SetFont('Arial', 'B', 36); $pdf->SetXY(0, 100);
        $pdf->Cell(215, 3, utf8_decode("Análisis"), 0, 2, 'C');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 122);
        $pdf->Cell(115, 3, "Usuario:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 122);
        $pdf->Cell(115, 3, $Usuario, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 129);
        $pdf->Cell(115, 3, "Correo:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 129);
        $pdf->Cell(115, 3, $Correo, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 136);
        $pdf->Cell(115, 3, "Tabla Analizada:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 136);
        $pdf->Cell(115, 3, $tabla, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 143);
        $pdf->Cell(115, 3, "Valor de K:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 143);
        $pdf->Cell(115, 3, $k, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 150);
        $pdf->Cell(115, 3, "Valor de J:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 150);
        $pdf->Cell(115, 3, $j, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 157);
        $pdf->Cell(115, 3, "Valor de M:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 157);
        $pdf->Cell(115, 3, $m, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 164);
        $pdf->Cell(115, 3, "Valor de A (Alfa):", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 164);
        $pdf->Cell(115, 3, $a, 0, 2, 'R');
        $pdf->SetFont('Arial', 'B', 14); $pdf->SetXY(50, 171);
        $pdf->Cell(115, 3, "Valor de Pronostico:", 0, 2, 'L');
        $pdf->SetFont('Arial', '', 14); $pdf->SetXY(50, 171);
        $pdf->Cell(115, 3, $pronostico, 0, 2, 'R');

        // Crear carpeta ArchivosPDF en caso de no existir
        $path = '../Sistema/ArchivosPDF';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $archivoPDF =  $path . '/Reporte BI - Análisis.pdf';
        $pdf->Output('F', $archivoPDF); // Guardar en carpeta archivosPDF
        // Envia reporte por correo
        enviarArchivoCorreo($archivoPDF);
    }
?>
