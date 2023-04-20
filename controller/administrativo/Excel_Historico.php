<?php
$idc = $_GET["idc"];
//importar los archivos necesarios
use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Historial.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los precios
$base = new Historial();
$base->conexion();
$asociados = $base->historialAsoc($idc);
$general = $base->historialGen($idc);
$datosCert = $base->getCertificacionesId($idc);
$nombre = $datosCert[0]["NomCertInt"];


//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Historial de precios de " . $nombre)->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Historial");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Fecha") -> setCellValue("B1", "Precio general") -> setCellValue("C1", "Precio socio/asociado");

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('085262');


 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B1');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('C1');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar el archivo con los datos
for($i=0; $i<count($asociados); $i++){
    //guardar los datos de la certificacion actual 
    $fecha = date('d-m-y', strtotime($asociados[$i]["FechaH"]));
    $precioG = $general[$i]["PrecioH"];
    $precioA = $asociados[$i]["PrecioH"];

    //poner las celdas de los precios como tipo money
    $hoja->getStyle('B'. $i+2)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $hoja->getStyle('C' . $i + 2)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    //poner los datos en la tabla
    $hoja->setCellValue('A'. $i+2, $fecha)->setCellValue('B'.$i+2, $precioG)->setCellValue('C'. $i+2, $precioA);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. $i+2);
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('B'. $i+2);
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('C'. $i+2);
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño
}

//colocar los bordes
$estilo = $hoja->getStyle('A2:C'.$i+2);
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(26);
$hoja->getColumnDimension('B')->setWidth(26);
$hoja->getColumnDimension('C')->setWidth(26);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Historial de precios de ' . $nombre. '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
