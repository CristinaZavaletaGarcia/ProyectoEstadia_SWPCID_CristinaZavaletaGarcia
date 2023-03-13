<?php
session_start();
$folio=$_GET['folio'];

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql_1 ="DELETE FROM seguimiento_documento WHERE documentos_entrada_Folio LIKE '$folio'";
$resultado1=mysqli_query($conexion,$sql_1);

$sql= "DELETE FROM documentos_entrada where folio like $folio";
$resultado =mysqli_query($conexion,$sql);
    if(!$resultado){
        echo '<script>alert("No se realizo la eliminacion correctamente");
        location.href="../Vista/GestionDIngresados.php";
        </script>';
    }else{
        echo '<script>alert("Documento eliminado correctamente");
        location.href="../Vista/GestionDIngresados.php";
        </script>';
    }
    
    
?>