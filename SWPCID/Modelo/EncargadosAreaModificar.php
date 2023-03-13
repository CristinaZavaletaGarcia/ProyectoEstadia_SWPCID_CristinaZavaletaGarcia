<?php
session_start();
$iddatos_usuario= $_POST['iddatos_usuario'];
$nombre = $_POST['nombre'];
$apellidoP = $_POST['apellidoP'];
$apellidoM = $_POST['apellidoM'];
$telefono = $_POST['telefono'];
$correo_electronico = $_POST['correo_electronico'];
$estatus_dato = $_POST['estatus_dato'];
$fecha_dato = $_POST['fecha_dato'];
$idtipos_usuarios = $_POST['idtipos_usuarios'];
$iddepartamentos_usuario=$_POST['iddepartamentos_usuario'];

include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

$validar1 = "SELECT telefono FROM datos_usuarios WHERE telefono='$telefono' AND iddatos_usuario!='$iddatos_usuario'";
$validando1=mysqli_query($conexion,$validar1);
if($validando1->num_rows > 0){
    echo'<script>alert("El telefono ya se encuentra registrado");
   location.href="../Vista/GestionEncargadosArea.php";
   </script>';
}else{
    $valida = "SELECT correo_electronico FROM datos_usuarios WHERE correo_electronico='$correo_electronico' AND iddatos_usuario!='$iddatos_usuario'";
    $validando=mysqli_query($conexion,$valida);
    if($validando->num_rows > 0){

        echo'<script>alert("El correo ya se encuentra registrado");
        location.href="../Vista/GestionEncargadosArea.php";
        </script>';
    }else{
        $validar3 = "SELECT iddepartamentos_usuario FROM datos_usuarios WHERE iddepartamentos_usuario='$iddepartamentos_usuario' AND iddatos_usuario!='$iddatos_usuario'";
        $validando3=mysqli_query($conexion,$validar3);
       if($validando3 ->num_rows > 0){
           echo'<script>alert("El departamento ya tiene coordinador u encargado");
           location.href="../Vista/GestionEncargadosArea.php";
           </script>';
       }else{
           $sql="UPDATE datos_usuarios SET nombre='$nombre',apellidoP='$apellidoP',apellidoM='$apellidoM',telefono='$telefono',correo_electronico='$correo_electronico',
           estatus_dato=$estatus_dato,fecha_dato='$fecha_dato',idtipos_usuarios=$idtipos_usuarios,iddepartamentos_usuario=$iddepartamentos_usuario 
           WHERE iddatos_usuario LIKE $iddatos_usuario";
           $resultado = mysqli_query($conexion,$sql);
           if(!$resultado){
               echo'<script>alert("No se realizó la modificación del encargado");
               location.href="../Vista/GestionEncargadosArea.php";
               </script>';
           }else{
               $last_id=mysqli_insert_id($conexion);
               $sql_ultimo=" SELECT MAX(iddatos_usuario) AS id FROM datos_usuarios";
               $resultado_ultimo=mysqli_query($conexion,$sql_ultimo);
               while($mostrar =  $resultado_ultimo->fetch_assoc()){
                   $id=$mostrar['id'];
   
                   $sql_one = "UPDATE datos_usuarios SET firma_dato=CONCAT(LEFT(nombre,1),LEFT(apellidoP,1),LEFT(apellidoM,1),'Coordinador',LEFT(iddatos_usuario,2)) Where iddatos_usuario='$id'";
                   $resultado_one=mysqli_query($conexion,$sql_one);
                   echo'<script>alert("Los datos del encargado se modifico con exito");
               location.href="../Vista/GestionEncargadosArea.php";
               </script>';
               }
   
               
           }
   
       } 
       
    }       
    
}

?>