<?php
session_start();
$id = $_POST['id'];
$Codigo = $_POST['Codigo'];
$NewUser = $_POST['NewUser'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);



$actulizar = "UPDATE recuperarcontra SET estado=0 WHERE usuarios_idUsuarios ='$id'";
$validandoA=mysqli_query($conexion,$actulizar);

$sql= "UPDATE datos_usuarios SET usuario='$NewUser' WHERE iddatos_usuario LIKE '$id'";
$resultado = mysqli_query($conexion,$sql);
if(!$resultado){
    echo'<script>alert("No se realizó la modificación del usuario");
    location.href="../Vista/index.html";
    </script>';

}else{
    echo'<script>alert("Usuario actualizado");
    location.href="../Vista/index.html";
    </script>';
}

?>