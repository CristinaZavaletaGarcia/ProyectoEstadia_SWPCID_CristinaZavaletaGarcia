<?php
session_start();
$idtipos_documentos=$_GET['idtipos_documentos'];

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
$sql= "DELETE FROM tipos_documentos where idtipos_documentos like $idtipos_documentos";
$resultado =mysqli_query($conexion,$sql);
    if(!$resultado){
        echo '<script>alert("No se realizo la eliminacion correctamente");
        location.href="../Vista/GestionTipoDoc.php";
        </script>';
    }else{
        echo '<script>alert("Tipo de documento eliminado correctamente");
        location.href="../Vista/GestionTipoDoc.php";
        </script>';
    }
    
    
?>