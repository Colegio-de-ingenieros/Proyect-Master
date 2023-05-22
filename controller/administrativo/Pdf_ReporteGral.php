<?php
require('../../public/libreria-pdf/fpdf.php');

class PDF extends FPDF
{

    public $nombre_actividad;
    public $periodo;

    function __construct($nombre_actividad, $periodo)
    {
        $this->nombre_actividad = $nombre_actividad;
        $this->periodo = $periodo;
        parent::__construct("L");
    }
    function Header()
    {
        // Logo
        $this->Image('../../public/img/ciscigCompleto.png', 10, 8, 50);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $fecha_hoy = date('d/m/Y');
        $this->Text(250, 15, $fecha_hoy); //Aqui la variable de la fecha de emision del reporte 
        // Salto de línea
        $this->Ln(15);
        $this->Cell(280, 10, 'Colegio de Ingenieros en Sistemas Computacionales', 0, 1, 'C');

        $this->Cell(280, 10, 'Reporte general', 0, 1, 'C');

        $this->Cell(60, 10, iconv('UTF-8', 'windows-1252', $this->nombre_actividad), 0, 1, 'L'); // Aqui el nombre de la actividad 
        $this->Cell(60, 10, $this->periodo, 0, 1, 'L'); //Aqui el periodo que se eligio 

    }

    function TablaBasica($header, $gastos, $ingresos, $total, $dato)
    {
        $filas =  explode(":", $dato);


        $this->SetFillColor(8, 82, 98);
        //Cabecera

        //Color e la cabecarea de la tabla 
        foreach ($header as $col) {
            $this->SetFont('Times', 'B', 14);
            $this->SetTextColor(255, 255, 255);
            $this->Cell(35, 10, iconv('UTF-8', 'windows-1252', $col), 1, 0, 'L', true);
        }
        //Color de las letras de la tabla 
        $this->SetTextColor(0, 0, 0);
        $this->SetFont('Times', '', 12);
        $this->Ln();

        //crea las celdas de la tabla con los datos
        for ($i = 0; $i < count($filas); $i++) {
            //pone en negritas el texto 
            if ($i == (count($filas) - 1)) {
                $this->SetFont('Times', 'B', 13);
            }


            $columnas = explode(",", $filas[$i]);
            $y = $this->GetY();
            $x = $this->GetX();


            for ($j = 0; $j < count($columnas); $j++) {
                if ($j == 0) {
                    //saca la altura que tendri la celda con el string que le pasamos
                    $string = $columnas[$j];
                    $singleLineWidth = $this->GetStringWidth($string);
                    $numberLines = ceil(($this->GetX() + $singleLineWidth) / ($this->GetPageWidth() - 20)); // 20 accounts for the 10mm default margins
                    $lineHeight = 13; //el tamaño de la linea es el que le especificamos en la fuente
                    $heightOfOutput = $numberLines * $lineHeight;

                    // Now use $heightOfOutput to, for example, determine if a page break is needed before output
                    if ($this->GetY() > $this->PageBreakTrigger - $heightOfOutput) {

                        $this->AddPage($this->CurOrientation);

                        //actualizamos los valores que tenemos almacenado en x y, despues del pagebreak en caso de que se alla realizado
                        $y = $this->GetY();
                        $x = $this->GetX();
                    }

                    //para que acepte acentos
                    $this->MultiCell(35, 7, iconv('UTF-8', 'windows-1252', $columnas[$j]), 1); //creamos la primera celda


                } else {
                    # para obtener la atura, tomamos la posicion de y despues de colocarca y le restamos la y anterior
                    $y_anterior =  $this->GetY();
                    $this->SetXY($x + 35, $y); //para mover la celda en x, aumentamos de 35 en 35 la x, 35 es el tamaño de la culumna
                    $x = $this->GetX();
                    $altura = ($y_anterior - $y);
                    $this->Rect($x, $y, 35, $altura);
                    $this->MultiCell(35, $altura, $columnas[$j], 1);
                }
            }
            //agrega un salto de pagina si hay overflow a causa de la celda
            if ($this->GetY() + $altura > $this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }


        $this->SetFont('Arial', 'B', 14);
        $this->Ln(10);
        $this->SetXY($this->GetX() + 200, $this->GetY());
        $this->MultiCell(80, 10, 'Total de ingresos = ' . $ingresos);
        $x = $this->GetX();
        $this->SetXY($this->GetX() + 200, $this->GetY());
        $this->MultiCell(80, 10, 'Total de gastos = ' . $gastos);
        $x = $this->GetX();
        $this->SetXY($this->GetX() + 200, $this->GetY());
        $this->MultiCell(80, 10, 'Total = ' . $total);
    }
}

header("Content-type: application/pdf; charset=utf-8");
//Creación del objeto de la clase heredada
$pdf = new PDF($_POST["nombre"], $_POST["periodo"]);
//Títulos de las columnas
$header = array('Nombre', 'Hotel', 'Transporte', 'Comidas', 'Oficina', 'Honorarios', 'Subtotal gastos', 'Ingresos');
$pdf->AliasNbPages();
//Primera página
$pdf->AddPage();

$pdf->SetFont('Times', '', 14);
$pdf->SetY(65);
//$pdf->AddPage();

$pdf->TablaBasica($header, $_POST["gastos"], $_POST["ingresos"], $_POST["total"], $_POST["array_datos"]);

$pdf->Output();
    //$pdf->Output("D","reporte.pdf", true);
