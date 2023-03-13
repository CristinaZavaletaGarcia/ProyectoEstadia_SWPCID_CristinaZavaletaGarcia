<?php
session_start();
include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$usuario_bd=0;
/*Variables obtenidas por le formilario*/
$usuario =$_POST['Usuario'];
$password =$_POST['Password'];
/*Variables obtenidas por le formilario*/
$sql= "SELECT * FROM datos_usuarios WHERE usuario='$usuario'" and "password='$password'";
$resultado=mysqli_query($conexion,$sql);
/*Recorrido de los datos obtenidos*/
while($row  =mysqli_fetch_array($resultado)){
    $usuario_bd = $row['usuario'];
    $password_bd = $row['password'];
    $rol_bd = $row['idtipos_usuarios'];

}
/*Comparación del dato obtenido por el usuario mediante el fomrulario*/
if($usuario == $usuario_bd && $password == $password_bd){
    $_SESSION['usuario']=$usuario;
    $_SESSION['idtipos_usuarios']=$rol_bd;
    /*Si el usuario se encuentra registrado este lo redirije a la gestión de los tipos de usuarios*/
    if(isset($_SESSION['usuario'])){
        header('Location: ../Modelo/panel.php');
    }
}else{
   /*Si no le memciona que no es usuario del sistema y lo redirije a el index*/ 
   echo'<script>alert("No eres usuario del sistema");
   location.href="../Vista/index.html";
   </script>';
}

?>