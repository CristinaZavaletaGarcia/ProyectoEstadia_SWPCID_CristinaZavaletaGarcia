<?php
session_start();
$nombre_departamento_usuario = $_POST['nombre_departamento_usuario'];
$fecha_departamento = $_POST['fecha_departamento'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$validar = "SELECT * FROM departamentos_usuarios WHERE nombre_departamento_usuario='$nombre_departamento_usuario'";
$validando=mysqli_query($conexion,$validar);
if($validando->num_rows >0){
    echo'<script>alert("El departamento ya se encuentra registrado");
   location.href="../Vista/GestionDepartamenetos.php";
   </script>';
}else{
    $sql= "INSERT INTO departamentos_usuarios (nombre_departamento_usuario,estatus_departamento,fecha_departamento)
    VALUES ('$_POST[nombre_departamento_usuario]',1,'$_POST[fecha_departamento]')";
    $resultado = mysqli_query($conexion,$sql);
    if(!$resultado){
        echo'<script>alert("No se realizó el registro del departamento");
        location.href="../Vista/GestionDepartamenetos.php";
        </script>';

    }else{

    }
}

?>