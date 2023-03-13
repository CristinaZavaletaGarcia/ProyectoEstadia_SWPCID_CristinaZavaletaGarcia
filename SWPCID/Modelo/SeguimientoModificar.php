<?php
session_start();
$idseguimiento_documento = $_POST['idseguimiento_documento'];
$indicador_seguimiento = $_POST['indicador_seguimiento'];
$fecha_seguimiento = $_POST['fecha_seguimiento'];
$firma_seguimiento = $_POST['firma_seguimiento'];
$acuse_segimiento = $_POST['acuse_segimiento'];
$observaciones_seguimiento = $_POST['observaciones_seguimiento'];
$id_estatus_Doc = $_POST['id_estatus_Doc'];
$usuarios_idUsuarios = $_POST['usuarios_idUsuarios'];
$documentos_entrada_Folio = $_POST['documentos_entrada_Folio'];


include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql_1="UPDATE seguimiento_documento SET indicador_seguimiento=0 WHERE idseguimiento_documento='$idseguimiento_documento'";
$resultado = mysqli_query($conexion,$sql_1);
if(!$resultado){

}else{
    $last_id=mysqli_insert_id($conexion);
    $sql_3 = "INSERT INTO seguimiento_documento(indicador_seguimiento,fecha_seguimiento,firma_seguimiento,acuse_segimiento,observaciones_seguimiento,id_estatus_Doc,usuarios_idUsuarios,documentos_entrada_Folio)
    VALUES (1,'$fecha_seguimiento','$firma_seguimiento','$_POST[acuse_segimiento]','$_POST[observaciones_seguimiento]',$id_estatus_Doc,$usuarios_idUsuarios,$documentos_entrada_Folio)";
    $resultado3 = mysqli_query($conexion,$sql_3);
    echo'<script>alert("Datos del tipo de documento modificados con éxito");
    location.href="../Vista/SeguimientoDocumento.php";
    </script>';
}

?>