<?php
//Variables para el documentos
$ruta= $_SERVER["DOCUMENT_ROOT"].'/SWPCID_Cristina/SWPCID/Respaldos/';
$tables = '*';

//Conexión
include("../Controlador/Conexion.php"); 
$conexion =  mysqli_connect($servidor,$user,$password,$database);
// Revisar la coneccion
if (mysqli_connect_errno()){
    echo "Fallo la conexion a MySQL: " . mysqli_connect_error();
    exit;
}
mysqli_query($conexion, "SET NAMES 'utf8'");
    // Obtener todas las tablas
    if($tables == '*'){
        $tables = array();
        $result = mysqli_query($conexion, 'SHOW TABLES'); // Obtener el nombre de todas las tablas
        while($row = mysqli_fetch_row($result)){
            $tables[] = $row[0];
        }
    }else{
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
    $return = '';
    
    // Recorrido en todas las tablas
    foreach($tables as $table){
        $result = mysqli_query($conexion, 'SELECT * FROM '.$table); //Se seleccionan todas las tablas
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);
        $indicador=$num_fields-1; //Indicador de el numero de filas menos 1
        $return.= 'DROP TABLE IF EXISTS '.$table.';'; // Este es un texto que se agrega al archivo
        $row2 = mysqli_fetch_row(mysqli_query($conexion, 'SHOW CREATE TABLE '.$table)); // Se obtiene el codigo SQL para crear las tablas
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;
        // Obtener campos
        for ($i = 0; $i < $num_fields; $i++){   // Obtener filas
            while($row = mysqli_fetch_row($result)){   
                
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES('; // Se crea el codigo SQL para insertar los datos a las tablas
                }else{
                    $return.= '(';
                }

                //En Campos
                for($j=0; $j<$num_fields; $j++){
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($indicador)) { $return.= ','; }
                }
                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    // Guardar el archivo
    $fileName = 'respaldo-'.time().'.sql'; // El resultado del respaldo queda en un archivo con extension .sql
    $handle = fopen($ruta.$fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        echo '<script>alert("Respaldo realizado correctamente");
        location.href="../Vista/RespaldoBd.php";
        </script>';
        exit; 
    }else{
        echo '<script>alert("No se realizo el respaldo de la base de datos");
        location.href="../Vista/RespaldoBd.php";
        </script>';
        exit; 
    }
    ?>