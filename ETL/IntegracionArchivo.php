<?php

    // PROYECTO FINAL
    // MATERIA: Inteligencia de Negocios 
    // INTEGRANTES: 
    //     - García Vargas Michell Alejandro - 259663
    //     - Jiménez Elizalde Andrés - 259678
    //     - León Paulin Daniel - 260541
    
    if(isset($_POST['SubirArchivo'])) {
        if(isset($_FILES['Archivo']) && $_FILES['Archivo']['error'] == 0) {
            $ArchivoRutaTemporal = $_FILES['Archivo']['tmp_name'];
            $ArchivoNombre = $_FILES['Archivo']['name'];
            $ArchivoTamano = $_FILES['Archivo']['size'];
            $ArchivoMime = $_FILES['Archivo']['type'];
            $ArchivoNombreExtension = explode(".", $ArchivoNombre);
            $ArchivoExtension = strtolower(end($ArchivoNombreExtension));
            
            $ExtensionesPermitidas = array('txt', 'csv', 'xlsx', 'kml', 'dbf');
            if(in_array($ArchivoExtension, $ExtensionesPermitidas)) {
                // Crear carpeta archivosSubidos en caso de no existir
                $path = './ArchivosSubidos';
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                // Directorio donde se va a mover el archivo movido
                $Archivo = $path . '/' . $ArchivoNombre;


                if(move_uploaded_file($ArchivoRutaTemporal, $Archivo)){
?>
                    <script>alert("El Archivo se ha cargado con éxito");</script>
<?php
                }else{
?>
                    <script>alert("Lo sentimos, el Archivo no se ha podido cargar correctamente, intente de nuevo más tarde"); window.location.href = "./CargarArchivo.html";</script>
<?php
                }

                session_start();
                $_SESSION['ArchivoSubido'] = $Archivo;
                $_SESSION['ArchivoNombre'] = $ArchivoNombre;
                $_SESSION['ArchivoTamano'] = $ArchivoTamano;
                $_SESSION['ArchivoExtension'] = $ArchivoExtension;
                switch ($ArchivoExtension) {
                    case 'txt':
                        header('Location: ./IntegracionTXT.php');
                        break;
                    case 'csv':
                        header('Location: ./IntegracionCSV.php');
                        break;
                    case 'xlsx':
                        header('Location: ./IntegracionXLSX.php');
                        break;
                    case 'kml':
                        header('Location: ./IntegracionKML.php');
                        break;
                    case 'dbf':
                        header('Location: ./IntegracionDBF.php');
                        break;
                }
            }
        }
    }

?>