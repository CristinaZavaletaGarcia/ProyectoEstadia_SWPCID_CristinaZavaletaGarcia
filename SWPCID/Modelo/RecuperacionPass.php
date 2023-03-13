<?php

$correo=$_POST['Recuperar'];
$date= date('Y-m-d');

$caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$longitud = 12;
$codigo = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

/*Notificación*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);


$sql= "SELECT COUNT(iddatos_usuario) AS Cantidad, iddatos_usuario FROM datos_usuarios WHERE correo_electronico='$correo'";
$resultado = mysqli_query($conexion,$sql);
    while($mostrar =  $resultado->fetch_array()){
        $id_usuario = $mostrar['iddatos_usuario'];
        $sql_2 = "UPDATE recuperarcontra SET estado=0 WHERE usuarios_idUsuarios='$id_usuario'";
            $resultado_2 = mysqli_query($conexion,$sql_2);
        if($mostrar['Cantidad']>0){
            $sql_1= "INSERT INTO recuperarcontra (estado,codigo,fecha_contra,usuarios_idUsuarios,tipo_recupera) VALUES (1,'$codigo','$date',$id_usuario,'Contraseña')";
            $resultado_1 = mysqli_query($conexion,$sql_1);

            $mail = new PHPMailer (true);
            try {
                
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
                $mail->Password   = 'elvkhvdvyxqxzyhn';                            //SMTP 
                //password
                $mail->SMTPSecure = 'tls';                                  //Enable 
                //implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                //Recipients
                $mail->setFrom('cristina1h99@gmail.com',utf8_decode('Recuperación de contraseña'));
                $mail->addAddress($correo);           //Add a 
                //recipient
    
                //Content
                $mail->isHTML(true);                                  //Set email 
                //format to HTML
                $mail->Subject = utf8_decode('Código de restauración');
                $mail->Body    = $codigo;
                
                $mail->send();
                echo '<script>alert("Mensaje enviado exitosamente al correo electrónico proporcionado");
                location.href="../Vista/GenerarNuevaContra.php?correo='.$correo.'&id='.$id_usuario.'";
                </script>';
            } catch (Exception $e) {
                echo '<script>alert("No se envio el correo electrónico");
                location.href="../Vista/index.php";
                </script>';
            }

        }else{
            echo '<script>alert("No existe la dirección de correo en la base de datos");
            location.href="../Vista/index.html";
            </script>';
        }
    }
?>