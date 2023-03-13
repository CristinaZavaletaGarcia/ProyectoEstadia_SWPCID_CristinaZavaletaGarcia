<?php
session_start();
$iddepartamentos_usuarios = $_POST['iddepartamentos_usuarios'];
$nombre_departamento_usuario = $_POST['nombre_departamento_usuario'];
$estatus_departamento = $_POST['estatus_departamento'];
$fecha_departamento = $_POST['fecha_departamento'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$validar = "SELECT iddepartamentos_usuarios FROM departamentos_usuarios WHERE nombre_departamento_usuario='$nombre_departamento_usuario' and iddepartamentos_usuarios != $iddepartamentos_usuarios";
$validando=mysqli_query($conexion,$validar);
if($validando->num_rows > 0){
    echo'<script>alert("El departamento ya se encuentra registrado");
   location.href="../Vista/GestionDepartamenetos.php";
   </script>';
}else{
    $sql= "UPDATE departamentos_usuarios SET nombre_departamento_usuario='$nombre_departamento_usuario',estatus_departamento=$estatus_departamento,
    fecha_departamento='$fecha_departamento' WHERE iddepartamentos_usuarios LIKE $iddepartamentos_usuarios ";
    $resultado = mysqli_query($conexion,$sql);
    if(!$resultado){
        echo'<script>alert("No se realizó la modificación del departamento");
        location.href="../Vista/GestionDepartamenetos.php";
        </script>';

    }else{
        echo'<script>alert("Datos del departamento modificados con éxito");
        location.href="../Vista/GestionDepartamenetos.php";
        </script>';
    }
}

?>