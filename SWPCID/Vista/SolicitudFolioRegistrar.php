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
$row=$resultado->fetch_assoc();
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
    <title>Coordinador</title>
    
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
</head>

<body>
    <!--Inicio del menu-->
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures bg-warning">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo bg-warning"><a href="VistaEncargado.php">
                        <h3><span style="color:rgb(14, 14, 14);" class="">Menu</span></h3></a>
                    </div>
                    <li class="label"><h5 style="color:rgb(14, 14, 14);">Opciones</h5></li>
                    <li>
                        <a class="logo bg-warning" style="color:rgb(14, 14, 14);" href="../Vista/SolicitudNumeroFolio.php">  
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            </svg> Solicitus de numero de folio</a>
                    </li>
                    <li>
                        <a class="logo bg-warning" style="color:rgb(14, 14, 14);" href="../Vista/SeguimientoSolicitudeaFolio.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                              </svg> Seguimiento de solicitudes de folio</a>
                    </li>
                    <li>
                        <a class="logo bg-warning" style="color:rgb(14, 14, 14); "  href="../Vista/EncargadoPlantillasDescargar.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="14" fill="currentColor" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
                            <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
                          </svg> Descarga de plantillas</a>
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
                                <h1><span>Te encuntras dentro del formulario para registrar una nueva solicitud</span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Encargado de área</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="../Vista/SolicitudNumeroFolio.php">
                <button class="btn btn-danger" type="submit">Regresar</button>
            </a> 
            <div class="container">
                <div class="col-lg-12">
                    <div class="registration-form">
                        <form action="../Modelo/SolicitudFolioRegistrar.php" method="POST" style="text-align: center">
                            <h1>Registro de una nueva solicitud de numero de folio</h1>
                            <br>
                            <div class="form-group">
                                <label for="fecha_solicitud">Fecha de la solicitud</label>
                                <input class="form-control" type="date" name="fecha_solicitud" value="<?php echo date("Y-m-d");?>" readonly>
                                <br>
                                <label for="Asunto_solicitud">Asunto de la solicitud</label>
                                <input class="form-control" type="text" name="Asunto_solicitud" required>
                                <br>
                                <?php
                                    include("../Controlador/Conexion.php");
                                    $conexion =  mysqli_connect($servidor,$user,$password,$database);
                                    $sql1 = "SELECT * FROM datos_usuarios WHERE idtipos_usuarios=2";
                                    $resultado = mysqli_query($conexion,$sql1);
                                ?>
                                <label for="destinado_solicitud">Destino de la solicitud</label>
                                <select name="destinado_solicitud" class="form-control" required>
                                    <option value="">Selecciona una opción</option>
                                    <?php while($mostrar =  $resultado->fetch_assoc()) { ?>
                                        <option value="<?php echo $mostrar['usuario'];?>"><?php echo $mostrar['usuario'];?></option>
                                    <?php } ?>
                                    </select>
                                    <br>
                                <br>
                                <label for="prioridad_solicitud">Prioridad del documento</label>
                                <select name="prioridad_solicitud" class="form-control" required >
                                    <option value="">Selecciona una opción:</option>
                                    <option value="Urgente">Urgente</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>

                                </select>
                                <br>
                                <label for="estatus_solicitudFolio">Estatus del documento</label>
                                <select name="estatus_solicitudFolio" class="form-control" readonly >
                                    <option value="1">Activo</option>

                                </select>
                                <br>
                                <?php
                                    include("../Controlador/Conexion.php");
                                    $conexion =  mysqli_connect($servidor,$user,$password,$database);
                                    $sql1 = "SELECT * FROM datos_usuarios WHERE usuario='$iduser'";
                                    $resultado = mysqli_query($conexion,$sql1);
                                ?>
                                <label for="usuarios_idUsuarios">Firma del documento</label>
                                <select name="usuarios_idUsuarios" class="form-control" readonly>
                                    <?php while($mostrar =  $resultado->fetch_assoc()) { ?>
                                        <option value="<?php echo $mostrar['iddatos_usuario'];?>"><?php echo $mostrar['usuario'];?></option>
                                    <?php } ?>
                                    </select>
                                <br>
                                <?php
                                    include("../Controlador/Conexion.php");
                                    $conexion =  mysqli_connect($servidor,$user,$password,$database);
                                    $sql1 = "SELECT * FROM tipos_documentos";
                                    $resultado = mysqli_query($conexion,$sql1);
                                ?>
                                <label for="tipo_doc">Tipo de usuario</label>
                                <select name="tipo_doc" class="form-control" required>
                                    <option value="">Selecciona una opción</option>
                                    <?php while($mostrar =  $resultado->fetch_assoc()) { ?>
                                        <option value="<?php echo $mostrar['idtipos_documentos'];?>"><?php echo $mostrar['nombre_tipoDoc'];?></option>
                                    <?php } ?>
                                    </select>
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
</body>

</html>