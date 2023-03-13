<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

include("../Controlador/conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);

include("../Controlador/conexion.php");
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location:../Vista/index.html");
    exit(0);
}
$conexion =  mysqli_connect($servidor,$user,$password,$database);
$iduser=$_SESSION['usuario'];
$sql="SELECT  CONCAT(nombre,' ', apellidoP, ' ', apellidoM) as Nombre_completo, iddatos_usuario FROM datos_usuarios WHERE usuario='$iduser'";
$resultado = $conexion->query($sql);
$row= $resultado->fetch_assoc();

$sql="SELECT correo_electronico FROM datos_usuarios WHERE idtipos_usuarios=3";
$resultado = mysqli_query($conexion,$sql);

$mail = new PHPMailer (true);
try {
    while($mostrar = mysqli_fetch_array($resultado)){
    $correos= $mostrar['correo_electronico'];
    var_dump($correos);

                    //Server settings
                    $mail->SMTPDebug = 0;                                       //Enable 
                    //verbose debug output
                    $mail->isSMTP();                                            //Send 
                    //using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the 
                    //SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable 
                    //SMTP authentication
                    $mail->Username   = 'cristina1h99@gmail.com';                     //SMTP username
                    $mail->Password   = 'elvkhvdvyxqxzyhn';                               //SMTP 
                    //password
                    $mail->SMTPSecure = 'tls';                                  //Enable 
                    //implicit TLS encryption
                    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                    //Recipients
                    $mail->setFrom('cristina1h99@gmail.com',utf8_decode($row['Nombre_completo']));
                    $mail->addAddress($correos);           //Add a 
                    //recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email 
                    //format to HTML

                    $mail->Subject = utf8_decode('Notificación de información');
                    $mail->Body = utf8_decode('Esta es una notificación para recordarte que revises el apartado de seguimiento de solicitudes de folio');
    }
                    $mail->send();
                    echo '<script>alert("Mensaje enviado exitosamente al correo electrónico proporcionado y datos registrados correctamente");
                    location.href="../Vista/VistaNotificaciones.php";
                    </script>';
                } catch (Exception $e) {
                    /*echo '<script>alert("No se logró mandar el correo electrónico");
                    location.href="../Vista/VistaNotificaciones.php";
                    </script>';*/
                }



?>