<?php
//Variables
$dirigido= $_POST['dirigido'];
$remitenten_notificacion= $_POST['remitenten_notificacion'];
$fecha_notificacion= $_POST['fecha_notificacion'];
$asunto_notificacion= $_POST['asunto_notificacion'];
$mensaje_notificacion= $_POST['mensaje_notificacion'];
$usuarios_idUsuarios =$_POST['usuarios_idUsuarios'];


//Librerias requeridas para utilizar PHPMAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';

//Estructura del mensaje de correo electronico
$mail = new PHPMailer (true);
try {

                    //Server settings
                    $mail->SMTPDebug = 0; 
                    //verbose debug output
                    $mail->isSMTP();                                            
                    //using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     
                    //SMTP server to send through
                    $mail->SMTPAuth   = true;                                   
                    //SMTP authentication
                    $mail->Username   = 'cristina1h99@gmail.com';                     
                    $mail->Password   = 'elvkhvdvyxqxzyhn';                               
                    //password
                    $mail->SMTPSecure = 'tls';                                
                    //implicit TLS encryption
                    $mail->Port       = 587;                                   
                
                    //Recipients
                    $mail->setFrom('cristina1h99@gmail.com',utf8_decode($remitenten_notificacion));
                    $mail->addAddress($dirigido);          
                    //recipient

                    //Content
                    $mail->isHTML(true);                                   
                    //format to HTML

                    $mail->Subject = utf8_decode($asunto_notificacion);
                    $mail->Body = $mensaje_notificacion;
                    $mail->send();
                    //Alerta de mensaje enviado
                    echo '<script>alert("Mensaje enviado exitosamente al correo electrónico proporcionado y datos registrados correctamente");
                    location.href="../Vista/VistaNotificaciones.php";
                    </script>';
                } catch (Exception $e) {
                    //Alerta de rechazo de mensaje
                    echo '<script>alert("No se logró mandar el correo electrónico");
                    location.href="../Vista/VistaNotificaciones.php";
                    </script>';
                }



?>