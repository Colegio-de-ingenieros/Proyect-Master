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
        $fecha_hoy = date('Y/m/d');
        $this->Text(250,15, $fecha_hoy); //Aqui la variable de la fecha de emision del reporte 
        // Salto de línea
        $this->Ln(15);
        $this->Cell(280,10,'Colegio de Ingenieros en Sistemas Computacionales',0,1,'C');
        
        $this->Cell(280,10,'Reporte individual',0,1,'C');

        $this->Cell(60,10,$this->nombre_actividad,0,1,'L'); // Aqui el nombre de la actividad 
        $this->Cell(60,10,$this->periodo,0,1,'L'); //Aqui el periodo que se eligio 
        
    } 

    function TablaBasica($header,$gastos,$ingresos,$total,$dato)
    {
        $filas =  explode(":",$dato);
        

        $this->SetFillColor(8,82,98);
        //Cabecera
      
        //Color e la cabecarea de la tabla 
        foreach($header as $col)
        {
            $this->SetFont('Times','B',14);
            $this->SetTextColor(255, 255, 255);
            $this->Cell(35,10, utf8_decode($col),1, 0 , 'L', true);
        }
        //Color de las letras de la tabla 
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Times','',12);
        $this->Ln();
        //crea las celdas de la tabla con los datos
        for ($i=0; $i < count($filas) ; $i++) {
            //pone en negritas el texto 
            if($i == (count($filas)-1)){
                $this->SetFont('Times','B',13);
            }
            $y = $this->GetY(); 
            $x = $this->GetX();
          
            $columnas = explode(",",$filas[$i]);
            
            for ($j=0; $j < count($columnas) ; $j++) { 
                if($j == 0){
                    $this->MultiCell(35,7,$columnas[$j],1); //creamos la primera celda
                  
                }else{
                    # para obtener la atura, tomamos la posicion de y despues de colocarca y le restamos la y anterior
                    $y_anterior =  $this->GetY();
                    $this->SetXY($x+35, $y);//para mover la celda en x, aumentamos de 35 en 35 la x, 35 es el tamaño de la culumna
                    $x = $this->GetX();  
                    $altura = ($y_anterior-$y);
                    $this->Rect($x,$y,35,$altura);
                    $this->MultiCell(35,$altura,$columnas[$j],1);
                }
                
              
                
            }
            //agrega un salto de pagina si hay overflow a causa de la celda
            if($this->GetY()+$altura>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
           
        }
       

        $this->SetFont('Arial','B',15);
        $this->Ln(10);
        $this->Cell(260,10,'Total de gastos = ' .$gastos ,0,1,'R');
        $this->Cell(265,10,'Total de ingresos = '.$ingresos,0,1,'R');
        $this->Cell(234,10,'Total = '.$total,0,1,'R');
    }


}


    //Creación del objeto de la clase heredada
    $pdf=new PDF($_POST["nombre"],$_POST["periodo"]);
    //Títulos de las columnas
    $header=array('Nombre','Hotel','Transporte','Comidas', 'Oficina', 'Honorarios', 'Subtotal gastos', 'Ingresos');
    $pdf->AliasNbPages();
    //Primera página
    $pdf->AddPage();
    $pdf->SetFont('Times','',14);
    $pdf->SetY(65);
    //$pdf->AddPage();
    $pdf->TablaBasica($header,$_POST["gastos"],$_POST["ingresos"],$_POST["total"],$_POST["array_datos"]);
    
    $pdf->Output();
    //$pdf->Output("D","reporte.pdf", true);



?>