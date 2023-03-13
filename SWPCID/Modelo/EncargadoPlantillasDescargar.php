<?php
session_start();
$idplantillas_documentos=$_GET['idplantillas_documentos'];
$ruta_plantilla=$_GET['ruta_plantilla']; 

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
$sql= "SELECT idplantillas_documentos,ruta_plantilla FROM plantillas_documentos where idplantillas_documentos like $idplantillas_documentos";
$resultado =mysqli_query($conexion,$sql);
if (isset($_GET['ruta_plantilla'])) {
    $file_example = $ruta_plantilla;
    if (file_exists($file_example)) {
        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename='.basename($file_example));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_example));
        ob_clean();
        flush();
        readfile($file_example);
        exit;
    }
    else {
        echo 'Archivo no disponible.';
    }
}
    
    
?>