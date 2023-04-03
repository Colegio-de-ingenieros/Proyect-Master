<?php
    
    /* ******************************************************
    *             CÓDIGO DE LA GENERACIÓN PDF               *
    *********************************************************/
    require('../../public/libreria-pdf/fpdf.php');
    class PDF extends FPDF{
        // Cabecera de página
        function Header(){
            // Logo
            $this->Image('../../public/img/ciscigCompleto.png',10,8,33);
            // Arial bold 15
            $this->SetFont('Arial','B',18);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30,10,utf8_decode('Visualización de Cursos'),0,0,'C');
            // Salto de línea
            $this->Ln(20);
        }

        // Pie de página
        function Footer(){
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,utf8_decode('Página '.$this->PageNo().'/{nb}'),0,0,'C');
            }
    }
    

    /* ******************************************************
    *                CÓDIGO DE LA CONSULTA                  *
    *********************************************************/

    $id = $_GET['id'];

    include_once('../../model/Ver_Cursos.php');

    $respuesta = '';
    $bd = new VerCurso();
    $bd->BD();
    
    $datos = $bd->cursos_disponibles($id);
    $datost = $bd->temas($id);
    $datoss = $bd->tema($id);

    for ($i = 0; $i < count($datos); $i++) {
        $clave = $datos[$i]["ClaveCur"];
        $nombre = $datos[$i]["NomCur"];
        $duracion = $datos[$i]["DuracionCur"]; 
        $objetivo = $datos[$i]["ObjCur"];   
        $estatus = $datos[$i]["EstatusCur"];  

       /*  echo $clave." ".$nombre." ".$duracion." ".$objetivo." ".$estatus."<br>"; */
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    /* CLAVE DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,utf8_decode('Clave del curso: '),0,1,'C');
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,10,utf8_decode($clave),0,1,'C');  

    /* NOMBRE DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,utf8_decode('Nombre del curso: '),0,1,'C');
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,10,utf8_decode($nombre),0,1,'C');

    /* DURACIÓN DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,utf8_decode('Duración del curso: '),0,1,'C');
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,10,utf8_decode($duracion).' horas',0,1,'C');


    /* OBJETIVO DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,utf8_decode('Objetivo del curso: '),0,1,'C');
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,10,utf8_decode($objetivo),0,'C',false);

    /* TEMARIO DEL CURSO */
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0,10,utf8_decode('Temario del curso: '),0,1,'C');
    $pdf->SetFont('Arial','',14);

    /* Crea un ciclo en donde se itere el tema y sus subtemas */
    for ($i = 0; $i < count($datost); $i++) {
        $tema = $datost[$i]["NomTema"];

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,10,utf8_decode($tema),0,1,'C');

        for ($j = 0; $j < count($datoss); $j++) {
            $subtema = $datoss[$j]["NomSubT"];

            $pdf->SetFont('Arial','',14);
            $pdf->Cell(0,10,utf8_decode($subtema),0,1,'C');
        }
    }

    $pdf->Output();
?>