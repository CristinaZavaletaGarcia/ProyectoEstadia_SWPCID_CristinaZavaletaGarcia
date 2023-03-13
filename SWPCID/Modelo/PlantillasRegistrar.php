<?php
session_start();
$descripcion_plantillas = $_POST['descripcion_plantillas'];
$fecha_plantilla = $_POST['fecha_plantilla'];
$estatus_plantilla = $_POST['estatus_plantilla'];
$tipo_documento = $_POST['tipo_documento'];

$allowedfileExtensions = array('doc','docx');

include("../Controlador/Conexion.php");
$conexion= mysqli_connect($servidor,$user,$password,$database);

if(isset($_FILES["ruta_plantilla"])){
    $nombre_base = basename($_FILES["ruta_plantilla"]["name"]);
    $extensiones = pathinfo($nombre_base, PATHINFO_EXTENSION);
    if(in_array($extensiones, $allowedfileExtensions)){
        $nombre_final=$nombre_base;
        $ruta = "C:/xampp/htdocs/SWPCID_Cristina/SWPCID/Plantillas/". $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["ruta_plantilla"]["tmp_name"],$ruta);
        if($subirarchivo){
            $sql="INSERT INTO plantillas_documentos (ruta_plantilla,descripcion_plantillas,fecha_plantilla,estatus_plantilla,tipo_documento)
            VALUES ('$ruta','$_POST[descripcion_plantillas]','$_POST[fecha_plantilla]',$_POST[estatus_plantilla],$_POST[tipo_documento])";
            $resultado_seg=mysqli_query($conexion,$sql);
            if(!$resultado_seg){
                echo'<script>alert("No se realizo el registro corectamente");
                location.href="../Vista/GestionPlantillas.php";
                </script>';
            }else{
                echo'<script>alert("Plantilla registrada correctamente");
                location.href="../Vista/GestionPlantillas.php";
                </script>';
            }

        }else{
      
            
        }

    }else{
        echo'<script>alert("El documento tiene que ser en formato doc o docx");
        location.href="../Vista/GestionPlantillas.php";
        </script>';
    }
}else{
    echo'<script>alert("No se recnoce el documento");
        location.href="../Vista/GestionPlantillas.php";
        </script>';
}
?>