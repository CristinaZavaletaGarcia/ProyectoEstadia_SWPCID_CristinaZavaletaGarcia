<?php
//$documento= $_POST['documento'];

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
    $pdf->AddPage('L');
    $pdf->SetFont('Arial','',10);                             

    $grafico=$_POST['variable'];
    $img = explode(',',$grafico,2)[1];
    $pic = 'data://text/plain;base64,'.$img;
    $pdf -> image($pic, 20,60,300,0,'png');



    $pdf->Output();

?>