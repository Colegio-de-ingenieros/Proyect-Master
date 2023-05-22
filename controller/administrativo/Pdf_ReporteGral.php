<?php
require('../../public/libreria-pdf/fpdf.php');

class PDF extends FPDF{

    public $nombre_actividad;
    public $periodo;
    
    function __construct($nombre_actividad,$periodo)
    {
        $this->nombre_actividad = $nombre_actividad;
        $this->periodo = $periodo;
        parent::__construct("L");

    }
    function Header()
    {
        // Logo
        $this->Image('../../public/img/ciscigCompleto.png',10,8,50);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $fecha_hoy = date('d/m/Y');
        $this->Text(250,15, $fecha_hoy); //Aqui la variable de la fecha de emision del reporte 
        // Salto de línea
        $this->Ln(15);
        $this->Cell(280,10,'Colegio de Ingenieros en Sistemas Computacionales',0,1,'C');
        
        $this->Cell(280,10,'Reporte general',0,1,'C');

        $this->Cell(60,10,iconv('UTF-8', 'windows-1252', $this->nombre_actividad),0,1,'L'); // Aqui el nombre de la actividad 
        $this->Cell(60,10,$this->periodo,0,1,'L'); //Aqui el periodo que se eligio 
        
    } 

}
?>