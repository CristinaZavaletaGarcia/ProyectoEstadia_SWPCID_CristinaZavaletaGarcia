<!--
    ***************************S.W.P.C.I.D*****************************************
    *    Nombre del sistema: Sistema Web Para el Control de Ingreso de documentos *
    *    Nombre del creador: Zavaleta Gracia Cristina                             *
    *    Materia: Estadía                                                         *  
    *    Carrera: Ingeniería en Tecnologías de la información                     *
    *    Asesora: Dra. Deny Lizbeth Hernández Rabadán                             *
    *    Fecha de culminación: 28 de Febrero del 2023                             *
    ****************************S.W.P.C.I.D****************************************

-->

<?php
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- theme meta -->
    <meta name="theme-name" content="focus" />
    <title>Administrador</title>
    
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
    <!-- Styles -->
    <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="css/lib/themify-icons.css" rel="stylesheet">
    <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="css/lib/weather-icons.css" rel="stylesheet" />
    <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="css/lib/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

<link rel="stylesheet" href="../datatables/css/jquery.dataTables.min.css">



<script>
       function Eliminar() {
            //Ingresamos un mensaje
            var mensaje = confirm("¿Estas seguro que deseas eliminar el registro?");
            //Verificamos si el usuario acepto el mensaje
            if (mensaje==true) {
           return true;
            }
            //Verificamos si el usuario denegó el mensaje
            else {
                return false;
            }
        }
     </script>

</head>

<body>
    <!--Inicio del menu-->
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures bg-success">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo bg-success"><a href="VistaCoordinador.php">
                        <h3><span style="color:rgb(14, 14, 14);" class="">Menu</span></h3></a>
                    </div>
                    <li class="label"><h5 style="color:rgb(14, 14, 14);">Opciones</h5></li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);" href="../Vista/GestionEArea.php">  
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            </svg> Gestión de encargados de área</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);" href="../Vista/GestionTipoDoc.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                              </svg> Gestión de tipos de documentos</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14); "  href="../Vista/SolicitudesFolio.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                          </svg> Solicitudes de folio</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);" href="../Vista/GestionDIngresados.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-clipboard-plus-fill" viewBox="0 0 16 16">
                                <path d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3Zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3Z"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5v-1Zm4.5 6V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5a.5.5 0 0 1 1 0Z"/>
                            </svg> Gestión de documentos</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);"  href="../Vista/SeguimientoDocumento.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"/>
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"/>
                              </svg> Seguimiento de documentos</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);"  href="../Vista/CoordinadorPlantillasDescargar.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-file-post" viewBox="0 0 16 16">
                                <path d="M4 3.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-8z"/>
                                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                            </svg> Plantillas</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);" href="../Vista/VistaNotificaciones.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                        </svg> Notificaciones</a>
                    </li>
                    <li>
                        <a class="logo bg-success" style="color:rgb(14, 14, 14);" href="../Vista/VistaReportes.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-data-fill" viewBox="0 0 16 16">
                                <path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                                <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5ZM10 7a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7Zm-6 4a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1Zm4-3a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V9a1 1 0 0 1 1-1Z"/>
                            </svg> Reportes</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--Termino del menu-->

    <!--Inicio de sidebar -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <!--Opción de usuario-->
                    <div class="float-right">
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-content-body">
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <li>
                </div>
            </div>
        </div>
    </div>
    <!--Titulos iniciales-->
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Hola,<span>Te encuentras dentro del formulario para registrar un nuevo tipos de documentos</span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Coordinador</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="../Vista/GestionTipoDoc.php">
                <button class="btn btn-danger" type="submit">Regresar</button>
            </a> 
            <div class="container">
                <div class="col-lg-12">
                    <div class="registration-form">
                        <form action="../Modelo/TipoDocInsertar.php" method="POST" style="text-align: center">
                            <h1>Registro de un nuevo tipo de documento</h1>
                            <br>
                            <div class="form-group">
                                <label for="nombre_tipoDoc">Nombre del tipo de documento</label>
                                <input class="form-control" type="text" name="nombre_tipoDoc" required>
                                <br>
                                <label for="estatus_tipoDoc">Estatus</label>
                                <select name="estatus_tipoDoc" class="form-control" required >
                                    <option value="">Selecciona una opción:</option>
                                    <option value="0">Inactivo</option>
                                    <option value="1">Activo</option>

                                </select>
                                <br>
                                <label for="fecha_tipoDoc">Fecha de registro:</label>
                                <input class="form-control" type="date" name="fecha_tipoDoc" value="<?php echo date("Y-m-d");?>" readonly>
                                <br>
                                <button class="btn btn-primary" type="submit">Registrar</button>
                            </div> 
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Termino de titulos iniciales-->

    
    

    <!-- jquery vendor -->
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="js/lib/menubar/sidebar.js"></script>
    <script src="js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <!-- bootstrap -->

    <script src="js/lib/calendar-2/moment.latest.min.js"></script>
    <script src="js/lib/calendar-2/pignose.calendar.min.js"></script>
    <script src="js/lib/calendar-2/pignose.init.js"></script>


    <script src="js/lib/weather/jquery.simpleWeather.min.js"></script>
    <script src="js/lib/weather/weather-init.js"></script>
    <script src="js/lib/circle-progress/circle-progress.min.js"></script>
    <script src="js/lib/circle-progress/circle-progress-init.js"></script>
    <script src="js/lib/chartist/chartist.min.js"></script>
    <script src="js/lib/sparklinechart/jquery.sparkline.min.js"></script>
    <script src="js/lib/sparklinechart/sparkline.init.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel-init.js"></script>
    <!-- scripit init-->
    <script src="js/dashboard2.js"></script>

    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../datatables/js/jquery-3.5.1.js"></script>
<script type="text/javascript" src="../datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../datatables/tabla.js"></script>
</body>

</html>