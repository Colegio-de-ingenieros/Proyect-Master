<?php
    require('../../public/libreria-pdf/fpdf.php');

    class PDF extends FPDF{
        // Cabecera de página
        function Header(){
            // Logo
            $this -> Image('../../public/img/ciscigCompleto.png',10,8,50);
            // Arial bold 15
            $this -> SetFont('Arial','B',16);
            // Movernos a la derecha
            $this -> SetXY(70,10);
            // Título
            $this -> Cell(70,10,utf8_decode('Colegio de Ingenieros'),0,0,'C');
            $this -> SetXY(60,16);
            $this -> Cell(90,10,utf8_decode('en Sistemas Computacionales'),0,0,'C');
            // Salto de línea
            $this -> Ln(12);
        }

        // Pie de página
        function Footer(){
            // Posición: a 1,5 cm del final
            $this -> SetY(-15);
            // Arial italic 8
            $this -> SetFont('Arial','I',8);
            // Número de página
            $this -> Cell(0,10,utf8_decode('Página '.$this -> PageNo().'/{nb}'),0,0,'C');
            }
    }

    //* Llamada a la base de datos para la consulta de los datos generales de la póliza
    $id = '0002';
    include('../../model/administrativo/Mostrar_Poliza_General.php');
    $bd = new ObtenerPolizasGenerales();
    $bd -> BD();

    $is_user = $bd -> ComprobarUsuario($id);
    $is_empresa = $bd -> ComprobarEmpresa($id);

    if($is_user){
        $response = $bd -> DatosGeneralesUsuario($id);

        $nombre = $response[0]['NomPerso'];
        $apellido_paterno = $response[0]['ApePPerso'];
        $apellido_materno = $response[0]['ApeMPerso'];
        $concepto = $response[0]['CoceptoGral'];
        $fecha = $response[0]['FechaPolGral'];
        $tipo_poliza = $response[0]['NombrePol'];

        $nombre = $nombre.' '.$apellido_paterno.' '.$apellido_materno;
    }
    else if($is_empresa){
        $response = $bd -> DatosGeneralesEmpresa($id);

        $nombre = $response[0]['NomUsuaEmp'];
        $concepto = $response[0]['CoceptoGral'];
        $fecha = $response[0]['FechaPolGral'];
        $tipo_poliza = $response[0]['NombrePol'];
    }
    

    $pdf = new PDF();
    $pdf -> AliasNbPages();
    $pdf -> AddPage();
    $pdf -> SetFillColor(255,255,255);

    $pdf -> SetFont('Arial','B',16);
    $pdf -> Cell(0,10,utf8_decode('Póliza de '.$tipo_poliza.'s'),0,1,'C');

    $pdf -> SetFont('Arial','B',13);
    $pdf -> Cell(0,10,utf8_decode('Datos Generales'),0,1,'L');

    $pdf -> SetFont('Arial','',12);
    $pdf -> Cell(0,10,utf8_decode('Nombre: '.$nombre),0,1,'L');
    $pdf -> MultiCell(0,5,utf8_decode('Concepto: '.$concepto),0,1,'L', true);
    $pdf -> Cell(0,10,utf8_decode('Fecha: '.$fecha),0,1,'L');

    $pdf -> SetFont('Arial','B',13);
    $pdf -> Cell(0,10,utf8_decode('Datos de la póliza'),0,1,'L');
    
    
    $pdf -> Output();
?>