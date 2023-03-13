<?php
session_start();
$fecha_solicitud=$_POST['fecha_solicitud'];
$Asunto_solicitud=$_POST['Asunto_solicitud'];
$destinado_solicitud=$_POST['destinado_solicitud'];
$prioridad_solicitud=$_POST['prioridad_solicitud'];
$estatus_solicitudFolio=$_POST['estatus_solicitudFolio'];
$usuarios_idUsuarios = $_POST['usuarios_idUsuarios'];
$tipo_doc = $_POST['tipo_doc'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql="INSERT INTO solicitudes_folio (fecha_solicitud,Asunto_solicitud,destinado_solicitud,prioridad_solicitud,estatus_solicitudFolio,indicador_folios,usuarios_idUsuarios,tipo_doc)
VALUES ('$_POST[fecha_solicitud]','$_POST[Asunto_solicitud]','$_POST[destinado_solicitud]','$_POST[prioridad_solicitud]',$_POST[estatus_solicitudFolio],1,$_POST[usuarios_idUsuarios],$_POST[tipo_doc])";
$resultado = mysqli_query($conexion,$sql);
    if(!$resultado){
        echo'<script>alert("No se realizo el registro de la solicitud");
        location.href="../Vista/SolicitudNumeroFolio.php";
        </script>';


    }else{
        $last_id=mysqli_insert_id($conexion);
        $sql_1= "INSERT INTO seguimiento_folios(idsolicitud_folio,idestatus_folios,indicador_seguimiento,fecha_seguimiento)
        VALUES($last_id,$estatus_solicitudFolio,1,'$fecha_solicitud')";
        $resultado=mysqli_query($conexion,$sql_1);

        echo'<script>alert("Solictud registrada con éxito");
        location.href="../Vista/SolicitudNumeroFolio.php";
        </script>';
    }


?>