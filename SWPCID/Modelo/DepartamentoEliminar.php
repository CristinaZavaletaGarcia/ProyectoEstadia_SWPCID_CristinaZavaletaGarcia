<?php
session_start();
$iddepartamentos_usuarios = $_GET['iddepartamentos_usuarios'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$sql= "DELETE FROM departamentos_usuarios WHERE iddepartamentos_usuarios=$iddepartamentos_usuarios";
$resultado = mysqli_query($conexion,$sql);
if(!$resultado){
    echo'<script>alert("No se realizó la eliminación del departamento");
    location.href="../Vista/GestionDepartamenetos.php";
    </script>';

    }else{
    echo'<script>alert("Departamento eliminado con éxito");
    location.href="../Vista/GestionDepartamenetos.php";
    </script>';
    }


?>