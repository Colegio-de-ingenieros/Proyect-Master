<?php
//importar los archivos necesarios

use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Trabajadores.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los datos
$base = new MostrarTrabajadores();
$base->instancias();
$resultados = $base->getTrabajadores();

//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de trabajadores al " . date('d-m-Y'))->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Trabajadores");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "RFC") -> setCellValue("B1", "Nombre(s)") -> setCellValue("C1", "Apellido paterno") ->
    setCellValue("D1", "Apellido materno") -> setCellValue("E1", "Correo electrónico")->setCellValue('F1', 'Teléfono');

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('085262');


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

$estilo = $hoja->getStyle('D1');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('E1');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('F1');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar el archivo con los datos
for($i=0; $i<count($resultados); $i++){
    //guardar los datos de la certificacion actual 
    $rfc = $resultados[$i]["RFCT"];
    $nombre = $resultados[$i]["NombreT"];
    $app = $resultados[$i]["ApePT"];
    $apm = $resultados[$i]["ApeMT"];
    $correo = $resultados[$i]["CorreoT"];
    $telefono = $resultados[$i]["TelT"];

    //poner los datos en la tabla
    $hoja->setCellValue('A'. $i+2, $rfc)->setCellValue('B'.$i+2, $nombre)->setCellValue('C'. $i+2, $app)->
    setCellValue('D'. $i+2, $apm)->setCellValue('E' . $i + 2, $correo)->setCellValue('F' . $i + 2, $telefono);

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

    $estilo = $hoja->getStyle('D'. $i+2);
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('E'. $i+2);
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('F'. $i+2);
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño
}

//colocar los bordes
$estilo = $hoja->getStyle('A2:F'.$i+2);
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(20);
$hoja->getColumnDimension('B')->setWidth(45);
$hoja->getColumnDimension('C')->setWidth(30);
$hoja->getColumnDimension('D')->setWidth(30);
$hoja->getColumnDimension('E')->setWidth(34);
$hoja->getColumnDimension('F')->setWidth(15);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de trabajadores al '. date('d-m-Y'). '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
