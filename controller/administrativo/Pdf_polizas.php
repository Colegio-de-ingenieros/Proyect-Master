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

        function NbLines($w, $txt) {
            $cw = &$this->CurrentFont['cw'];
            if ($w == 0) {
                $w = $this->w - $this->rMargin - $this->x;
            }
            $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
            $s = str_replace("\r", '', $txt);
            $nb = strlen($s);
            if ($nb > 0 && $s[$nb - 1] == "\n") {
                $nb--;
            }
            $sep = -1;
            $i = 0;
            $j = 0;
            $l = 0;
            $nl = 1;
            while ($i < $nb) {
                $c = $s[$i];
                if ($c == "\n") {
                    $i++;
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $nl++;
                    continue;
                }
                if ($c == ' ') {
                    $sep = $i;
                }
                $l += $cw[$c];
                if ($l > $wmax) {
                    if ($sep == -1) {
                        if ($i == $j) {
                            $i++;
                        }
                    } else {
                        $i = $sep + 1;
                    }
                    $sep = -1;
                    $j = $i;
                    $l = 0;
                    $nl++;
                } else {
                    $i++;
                }
            }
            return $nl;
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
    $id = '0001';
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

    $response_service_type = $bd -> TipoServicio($id);
    $tipo_servicio = $response_service_type[0]['SerPol'];

    $response_name_service = $bd -> TituloServicio($tipo_servicio, $id);
    $titulo_servicio = $response_name_service[0]['Nombre_servicio'];


    $pdf = new PDF('L','mm','Letter');

    //* Definimos el tamaño de la ventana y la altura de las celdas
    $ancho_total = $pdf -> GetPageWidth() - 20;
    $altura = 10;

    $pdf -> AliasNbPages();
    $pdf -> AddPage();
    $pdf -> SetFillColor(255,255,255);

    $pdf -> SetFont('Arial','B',16);
    $pdf -> Cell(0,$altura,utf8_decode('Póliza de '.$tipo_poliza.'s'),0,1,'C');

    $pdf -> SetFont('Arial','B',13);
    $pdf -> Cell(0,$altura,utf8_decode('Datos Generales'),0,1,'L');

    $pdf -> SetFont('Arial','',12);
    $pdf -> Cell(0,$altura,utf8_decode('Nombre: '.$nombre),0,1,'L');
    $pdf -> Cell(0,$altura,utf8_decode('Tipo de servicio: '.$tipo_servicio),0,1,'L');
    $pdf -> Cell(0,$altura,utf8_decode('Nombre del servicio: '.$titulo_servicio),0,1,'L');


    $pdf -> SetFont('Arial','B',13);
    $pdf -> Cell(0,$altura,utf8_decode('Datos de la póliza'),0,1,'L');

    //* TABLA DE DATOS DE LA PÓLIZA
    $pdf -> SetFont('Arial','B',13);
    $pdf -> SetFillColor(8, 82, 98);
    $pdf -> SetTextColor(255,255,255);

    $pdf -> Cell(0,$altura,utf8_decode('Póliza de '.$tipo_poliza),1,1,'C',true);
    $pdf -> SetFont('Arial','B',12);

    //* SECCIÓN FECHA Y FOLIO
    $ancho_celda = $ancho_total / 4;
    $pdf -> Cell($ancho_celda,$altura,utf8_decode('Fecha'),1,0,'C',true);

    //Celdas blancas
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> Cell($ancho_celda,$altura,utf8_decode($fecha),1,0,'C',true);

    //Celdas azules
    $pdf -> SetFont('Arial','B',12);
    $pdf -> SetFillColor(8, 82, 98);
    $pdf -> SetTextColor(255,255,255);
    $pdf -> Cell($ancho_celda,$altura,utf8_decode('Folio'),1,0,'C',true);

    //Celdas blancas y salto de celdas
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> Cell($ancho_celda,$altura,utf8_decode($id),1,1,'C',true);

    $pdf->SetFont('Arial','',12);
    $lineas = $pdf->NbLines($ancho_celda * 3, $concepto);
    $altura = 5 * $lineas;

    //* SECCION CONCEPTO GENERAL
    // Celda azul
    $pdf -> SetFont('Arial','B',12);
    $pdf -> SetFillColor(8, 82, 98);
    $pdf -> SetTextColor(255,255,255);
    $pdf -> Cell($ancho_celda, $altura, utf8_decode('Concepto general'), 1, 0, 'C', true);

    // Celda blanca
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> MultiCell($ancho_celda * 3, 5, utf8_decode($concepto), 1);

    //* SECCION CABECERAS DE LA TABLA CONCEPTO | DEBE | HABER | DESCRIPCION | COMPROBANTE
    //Celdas de color gris
    $pdf -> SetFont('Arial','B',12);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFillColor(223, 227, 231);

    $ancho_celda = $ancho_total / 5;
    $altura = 10;

    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Concepto'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Debe'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Haber'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Descripción'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Comprobante'),1,1,'C',true);
    
    $pdf -> Output();
?>