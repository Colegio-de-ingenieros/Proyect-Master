<?php
$idc = $_GET["idc"];
//importar los archivos necesarios
use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Historial.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$negro = new Color('00000000');
$blanco = new Color('FFFFFFFF');

//hacer la consulta para obtener los precios
$base = new Historial();
$base->conexion();
$asociados = $base->historialAsoc($idc);
$general = $base->historialGen($idc);

//obtiene los datos de la certificacion
$datosCert = $base->getCertificacionesId($idc);
$nombre = $datosCert[0]["NomCertInt"];
$abre = $datosCert[0]["abrevCertInt"];
$desc = $datosCert[0]["DesCerInt"];
$clave = $datosCert[0]["ClaveCerInt"];


//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Historial de precios de " . $nombre)->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Historial");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de los datos de la certificación
$hoja->setCellValue('A1', "Identificador:")->setCellValue('A2', 'Abreviación:')->setCellValue('A3', 'Nombre:')->setCellValue('A4', 'Descripción:');



//formato de los encabezados
$hoja->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

$estilo = $hoja->getStyle('A1:A4');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($blanco);

$estilo = $hoja->getStyle('A1:A4');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//comiba la segunda y tercer columna en los datos
$hoja->mergeCells('B1:C1');
$hoja->mergeCells('B2:C2');
$hoja->mergeCells('B3:C3');
$hoja->mergeCells('B4:C4');

//poner los datos de la certificacion
$hoja->setCellValue('B1', $clave);
$hoja->setCellValue('B2', $abre);
$hoja->setCellValue('B3', $nombre);
$hoja->setCellValue('B4', $desc);

//formato de los datos de la certificacion
$estilo = $hoja->getStyle('B1:C5');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($negro);

$estilo = $hoja->getStyle('B1:C4');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

//crear un objeto de estilo para ajustar el texto de descripcion
$style = [
    'alignment' => [
        'wrapText' => true
    ]
];

//ajustar el texto de la descripcion
$hoja->getStyle('B4:C4')->applyFromArray($style);

//poner los encabezados de las columnas
$hoja -> setCellValue('A6', "Fecha") -> setCellValue("B6", "Precio general") -> setCellValue("C6", "Precio socio/asociado");

//poner estilo a los encabezados
$hoja->getStyle('A6:C6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

$estilo = $hoja->getStyle('A6:C6');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar el archivo con los datos
for($i=0; $i<count($asociados); $i++){
    //guardar los datos de la certificacion actual 
    $fecha = date('d-m-Y', strtotime($asociados[$i]["FechaH"]));
    $precioG = $general[$i]["PrecioH"];
    $precioA = $asociados[$i]["PrecioH"];

    //poner las celdas de los precios como tipo money
    $hoja->getStyle('B'. strval($i+7))->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $hoja->getStyle('C' . strval($i+7))->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    //poner los datos en la tabla
    $hoja->setCellValue('A'. strval($i+7), $fecha)->setCellValue('B'.strval($i+7), $precioG)->setCellValue('C'. strval($i+7), $precioA);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+7));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    //centrar el contenido
    $estilo = $hoja->getStyle('B'. strval($i+7) . ':C' . strval($i+7));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //alinea el contenido a la derecha
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

}

//colocar los bordes
$estilo = $hoja->getStyle('A7:C'.strval($i+7));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($negro);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(26);
$hoja->getColumnDimension('B')->setWidth(26);
$hoja->getColumnDimension('C')->setWidth(26);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Historial de precios de ' . $nombre. '.Xlsx"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
