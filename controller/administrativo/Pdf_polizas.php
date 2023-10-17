<?php
    require('../../public/libreria-pdf/fpdf.php');
    class PDF extends FPDF{
        function Header(){
            $this -> Image('../../public/img/ciscigCompleto.png',10,8,50);
            $this -> SetFont('Arial','B',16);
            $width = $this -> GetPageWidth();
 
            $cell_width = $width - $this -> lMargin - $this -> rMargin;

            $this -> SetX(($width - $cell_width) / 2);
        
            $this -> Cell($cell_width,16,utf8_decode('Colegio de Ingenieros en Sistemas Computacionales'),0,0,'C');
        
            $this -> Ln(20);
        }
        

        function NbLines($w, $txt) {
            $cw = &$this -> CurrentFont['cw'];
            if ($w == 0) {
                $w = $this -> w - $this -> rMargin - $this -> x;
            }
            $wmax = ($w - 2 * $this -> cMargin) * 1000 / $this -> FontSize;
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

        function MultiCellRow($cells, $width, $height, $data) {
            $x = $this->GetX();
            $y = $this->GetY();
            $maxheight = 0;
      
            for ($i = 0; $i < $cells; $i++) {
              $this->MultiCell($width, $height, $data[$i]);
              if ($this->GetY() - $y > $maxheight) 
                $maxheight = $this->GetY() - $y;
              $this->SetXY($x + ($width * ($i + 1)), $y);
            }
      
            for ($i = 0; $i < $cells + 1; $i++) {
              $this->Line($x + $width * $i, $y, $x + $width * $i, $y + $maxheight);
            }
      
            // Dibuja las líneas horizontales
            $this->Line($x, $y, $x + $width * $cells, $y);
            $this->Line($x, $y + $maxheight, $x + $width * $cells, $y + $maxheight);
        }

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
    $id = $_GET['id'];
    include('../../model/administrativo/Mostrar_Poliza_PDF.php');
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

    $response_elaborador = $bd -> DatosElaborador($id);
    $nombre_elaborador = $response_elaborador[0]['NomElaPol'];
    $apellido_paterno_elaborador = $response_elaborador[0]['ApePElaPol'];
    $apellido_materno_elaborador = $response_elaborador[0]['ApeMElaPol'];

    $realizador = $nombre_elaborador.' '.$apellido_paterno_elaborador.' '.$apellido_materno_elaborador;


    $pdf = new PDF('L','mm','Letter');
    //* Definimos el tamaño de la ventana y la altura de las celdas
    $ancho_total = $pdf -> GetPageWidth() - 20;
    $altura = 10;

    $pdf -> AliasNbPages();
    $pdf -> AddPage();
    $pdf -> SetFillColor(255,255,255);

    $pdf -> SetFont('Arial','B',16);
    $pdf -> Cell(0,$altura,utf8_decode('Póliza de '.$tipo_poliza),0,1,'C');

    $pdf -> SetFont('Arial','B',13);
    $pdf -> Cell(0,$altura,utf8_decode('Datos generales'),0,1,'L');

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
    $lineas = $pdf -> NbLines($ancho_celda * 3, $concepto);
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

    $ancho_celda = $ancho_total / 4;
    $altura = 10;

    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Concepto'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Debe'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Haber'),1,0,'C',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Descripción'),1,1,'C',true);

    //* OBTENER LOS DATOS DE LAS POLIZAS INDIVIDUALES
    $response = $bd -> DatosIndividuales($id);

    //* Iterar sobre los datos de las pólizas individuales
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFillColor(255, 255, 255);

    $ancho_celda = $ancho_total / 4;

    $valor_debe = 0;
    $valor_haber = 0;

    foreach($response as $row){
        $concepto = $row['DesPolInd'];
        $monto = $row['Monto'];
        $descripcion = $row['DesDocInd'];
        $tipo = $row['NomPolAcc'];
    
        $lineas_concepto = $pdf -> NbLines($ancho_celda, $concepto);
        $lineas_descripcion = $pdf -> NbLines($ancho_celda, $descripcion);

        $altura_concepto = $lineas_concepto * 5;
        $altura_descripcion = $lineas_descripcion * 5;

        $debe = '';
        $haber = '';
        
        if($tipo == 'Debe'){
            $valor = intval(floatval($monto) * 100);
            $debe = '$'.number_format($valor / 100, 2, '.', ',');
            $haber = '';
            $valor_debe += intval(floatval($monto) * 100);
        }
        else if($tipo == 'Haber'){
            $valor = intval(floatval($monto) * 100);
            $haber = '$'.number_format($valor / 100, 2, '.', ',');
            $debe = '';
            $valor_haber += intval(floatval($monto) * 100);
        }
        
        if($altura_concepto > $altura_descripcion){   
            $x = $pdf -> GetX();
            $y = $pdf -> GetY();

            $pdf -> MultiCell($ancho_celda, 5, utf8_decode($concepto), 1);
            $pdf -> SetXY($x + $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_concepto, utf8_decode($debe), 1, 'R');
            $pdf -> SetXY($x + 2 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_concepto, utf8_decode($haber), 1, 'R');
            $pdf -> SetXY($x + 3 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_concepto / $lineas_descripcion, utf8_decode($descripcion), 1);
    
        }
        else if($altura_concepto < $altura_descripcion){

            $x = $pdf -> GetX();
            $y = $pdf -> GetY();

        
            $pdf -> MultiCell($ancho_celda, $altura_descripcion / $lineas_concepto, utf8_decode($concepto), 1);
            $pdf -> SetXY($x + $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_descripcion, utf8_decode($debe), 1, 'R');
            $pdf -> SetXY($x + 2 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_descripcion, utf8_decode($haber), 1, 'R');
            $pdf -> SetXY($x + 3 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, 5, utf8_decode($descripcion), 1);
        }
        else if($altura_concepto == $altura_descripcion && $lineas_concepto != 1 && $lineas_descripcion != 1){

            $x = $pdf -> GetX();
            $y = $pdf -> GetY();
        
            $pdf -> MultiCell($ancho_celda, 5, utf8_decode($concepto), 1);
            $pdf -> SetXY($x + $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_concepto, utf8_decode($debe), 1, 'R');
            $pdf -> SetXY($x + 2 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, $altura_concepto, utf8_decode($haber), 1, 'R');
            $pdf -> SetXY($x + 3 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, 5, utf8_decode($descripcion), 1);
        }
        else if($altura_concepto == $altura_descripcion && $lineas_concepto == 1 && $lineas_descripcion == 1){
            
            $x = $pdf -> GetX();
            $y = $pdf -> GetY();
        
            $pdf -> MultiCell($ancho_celda, 10, utf8_decode($concepto), 1);
            $pdf -> SetXY($x + $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, 10, utf8_decode($debe), 1, 'R');
            $pdf -> SetXY($x + 2 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, 10, utf8_decode($haber), 1, 'R');
            $pdf -> SetXY($x + 3 * $ancho_celda, $y);
            
            $pdf -> MultiCell($ancho_celda, 10, utf8_decode($descripcion), 1);
        }
    }

    $pdf -> SetFont('Arial','B',12);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFillColor(223, 227, 231);

    $ancho_celda = $ancho_total / 4;
    $altura = 10;

    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Sumas iguales:'),1,0,'R',true);

    $pdf -> SetFillColor(255,255,255);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('$'.number_format($valor_debe / 100, 2, '.', ',')),1,0,'R',true);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode('$'.number_format($valor_haber / 100, 2, '.', ',')),1,0,'R',true);

    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFillColor(223, 227, 231);
    $pdf -> Cell($ancho_celda, $altura,utf8_decode(''),1,1,'R',true);

    $pdf -> Cell($ancho_celda, $altura,utf8_decode('Realizó:'),1,0,'R',true);
    $pdf -> SetFont('Arial','',12);
    $pdf -> SetTextColor(0,0,0);
    $pdf -> SetFillColor(255, 255, 255);
    
    $pdf -> Cell($ancho_celda * 3, $altura,utf8_decode($realizador),1,0,'L',true);

    $pdf -> Output();
?>