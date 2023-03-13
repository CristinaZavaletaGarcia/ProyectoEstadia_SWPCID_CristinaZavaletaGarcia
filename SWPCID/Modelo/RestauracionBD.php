<?php
    //Conexión
    include("../Controlador/Conexion.php"); 
    $conexion =  mysqli_connect($servidor,$user,$password,$database);
    //uso de variables para almacenar consultas de nuestro archivo sql
    $sql = '';
    //obtener nuestro archivo sql
    $lines = file('C:\xampp\htdocs\SWPCID_Cristina\SWPCID\Respaldos\respaldo-1678562210.sql');
    //mensaje de vuelta
    $output = array('error'=>false);
    //bucle cada línea de nuestro archivo sql
    foreach ($lines as $line){
        //saltar comentarios
        if(substr($line, 0, 2) == '--' || $line == ''){
            continue;
        }
        //agregue cada línea a nuestra consulta
        echo $sql .= $line;
        //compruebe si es el final de la línea debido al punto y coma
        if (substr(trim($line), -1, 1) == ';'){
            //realizar nuestra consulta
            $query = $conexion->query($sql);
            if(!$query){
            	$output['error'] = true;
                $output['message'] = $conexion->error;
            }
            
            //restablecer nuestra variable de consulta
            $sql = '';
        }
    }
     //Alerta de base de datos restaurada
    echo '<script>alert("Base de datos restaurada con exito");
    location.href="../Vista/RecuperacionBD.php";
    </script>';
    return $output;
?>