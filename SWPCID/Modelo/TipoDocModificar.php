<?php
session_start();
$idtipos_documentos = $_POST['idtipos_documentos'];
$nombre_tipoDoc = $_POST['nombre_tipoDoc'];
$estatus_tipoDoc = $_POST['estatus_tipoDoc'];
$fecha_tipoDoc = $_POST['fecha_tipoDoc'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$validar = "SELECT nombre_tipoDoc FROM tipos_documentos WHERE nombre_tipoDoc='$nombre_tipoDoc' and idtipos_documentos != $idtipos_documentos";
$validando=mysqli_query($conexion,$validar);
if($validando->num_rows > 0){
    echo'<script>alert("El tipo de documento ya se encunatra registrado");
   location.href="../Vista/GestionTipoDoc.php";
   </script>';
}else{
    $sql= "UPDATE tipos_documentos SET nombre_tipoDoc='$nombre_tipoDoc',estatus_tipoDoc=$estatus_tipoDoc,
    fecha_tipoDoc='$fecha_tipoDoc' WHERE idtipos_documentos LIKE $idtipos_documentos ";
    $resultado = mysqli_query($conexion,$sql);
    if(!$resultado){
        echo'<script>alert("No se realizó la modificación del tipo de documento");
        location.href="../Vista/GestionTipoDoc.php";
        </script>';

    }else{
        echo'<script>alert("Datos del tipo de documento modificados con éxito");
        location.href="../Vista/GestionTipoDoc.php";
        </script>';
    }
}

?>