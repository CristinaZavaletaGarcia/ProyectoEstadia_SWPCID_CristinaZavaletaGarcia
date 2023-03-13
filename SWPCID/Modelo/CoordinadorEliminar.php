<?php
session_start();
$iddatos_usuario = $_GET['iddatos_usuario'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql= "DELETE FROM datos_usuarios WHERE iddatos_usuario=$iddatos_usuario";
$resultado = mysqli_query($conexion,$sql);
if(!$resultado){
    echo'<script>alert("No se realizó la eliminación del coordinador");
    location.href="../Vista/GestionCoordinadores.php";
    </script>';

    }else{
    echo'<script>alert("Coordinador eliminado con éxito");
    location.href="../Vista/GestionCoordinadores.php";
    </script>';
    }


?>