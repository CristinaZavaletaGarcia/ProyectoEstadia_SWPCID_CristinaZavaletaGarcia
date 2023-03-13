<?php
session_start();
$idseguimiento_documento=$_GET['idseguimiento_documento'];
$acuse_segimiento=$_GET['acuse_segimiento'];
var_dump($acuse_segimiento);

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
$sql= "SELECT idseguimiento_documento,acuse_segimiento FROM seguimiento_documento where idseguimiento_documento like $idseguimiento_documento";
$resultado =mysqli_query($conexion,$sql);
if (isset($_GET['acuse_segimiento'])) {
    $file_example = $acuse_segimiento;
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