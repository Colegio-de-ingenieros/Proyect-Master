<?php
//importar los archivos necesarios
use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Poliza_Excel.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los datos
$idc = $_GET["id"];
$base = new ObtenerPolizasGenerales();
$base->instancias();
$datosGral = $base->DatosGenerales($idc);
$datosInd = $base->DatosIndividuales($idc);
$tipo = $base->TipoServicio($idc);
for($i=0; $i<count($tipo); $i++){
    $tipoSer = $tipo[$i]["SerPol"];
}
$tituloSer = $base->TituloServicio($tipoSer, $idc);
for($i=0; $i<count($tituloSer); $i++){
    $nomServ = $tituloSer[$i]["Nombre_servicio"];
}
$usua=$base->ComprobarUsuario($idc);
if($usua==1){
    $datosUsua=$base->DatosGeneralesUsuario($idc);
    for($i=0; $i<count($datosUsua); $i++){
        $nomUsua = $datosUsua[$i]["Nombre"];
        $tipoUsuario=$datosUsua[$i]["TipoU"];
        $usuario=($tipoUsuario." ".$nomUsua);
    }
}
else{
    $datosEmp=$base->DatosGeneralesEmpresa($idc);
    for($i=0; $i<count($datosEmp); $i++){
        $nomUsua = $datosEmp[$i]["NomUsuaEmp"];
        $usuario=("Empresa ".$nomUsua);
    }
}
for($i=0; $i<count($datosGral); $i++){
    $nombre = ' '.$datosGral[$i]["Nombre"];
    $conGral = $datosGral[$i]["CoceptoGral"];
    $fecha = $datosGral[$i]["FechaPolGral"];
    $tipoPol = $datosGral[$i]["IdTipoPol"];
}
if($tipoSer=='Certificación' or $tipoSer=='Curso'){
    $servicio=($tipoSer." ".$nomServ);
}
else{
    $servicio=($tipoSer);
}
if($tipoPol=='1'){
    $tipoPol='egresos';
}
else{
    $tipoPol='ingresos';
}
//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

$nomArchivo=$tipoPol." ".$servicio;
//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Póliza de " . $nomArchivo)->setCreator("Colegio de Ingenieros en Sistemas Computacionales")
->setCategory("Reporte de Pólizas")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//-----------------------------------------------crear la hoja principal----------------------------------------------
$spreadsheet->setActiveSheetIndex(0)->setTitle("Póliza");
$hoja = $spreadsheet->getActiveSheet(); 

//alinear
$style = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'wrapText' => true
    ]
];

//poner los datos generales de la póliza
$hoja -> setCellValue('A1', "Usuario:") -> setCellValue('A2', $usuario) -> setCellValue('A4', "Servicio:")-> setCellValue('A5', $servicio);

$hoja->getStyle('A4')->applyFromArray($style);
$hoja->getStyle('B9')->applyFromArray($style);
$hoja->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');
$hoja->getStyle('A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

//poner estilo a los datos generales
$estilo = $hoja->getStyle('A1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A4');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A2');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A5');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

//colocar los bordes datos generales
$estilo = $hoja->getStyle('A1');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);
$estilo = $hoja->getStyle('A5');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//poner datos de la póliza
$hoja -> setCellValue('A7', ("Póliza de ".$tipoPol))-> setCellValue('A8', "Fecha") -> setCellValue('A9', "Concepto general")-> setCellValue('C8', "Folio");

//poner estilo
$hoja->mergeCells('A7:D7');
$hoja->getStyle('A7')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');
$hoja->getStyle('A8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');
$hoja->getStyle('A9')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');
$hoja->getStyle('C8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

//encabezados
$estilo = $hoja->getStyle('A7');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A8');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A9');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('C8');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//contenido encabezados poliza
$hoja-> setCellValue('B8', $fecha)-> setCellValue('D8', $idc)-> setCellValue('B9', $conGral);

