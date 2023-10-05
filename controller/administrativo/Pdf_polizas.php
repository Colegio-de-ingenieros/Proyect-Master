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
            $anchoCaracteres = &$this->CurrentFont['cw'];

            if ($anchoCelda == 0) {
                $anchoCelda = $this->w - $this->rMargin - $this->x;
            }

            $anchoMaximoLinea = ($anchoCelda - 2 * $this->cMargin) * 1000 / $this->FontSize;
            $textoSinRetornoCarro = str_replace("\r", '', $texto);
            $longitudTexto = strlen($textoSinRetornoCarro);

            if ($longitudTexto > 0 && $textoSinRetornoCarro[$longitudTexto - 1] == "\n") {
                $longitudTexto--;
            }

            $posicionUltimoEspacio = -1;
            $posicionActual = 0;

            $inicioLineaActual = 0;
            $longitudLineaActual = 0;

            $numeroTotalLineas = 1;

            while ($posicionActual < $longitudTexto) {

                $caracterActual = $textoSinRetornoCarro[$posicionActual];

                if ($caracterActual == "\n") {
                    $posicionActual++;
                    $posicionUltimoEspacio = -1;
                    $inicioLineaActual = $posicionActual;
                    $longitudLineaActual = 0;
                    $numeroTotalLineas++;
                    continue;
                }

                if ($caracterActual == ' ') {
                    $posicionUltimoEspacio = $posicionActual;
                }

                $longitudLineaActual += $anchoCaracteres[$caracterActual];

                if ($longitudLineaActual > $anchoMaximoLinea) {

                    if ($posicionUltimoEspacio == -1) {

                        if ($posicionActual == $inicioLineaActual) {
                            $posicionActual++;
                        }

                    } 
                    else {
                        $posicionActual = $posicionUltimoEspacio + 1;
                    }

                    $posicionUltimoEspacio = -1;
                    $inicioLineaActual = $posicionActual;

                    $longitudLineaActual = 0;
                    $numeroTotalLineas++;

                } 
                else {
                    $posicionActual++;
                }
            }
            return $numeroTotalLineas;
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

    $secciones = 0;
    

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
    $pdf -> Cell(0,10,utf8_decode('Tipo de servicio: '.$tipo_servicio),0,1,'L');
    $pdf -> Cell(0,10,utf8_decode('Nombre del servicio: '.$titulo_servicio),0,1,'L');


    $pdf -> SetFont('Arial','B',13);
    $pdf -> Cell(0,10,utf8_decode('Datos de la póliza'),0,1,'L');

    //* TABLA DE DATOS DE LA PÓLIZA
    $pdf -> SetFont('Arial','B',13);
    $pdf -> SetFillColor(8, 82, 98);
    $pdf -> SetTextColor(255,255,255);

    $pdf -> Cell(0,10,utf8_decode('Póliza de '.$tipo_poliza),1,1,'C',true);
    $pdf -> SetFont('Arial','B',12);
    $pdf -> Cell(47.5,10,utf8_decode('Fecha'),1,0,'C',true);

    //Celdas blancas
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> Cell(47.5,10,utf8_decode($fecha),1,0,'C',true);

    //Celdas azules
    $pdf -> SetFont('Arial','B',12);
    $pdf -> SetFillColor(8, 82, 98);
    $pdf -> SetTextColor(255,255,255);
    $pdf -> Cell(47.5,10,utf8_decode('Folio'),1,0,'C',true);

    //Celdas blancas y salto de celdas
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> Cell(47.5,10,utf8_decode($id),1,1,'C',true);

    $pdf->SetFont('Arial','',12);
    // Calcular el número de líneas necesarias para el texto
    $lineas = $pdf->NbLines(142.5, $concepto);
    // Calcular la altura necesaria para la multicelda
    $altura = 5 * $lineas;

    // Celda verde
    $pdf->SetFont('Arial','B',12);
    $pdf->SetFillColor(8, 82, 98);
    $pdf->SetTextColor(255,255,255);
    $pdf->Cell(47.5, $altura, utf8_decode('Concepto general'), 1, 0, 'C', true);

    // Celda blanca
    $pdf->SetFont('Arial','',12);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0,0,0);
    $pdf->MultiCell(142.5, 5, utf8_decode($concepto), 1);
    
    $pdf -> Output();
?>