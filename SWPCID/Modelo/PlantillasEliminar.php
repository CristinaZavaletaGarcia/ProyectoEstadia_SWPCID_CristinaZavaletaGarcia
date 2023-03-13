<?php
session_start();
$idplantillas_documentos=$_GET['idplantillas_documentos'];

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
$sql= "DELETE FROM plantillas_documentos where idplantillas_documentos like $idplantillas_documentos";
$resultado =mysqli_query($conexion,$sql);
    if(!$resultado){
        echo '<script>alert("No se eliminó la plantilla");
        location.href="../Vista/GestionPlantillas.php";
        </script>';
    }else{
        echo '<script>alert("La plantilla se eliminó correctamente");
        location.href="../Vista/GestionPlantillas.php";
        </script>';
    }
?>