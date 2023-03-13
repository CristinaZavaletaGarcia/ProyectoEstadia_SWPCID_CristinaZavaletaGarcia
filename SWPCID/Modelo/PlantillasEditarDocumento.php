<?php
/*Variables*/
session_start();
$idplantillas_documentos=$_POST['idplantillas_documentos'];
$formatos_permitidos =  array('doc','docx');


/*Conexión*/
include("../Controlador/conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);


$nombre_base = $_FILES['ruta_plantilla']['name'];
$extension = pathinfo($nombre_base, PATHINFO_EXTENSION);
if(!in_array($extension, $formatos_permitidos)){

    echo '<script>alert("El formato tiene que ser con terminación doc o docx");
            location.href="../Vista/GestionPlantillas.php";
            </script>';
}else{
    $nombre_final=$nombre_base;
    $ruta = "C:/xampp/htdocs/SWPCID_Cristina/Plantillas". $nombre_final;
    $subirarchivo = move_uploaded_file($_FILES["ruta_plantilla"]["tmp_name"],$ruta);
    var_dump($subirarchivo);
    if($subirarchivo){
        $sql_seg= "UPDATE plantillas_documentos set ruta_plantilla='$ruta' WHERE idplantillas_documentos like $idplantillas_documentos";
        $resultado_seg =mysqli_query($conexion,$sql_seg);
        if(!$resultado_seg){
            echo '<script>alert("No se pudo realizar la modificación del documento");
            location.href="../Vista/GestionPlantillas.php";
            </script>';
        }else{
            echo '<script>alert("Plantilla modificada con éxito");
            location.href="../Vista/CoordinadorPlantillasDescargar.php";
            </script>';
        }

    }
}

    
?>