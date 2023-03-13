<?php
session_start();
$idsolicitudes_folio=$_GET['idsolicitudes_folio'];

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql= "DELETE FROM solicitudes_folio where idsolicitudes_folio like $idsolicitudes_folio";
$resultado =mysqli_query($conexion,$sql);
    if(!$resultado){
        echo '<script>alert("No se realizo la eliminacion correctamente");
        location.href="../Vista/SolicitudesFolio.php";
        </script>';
    }else{
        echo '<script>alert("Solicitud de folio eliminada correctamente");
        location.href="../Vista/SolicitudesFolio.php";
        </script>';
    }
    
    
?>