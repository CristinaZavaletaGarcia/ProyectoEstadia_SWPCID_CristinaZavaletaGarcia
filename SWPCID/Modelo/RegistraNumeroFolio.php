<?php
session_start();
$fecha_recibido=$_POST['fecha_recibido'];
$fecha_documento=$_POST['fecha_documento'];
$numero_documento=$_POST['numero_documento'];
$remitente_documento=$_POST['remitente_documento'];
$asunto_documento=$_POST['asunto_documento'];
$destinatario_documento=$_POST['destinatario_documento'];
$introduccion_documento=$_POST['introduccion_documento'];
$recibido_documento=$_POST['recibido_documento'];
$prioridad_documento=$_POST['prioridad_documento'];
$estatus_doc=$_POST['estatus_doc'];
$tipo_doc =$_POST['tipo_doc'];
$num_oficio=$_POST['num_oficio'];


include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql_2 ="UPDATE solicitudes_folio set indicador_folios=0 WHERE idsolicitudes_folio LIKE $num_oficio";
$resultado1 = mysqli_query($conexion,$sql_2);

$sql="INSERT INTO documentos_entrada (fecha_recibido,fecha_documento,numero_documento,remitente_documento,asunto_documento,destinatario_documento,introduccion_documento,recibido_documento,prioridad_documento,estatus_doc,tipo_doc,num_oficio)
VALUES ('$_POST[fecha_recibido]','$_POST[fecha_documento]','$_POST[numero_documento]','$_POST[remitente_documento]','$_POST[asunto_documento]','$_POST[destinatario_documento]','$_POST[introduccion_documento]','$_POST[recibido_documento]','$_POST[prioridad_documento]',$_POST[estatus_doc],$_POST[tipo_doc],$_POST[num_oficio])";
$resultado2 = mysqli_query($conexion,$sql);
    if(!$resultado2){
        echo'<script>alert("No se realizo el aparatado de folio");
        location.href="../Vista/GestionDIngresados.php";
        </script>';


    }else{
        $last_id=mysqli_insert_id($conexion);
        $sql_3 = "INSERT INTO seguimiento_documento(indicador_seguimiento,fecha_seguimiento,firma_seguimiento,id_estatus_Doc,usuarios_idUsuarios,documentos_entrada_Folio)
        VALUES (1,'$fecha_recibido','$recibido_documento',1,$remitente_documento,$last_id)";
        $resultado3 = mysqli_query($conexion,$sql_3);
        echo'<script>alert("Solicitud de numero de folio");
        location.href="../Vista/GestionDIngresados.php";
        </script>';


    }


?>