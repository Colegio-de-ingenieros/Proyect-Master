<?php
    
    /* ******************************************************
    *             CÓDIGO DE LA GENERACIÓN PDF               *
    *********************************************************/
    require('../../public/libreria-pdf/fpdf.php');
    class PDF extends FPDF{
        // Cabecera de página
        function Header(){
            // Logo
            $this->Image('../../public/img/ciscigCompleto.png',10,8,50);
            // Arial bold 15
            $this->SetFont('Arial','B',16);
            // Movernos a la derecha
            $this->SetXY(70,10);
            // Título
            $this->Cell(70,10,utf8_decode('Colegio de Ingenieros'),0,0,'C');
            $this->SetXY(60,16);
            $this->Cell(90,10,utf8_decode('en Sistemas Computacionales'),0,0,'C');
            // Salto de línea
            $this->Ln(12);
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

    include_once('../../model/administrativo/Ver_Cursos.php');

    $respuesta = '';
    $bd = new VerCurso();
    $bd->BD();
    
    $datos = $bd->cursos_disponibles($id);
    $datost = $bd->temas_busqueda($id);

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

    $pdf->SetFont('Arial','B',16);
    $pdf->Cell(0,10,utf8_decode('Visualización de Cursos'),0,1,'C');

    /* CLAVE DEL CURSO*/

    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(40,10,utf8_decode('Clave del curso: '),0,1,'L');
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(20,10,utf8_decode($clave),0,1,'L');  
    $pdf->Ln(5);

    /* NOMBRE DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(45,10,utf8_decode('Nombre del curso: '),0,1,'L');
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,10,utf8_decode($nombre),0,1,'L');
    $pdf->Ln(5);

    /* DURACIÓN DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(50,10,utf8_decode('Duración del curso: '),0,1,'L');
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(30,10,utf8_decode($duracion).' horas',0,1,'L');
    $pdf->Ln(5);

    /* OBJETIVO DEL CURSO*/
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(50,10,utf8_decode('Objetivo del curso: '),0,1,'L');
    $pdf->SetFont('Arial','',14);
    $pdf->MultiCell(0,10,utf8_decode($objetivo),0,'J');
    $pdf->Ln(5);
    /* TEMARIO DEL CURSO */
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(45,10,utf8_decode('Temario del curso: '),0,1,'L');
    $pdf->SetFont('Arial','',14);
    /* Crea un ciclo en donde se itere el tema y sus subtemas */
    if ($datost) {
        $idtemasl = [];
		$nomtemasl = [];
        for ($i = 0; $i < count($datost); $i++) {
            $tem = $datost[$i]["NomTema"];
            $iden = $datost[$i]["IdTema"];


            array_push($idtemasl, ((int)$iden));
            array_push($nomtemasl, $tem);
        }

            //aplica ordenacion burbuja para ordenar los temas en numeros del menor al mayor
        for ($i = 0; $i < count($idtemasl); $i++) {
            for ($j = 0; $j < count($idtemasl); $j++) {
                if ($idtemasl[$i] < $idtemasl[$j]) {
                    $aux = $idtemasl[$i];
                    $aux1 = $nomtemasl[$i];
                    $nomtemasl[$i] = $nomtemasl[$j];
                    $idtemasl[$i] = $idtemasl[$j];
                    $idtemasl[$j] = $aux;
                    $nomtemasl[$j] = $aux1;
                }
            }
        }
        
        for ($i = 0; $i < count($idtemasl); $i++) {
            $pdf->SetFont('Arial','B',16);
            $pdf->Cell(0,10,utf8_decode($nomtemasl[$i]),0,1,'L');

            //$respuesta .= '<h3 style="width: 500px; word-wrap: break-word;">'.$nomtemasl[$i] .'</h3><br>';
            $datoss = $bd->subtemas_busqueda($tem,((string)$idtemasl[$i]));
            $idsubtemasl = [];
            $nomsubtemasl = [];
            if ($datoss) {

                for ($j = 0; $j < count($datoss); $j++) {
                    $te = $datoss[$j]["NomSubT"];
                    $idss = $datoss[$j]["IdSubT"]; 
                    array_push($idsubtemasl, ((int)$idss));
                    array_push($nomsubtemasl, $te);
                }

                //aplicar burbuja para ordenar los subtemas(id)
                for ($is = 0; $is < count($idsubtemasl); $is++) {
                    for ($js = 0; $js < count($idsubtemasl); $js++) {
                        if ($idsubtemasl[$is] < $idsubtemasl[$js]) {
                            $aux = $idsubtemasl[$is];
                            $aux1 = $nomsubtemasl[$is];
                            $nomsubtemasl[$is] = $nomsubtemasl[$js];
                            $idsubtemasl[$is] = $idsubtemasl[$js];
                            $idsubtemasl[$js] = $aux;
                            $nomsubtemasl[$js] = $aux1;
                        }
                    }
                }

                for ($il = 0; $il < count($idsubtemasl); $il++) {
                    $pdf->SetFont('Arial','',14);
                    $pdf->Cell(0,10,utf8_decode($nomsubtemasl[$il]),0,1,'L');
                    //$respuesta .= '<h4 style="width: 500px;">'.$nomsubtemasl[$il] .'</h4><br>';
                }         
            }
        }
    }
   /*  if ($datost){
    for ($i = 0; $i < count($datost); $i++) {
        $tema = $datost[$i]["NomTema"];
        $ide = $datost[$i]["IdTema"];

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,10,utf8_decode($tema),0,1,'C');

        $datoss = $bd->s($tema,$ide);
        for ($j = 0; $j < count($datoss); $j++) {
            $subtema = $datoss[$j]["NomSubT"];

            $pdf->SetFont('Arial','',14);
            $pdf->Cell(0,10,utf8_decode($subtema),0,1,'C');
        }
    }
} */
else {
    $pdf->SetFont('Arial','',14);
    $pdf->Cell(0,10,utf8_decode('No hay temas registrados'),0,1,'L');
}

    $pdf->Output();
?>