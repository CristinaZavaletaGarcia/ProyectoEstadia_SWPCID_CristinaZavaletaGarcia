<?php
session_start();
$idplantillas_documentos=$_POST['idplantillas_documentos'];
$descripcion_plantillas=$_POST['descripcion_plantillas'];
$ruta_plantilla=$_POST['ruta_plantilla'];
$fecha_plantilla=$_POST['fecha_plantilla'];
$estatus_plantilla=$_POST['estatus_plantilla'];
$tipo_documento=$_POST['tipo_documento'];

include("../Controlador/conexion.php"); 
$conexion=mysqli_connect($servidor,$user,$password,$database);

$validar_dos ="SELECT descripcion_plantillas FROM plantillas_documentos WHERE descripcion_plantillas='$descripcion_plantillas' and idplantillas_documentos!=$idplantillas_documentos";
$validando_uno=mysqli_query($conexion,$validar_dos);
if($validando_uno->num_rows > 0){
    echo '<script>alert("La plantilla con esta descripción ya se encuentra registrada");
    location.href="../Vista/GestionPlantillas.php";
    </script>';
}else{
    $sql_seg="UPDATE plantillas_documentos set descripcion_plantillas='$descripcion_plantillas',ruta_plantilla='$ruta_plantilla',fecha_plantilla='$fecha_plantilla',estatus_plantilla=$estatus_plantilla, 
    tipo_documento=$tipo_documento WHERE idplantillas_documentos like '$idplantillas_documentos'";
    $resultado_seg=mysqli_query($conexion,$sql_seg);
    if(!$resultado_seg){
        echo '<script>alert("No se realizó la modificación de la plantilla");
        location.href="../Vista/GestionPlantillas.php";
        </script>';
        }else{
            echo '<script>alert("Datos modificados correctamente");
            location.href="../Vista/GestionPlantillas.php";
            </script>';
        }
} 
?>