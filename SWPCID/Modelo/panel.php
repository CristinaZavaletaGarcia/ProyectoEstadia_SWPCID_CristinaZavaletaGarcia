<?php
session_start();

$name = $_SESSION['usuario'];

if($_SESSION['idtipos_usuarios']==1){
    header('Location: ../Vista/VistaAdmin.php');
    exit();

}
if($_SESSION['idtipos_usuarios']==2){
    header('Location: ../Vista/VistaCoordinador.php');
    exit();

}
if($_SESSION['idtipos_usuarios']==3){
    header('Location: ../Vista/VistaEncargado.php');
    exit();

}

?>