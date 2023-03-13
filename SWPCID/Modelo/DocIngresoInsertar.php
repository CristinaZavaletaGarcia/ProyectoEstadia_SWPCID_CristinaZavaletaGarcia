<?php
session_start();
/*Variables*/
$folio=$_POST['folio'];
$fecha_documento = $_POST['fecha_documento'];
$numero_documento = $_POST['numero_documento'];
$destinatario_documento = $_POST['destinatario_documento'];
$introduccion_documento =$_POST['introduccion_documento'];


/*Conexión*/
include("../Controlador/conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
/*********/

$sql= "UPDATE documentos_entrada SET fecha_documento='$fecha_documento',numero_documento='$numero_documento',destinatario_documento='$destinatario_documento',introduccion_documento='$introduccion_documento'
WHERE folio like '$folio'";
$resultado =mysqli_query($conexion,$sql);
if(!$resultado){
    echo '<script>alert("No se registró la modificación del seguimiento");
    location.href="../Modelo/GestionDIngresados.php";
    </script>';
}else{
    echo '<script>alert("Tipo de documentos modificado con éxito");
    location.href="../Vista/GestionDIngresados.php";
    </script>';
    }

   
?>