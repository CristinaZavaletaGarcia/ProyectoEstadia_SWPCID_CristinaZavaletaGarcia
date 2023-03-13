<?php
$Opciones=$_POST['Opciones'];
$FechaDia=$_POST['FechaDia'];
$Fecha1=$_POST['Fecha1'];
$Fecha2=$_POST['Fecha2'];
$Mes=$_POST['Mes'];



include("../Controlador/Conexion.php");
$conexion =  mysqli_connect($servidor,$user,$password,$database);

require('../FPDF/fpdf.php');
class PDF extends FPDF{
    //CABECERA DE PAGINA
    function Header(){
        //Logo_1
        $this->Image('../Vista/images/Logo_1.png',7,-5,80);
        //Letra
        $this->Cell(260);
        $this->SetFont('Arial','B',10); 
        $this->Cell(800,-10,(date('d-m-Y')),0,1,'B');

        $this->SetFont('Arial','B',20); 
        //Mover a la derecha
        $this->Cell(80);
        //Titulo
        $this->Cell(150,50,utf8_decode('Reporte gráfico por tipo de documento'),0,1,'C');
        //Salto de pagina
        $this->Ln(5);
    }
    function Footer(){
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(30,5,'Cristina Zavaleta Garcia',0,0,'C');
        $this->Cell(200,5, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
        $this->Cell(30,5,'Sistema Web Para el Control de Ingreso de Documentos',0,1,'C');
    }
}
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L'); //Agregar páginas
    $pdf->SetFont('Arial','',10); //Tipo de letra

    $pdf->SetY(60);//Alineación vertical
    $pdf->SetX(20);//Alineación horizontal
    $pdf->SetTextColor(255,255,255); //Color del texto
    $pdf->SetFillColor(128,128,128); //Color de fondo

    //Columnas de la tabla
    $pdf->Cell(20,9,  'ID',1,0, 'C', 1);
    $pdf->Cell(35,9,  'Fecha',1 ,0, 'C', 1);
    $pdf->Cell(40,9,  'Numero',1 ,0, 'C', 1);
    $pdf->Cell(30,9,  'Remitente',1,0, 'C', 1);
    $pdf->Cell(40,9,  'Destinatario',1,0, 'C', 1);
    $pdf->Cell(30,9,  'Prioridad',1,0, 'C', 1);
    $pdf->Cell(30,9,  'Numero de oficio ',1,0, 'C', 1);
    $pdf->Cell(40,9,  'Tipo',1 ,1, 'C', 1);

switch ($Opciones) {
    case 'dia':
    //Consulta para obtener los datos de la tabla
    $consulta = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
    t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
    ON d.tipo_doc=t.idtipos_documentos
    WHERE fecha_recibido='$FechaDia'";
                $resultado = mysqli_query($conexion,$consulta);
    $pdf->SetTextColor(0,0,0); //Color del texto
    $pdf->SetFillColor(240,245,255); //Color de fondo
    //Recorrido de las tablas
    while($mostrar = $resultado->fetch_array()){
        $pdf->SetX(20);//Alineación horizontal
        //Columnas
        $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
        $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
        $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
        $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
        $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
        $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
        $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
        if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
            $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
        }
    }
    break;
    case 'semana':
        $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
        t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
        ON d.tipo_doc=t.idtipos_documentos
        WHERE d.fecha_recibido BETWEEN '$Fecha1' AND '$Fecha2'";
    $resultado = mysqli_query($conexion,$sql);
    $pdf->SetTextColor(0,0,0); //Color del texto
    $pdf->SetFillColor(240,245,255); //Color de fondo
    //Recorrido de las tablas
    while($mostrar = $resultado->fetch_array()){
        $pdf->SetX(20);//Alineación horizontal
        //Columnas
        $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
        $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
        $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
        $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
        $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
        $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
        $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
        if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
            $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
        }
    }
    break;
    case 'mes':
        switch ($Mes) {
            case 01:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;
            case 02:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;       
            case 03:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;       
            case 04:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;       
            case 05:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;       
            case 06:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;    
            case 07:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;  
            case 8:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break; 
            case 9:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;     
            case 10:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;    
            case 11:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;   
            case 12:
                $sql = "SELECT d.folio,d.fecha_recibido,d.numero_documento,d.remitente_documento,d.destinatario_documento,d.prioridad_documento,d.num_oficio,d.tipo_doc,
                t.idtipos_documentos,t.nombre_tipoDoc FROM documentos_entrada d INNER JOIN tipos_documentos t 
                ON d.tipo_doc=t.idtipos_documentos
                WHERE(SELECT MONTH(d.fecha_recibido))='$Mes'";
                $resultado = mysqli_query($conexion,$sql);
                $pdf->SetTextColor(0,0,0); //Color del texto
                $pdf->SetFillColor(240,245,255); //Color de fondo
                //Recorrido de las tablas
                while($mostrar = $resultado->fetch_array()){
                    $pdf->SetX(20);//Alineación horizontal
                    //Columnas
                    $pdf->Cell(20,9, $mostrar['folio'],1,0,'C',1);
                    $pdf->Cell(35,9, $mostrar['fecha_recibido'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['numero_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['remitente_documento'],1,0,'C',1);
                    $pdf->Cell(40,9, $mostrar['destinatario_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['prioridad_documento'],1,0,'C',1);
                    $pdf->Cell(30,9, $mostrar['num_oficio'],1,0,'C',1);
                    if($mostrar['idtipos_documentos']=$mostrar['tipo_doc']){
                        $pdf->Cell(40,9, utf8_decode($mostrar['nombre_tipoDoc']),1,1,'C',1);
                    }
                }
            break;                              
        }
}
$pdf->Output();
?>