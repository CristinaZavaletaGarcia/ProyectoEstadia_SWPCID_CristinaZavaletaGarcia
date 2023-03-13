<?php
session_start();
/*Librerias*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/*Variables*/
$nombre = $_POST['nombre'];
$apellidoP = $_POST['apellidoP'];
$apellidoM = $_POST['apellidoM'];
$telefono = $_POST['telefono'];
$correo_electronico = $_POST['correo_electronico'];
$estatus_dato = $_POST['estatus_dato'];
$fecha_dato = $_POST['fecha_dato'];
$idtipos_usuarios  = $_POST['idtipos_usuarios'];
$iddepartamentos_usuario = $_POST['iddepartamentos_usuario'];


include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);



require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';


if(!isset($_SESSION['usuario'])){
    header("Location:../Vista/index.html");
    exit(0);
}
$iduser=$_SESSION['usuario'];
$sql="SELECT  CONCAT(nombre,' ', apellidoP, ' ', apellidoM) as Nombre_completo FROM datos_usuarios WHERE usuario='$iduser'";
$resultado = $conexion->query($sql);
$row= $resultado->fetch_assoc();


/*Validación para usuarios coordinadores*/
$validar ="SELECT * FROM datos_usuarios WHERE telefono='$telefono' || iddepartamentos_usuario='$iddepartamentos_usuario' || correo_electronico='$correo_electronico'";
$validando=mysqli_query($conexion,$validar);
if($validando->num_rows > 0){
    echo '<script>alert("El teléfono ya se encuentra registrado, el departamento ya tiene encargado u coordinador o el correo electrónico ya se encuentra en la base de datos");
    location.href="../Vista/GestionEArea.php";
    </script>';
}else{
    $sql= "INSERT INTO datos_usuarios (nombre,apellidoP,apellidoM,telefono,correo_electronico,estatus_dato,fecha_dato,idtipos_usuarios,iddepartamentos_usuario)
    VALUES('$_POST[nombre]','$_POST[apellidoP]','$_POST[apellidoM]','$_POST[telefono]','$_POST[correo_electronico]',$_POST[estatus_dato],'$_POST[fecha_dato]',
    $_POST[idtipos_usuarios],$_POST[iddepartamentos_usuario])";
    $resultado=mysqli_query($conexion,$sql);
        if(!$resultado){
            echo '<script>alert("No se registraron los datos del usuario");
            location.href="../Vista/GestionEArea.php";
            </script>';
        }else{
            $sql_One="SELECT MAX(iddatos_usuario) AS id FROM datos_usuarios";
                $resultado_One =mysqli_query($conexion,$sql_One);
                while($nuevo =  $resultado_One->fetch_array()){
                        $id_usuario = $nuevo['id'];
                        $sql_seg="UPDATE datos_usuarios SET firma_dato=CONCAT(LEFT(nombre,1),LEFT(apellidoP,1),LEFT(apellidoM,1),'Encargado',LEFT(iddatos_usuario,2)) WHERE iddatos_usuario='$id_usuario'";
                        $resultado_seg =mysqli_query($conexion,$sql_seg);
    
                        $sql_thr="UPDATE datos_usuarios SET usuario=CONCAT(LEFT(nombre,1),LEFT(apellidoP,1),LEFT(apellidoM,1),'Encargado',LEFT(iddatos_usuario,2)) WHERE iddatos_usuario='$id_usuario'";
                        $resultado_thr =mysqli_query($conexion,$sql_thr);
    
                        $sql_for="UPDATE datos_usuarios SET password=CONCAT(LEFT(nombre,1),LEFT(apellidoP,1),LEFT(apellidoM,1),'Encargado',LEFT(iddatos_usuario,2)) WHERE iddatos_usuario='$id_usuario'";
                        $resultado_for =mysqli_query($conexion,$sql_for);

                    }
            
            //$last_id = mysqli_insert_id($conexion);
            //$sql_nuevo="SELECT CONCAT(usuario,' ',password) as credenciales FROM datos_usuarios";
            $sql_new="SELECT MAX(iddatos_usuario) AS id FROM datos_usuarios";
            $sql_new_1= "SELECT usuario,password FROM datos_usuarios";
            $resultado_nuevo =mysqli_query($conexion,$sql_new_1);
    
                $mail = new PHPMailer (true);
                try {

                    while($mostrar =  $resultado_nuevo->fetch_array()){
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
                    $mail->addAddress($correo_electronico);           //Add a 
                    //recipient

                    //Content
                    $mail->isHTML(true);                                  //Set email 
                    //format to HTML

                    $mail->Subject = utf8_decode('Credenciales de ingreso al sistema');
                    $mail->Body ="
                    <html>
                        <body>
                        <h3 align='center'>Correo enviado por S.W.P.I.D<h3/>
                            <p align='center'>Datos para el ingreso al sistema</p>
                            <table width='50%' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' style='margin: 0 auto;''>
                                <tr bgcolor='#FFD700' >
                                    <th>Usuario</th>
                                    <th>Contraseña</th>
                                </tr>
                                <tr>
                                    <td>{$mostrar['usuario']}</td>
                                    <td>{$mostrar['password']}</td>
                                </tr>
                            </table>
                        </body>
                    </html>";
                    }
                    $mail->send();
                    echo '<script>alert("Mensaje enviado exitosamente al correo electrónico proporcionado y datos registrados correctamente");
                    location.href="../Vista/GestionEArea.php";
                    </script>';
                } catch (Exception $e) {
                    echo '<script>alert("No se logró mandar el correo electrónico");
                    location.href="../Vista/GestionEArea.php";
                    </script>';
                }

        } 
}
?>
