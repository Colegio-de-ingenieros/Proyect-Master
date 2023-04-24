<?php
require('../../public/libreria-pdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../public/img/ciscigCompleto.png',10,8,50);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Text(250,15, 'DD/MM/AAAA'); //Aqui la variable de la fecha de emision del reporte 
    // Salto de línea
    $this->Ln(20);
    $this->Cell(280,10,'Colegio de Ingenieros en Sistemas Computacionales',0,1,'C');
    $this->Ln(10);
    $this->Cell(280,10,'Reporte individual',0,1,'C');
    $this->Ln(10);
    $this->Cell(60,10,'Nombre de la actividad',0,1,'L'); // Aqui el nombre de la actividad 
    $this->Cell(60,10,'Periodo',0,1,'L'); //Aqui el periodo que se eligio 
} 

function TablaBasica($header)
   {
    $this->SetFillColor(8,82,98);
    //Cabecera
    $this->Ln(30);
    //Color e la cabecarea de la tabla 
    foreach($header as $col)
    {
        $this->SetFont('Times','B',14);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(35,10, utf8_decode($col),1, 0 , 'L', true);
    }
    //Color de las letras de la tabla 
    $this->SetTextColor(0, 0, 0);
    $this->SetFont('Times','',14);
    $this->Ln();
    for ($i = 1; $i <= 8; $i++)
    {
        $this->Cell(35,7,"Hola",1);
    }
    //SALTO DE LINEA 
    $this->Ln();
    for ($i = 1; $i <= 8; $i++)
    {
        $this->Cell(35,7,"Hola",1);
    }
    $this->Ln();
    //Ultima fila 
    $this->Cell(35,7,"Subtotal",1);

    for ($i = 2; $i <= 8; $i++)
    {
        $this->Cell(35,7,"10",1);
    }

    $this->SetFont('Arial','B',15);
    $this->Ln(10);
    $this->Cell(70,10,'Total de gastos = ',0,1,'L');
    $this->Cell(60,10,'Total de ingresos = ',0,1,'L');
    $this->Cell(60,10,'Total = ',0,1,'L');
   }
   

}

//Creación del objeto de la clase heredada
$pdf=new PDF('L');
//Títulos de las columnas
$header=array('Nombre','Hotel','Transporte','Comidas', 'Oficina', 'Honorarios', 'Subtotal gastos', 'Ingresos');
$pdf->AliasNbPages();
//Primera página
$pdf->AddPage();
$pdf->SetFont('Times','',14);
$pdf->SetY(65);
//$pdf->AddPage();
$pdf->TablaBasica($header);
$pdf->Output();
?>