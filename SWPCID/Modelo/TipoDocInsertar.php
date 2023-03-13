<?php
session_start();
/*Variables*/
$nombre_tipoDoc =$_POST['nombre_tipoDoc'];
$estatus_tipoDoc =$_POST['estatus_tipoDoc'];
$fecha_tipoDoc =$_POST['fecha_tipoDoc'];

/*Conexión*/
include("../Controlador/conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
/*********/

/*Validación*/
$validar ="SELECT * FROM tipos_documentos WHERE nombre_tipoDoc='$nombre_tipoDoc'";
$validando=mysqli_query($conexion,$validar);
if($validando->num_rows > 0){
    echo '<script>alert("El tipo fue registrado anteriormente");
    location.href="../Vista/GestionTipoDoc.php";
    </script>';
}else{
    $sql= "INSERT INTO tipos_documentos (nombre_tipoDoc,estatus_tipoDoc,fecha_tipoDoc)
    VALUES('$_POST[nombre_tipoDoc]','$_POST[estatus_tipoDoc]','$_POST[fecha_tipoDoc]')";
    $resultado =mysqli_query($conexion,$sql);
    if(!$resultado){
        echo '<script>alert("No se registró el tipo de documento");
        location.href="../Modelo/GestionTipoDoc.php";
        </script>';
    }else{
        echo '<script>alert("Tipo de documentos registrado con éxito");
        location.href="../Vista/GestionTipoDoc.php";
        </script>';
    }
}
   
?>