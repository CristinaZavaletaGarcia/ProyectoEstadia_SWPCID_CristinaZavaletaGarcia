<?php
session_start();
/*Variables*/
$idseguimiento_documento=$_POST['idseguimiento_documento'];
$allowedfileExtensions = array('pdf');

/*Conexión*/
include("../Controlador/conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);

/*Consulta*/
if($_FILES["acuse_segimiento"]){
    if(isset($_FILES["acuse_segimiento"])){
        if($_FILES['acuse_segimiento']['type']=='application/pdf'){
            $nombre_base = basename($_FILES["acuse_segimiento"]["name"]);
            $nombre_final=$nombre_base;
            $ruta = "C:/xampp/htdocs/SWPCID_Cristina/SWPCID/archivos/". $nombre_final;
            $subirarchivo = move_uploaded_file($_FILES["acuse_segimiento"]["tmp_name"], $ruta);
            if($subirarchivo){
                $sql_seg= "UPDATE seguimiento_documento set acuse_segimiento='$ruta' WHERE idseguimiento_documento like $idseguimiento_documento";
                $resultado_seg =mysqli_query($conexion,$sql_seg);
                if(!$resultado_seg){
                    echo '<script>alert("El acuse no fue registrado");
                    location.href="../Vista/SeguimientoDocumento.php";
                    </script>';
                }else{
                    echo '<script>alert("El acuse fue registrado con éxito");
                    location.href="../Vista/SeguimientoDocumento.php";
                    </script>';
                }
        
            }
        }else{
            echo '<script>alert("El documento debe de ser en formato PDF");
            location.href="../Vista/SeguimientoDocumento.php";
            </script>';

        }
    }else{
        echo '<script>alert("El documento no existe");
        location.href="../Vista/SeguimientoDocumento.php";
        </script>';
    }
}  
    
?>