$hoja->getStyle('B9')->applyFromArray($style);
$hoja->mergeCells('B9:D9');

$estilo = $hoja->getStyle('B8');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('D8');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B9');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

//colocar los bordes 
$estilo = $hoja->getStyle('B8');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);
$estilo = $hoja->getStyle('D8');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);
$estilo = $hoja->getStyle('B9');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//contenido conceptos individual
$hoja-> setCellValue('A10', 'Concepto')-> setCellValue('B10', 'Debe')-> setCellValue('C10', 'Haber')-> setCellValue('D10', 'Descripción del documento');
$hoja->getStyle('A10:D10')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');

//encabezados
$estilo = $hoja->getStyle('A10');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B10');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('C10');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('D10');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
$debe=0;
$haber=0;
for($i=0; $i<count($datosInd); $i++){
    $concep= $datosInd[$i]["DesPolInd"];
    $monto= $datosInd[$i]["Monto"];
    $descri=$datosInd[$i]["DesDocInd"];
    $accion= $datosInd[$i]["IdPolAcc"];
    $idpol= $datosInd[$i]["IdPolInd"];
    if ($accion=="1"){
        $debe+=$monto;
        $monto=number_format($monto, 2, '.', ',');
        $monto="$".$monto;
        $hoja->setCellValue('A'.strval($i+11), $concep)->setCellValue('B'.strval($i+11), $monto)->setCellValue('C'.strval($i+11), " ")->setCellValue('D'.strval($i+11), $descri);
    }else if ($accion=="2"){
        $haber+=$monto;
        $monto=number_format($monto, 2, '.', ',');
        $monto="$".$monto;
        $hoja->setCellValue('A'.strval($i+11), $concep)->setCellValue('B'.strval($i+11), " ")->setCellValue('C'.strval($i+11), $monto)->setCellValue('D'.strval($i+11), $descri);
    }

    $hoja->getStyle('D'. strval($i+11))->applyFromArray($style);
    $hoja->getStyle('A'. strval($i+11))->applyFromArray($style);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+11));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('B'. strval($i+11));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('C'. strval($i+11));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('D'. strval($i+11));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

}
//colocar los bordes
$estilo = $hoja->getStyle('A10:D'.strval($i+11));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

$debe=number_format($debe, 2, '.', ',');
$debe="$".$debe;
$haber=number_format($haber, 2, '.', ',');
$haber="$".$haber;

//contenido sumas
$hoja-> setCellValue('A'.strval($i+11), 'Sumas iguales')-> setCellValue('B'.strval($i+11), $debe)-> setCellValue('C'.strval($i+11), $haber)
-> setCellValue('D'.strval($i+11), '')-> setCellValue('A'.strval($i+12), 'Realizó')-> setCellValue('B'.strval($i+12), $nombre);
$hoja->getStyle('A'.strval($i+11))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');
$hoja->getStyle('D'.strval($i+11))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');
$hoja->getStyle('A'.strval($i+12))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD9D9D9');

$hoja->getStyle('A'.strval($i+12))->applyFromArray($style);
$hoja->mergeCells('B'.strval($i+12).':D'.strval($i+12));

//estilos
$estilo = $hoja->getStyle('A'.strval($i+11));
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('D'.strval($i+11));
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño4

$estilo = $hoja->getStyle('A'.strval($i+12));
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('000000');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B'.strval($i+11));
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('C'.strval($i+11));
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B'.strval($i+12));
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B'.strval($i+11));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);
$estilo = $hoja->getStyle('C'.strval($i+11));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);
$estilo = $hoja->getStyle('B'.strval($i+12));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(50);
$hoja->getColumnDimension('B')->setWidth(30);
$hoja->getColumnDimension('C')->setWidth(30);
$hoja->getColumnDimension('D')->setWidth(50);
$hoja->getRowDimension(9)->setRowHeight(42);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Pólizas de '.$nomArchivo. '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
?>