<?php
ini_set('display_errors', 1);
//importar los archivos necesarios
use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Certificaciones.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los datos
$base = new MostrarCertificaciones();
$base->instancias();
$resultados = $base->getCertificaciones();

//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de certificaciones al " . date('d-m-Y'))->setCreator("Colegio de Ingenieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Certificaciones");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Nombre") -> setCellValue("B1", "Abreviación") -> setCellValue("C1", "Descripción") ->
    setCellValue("D1", "Precio general") -> setCellValue("E1", "Precio socio/asociado");

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');


 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:E1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//crear un objeto de estilo para ajustar el texto de descripcion
$style = [
    'alignment' => [
        'wrapText' => true]];

//llenar el archivo con los datos
for($i=0; $i<count($resultados); $i++){
    //guardar los datos de la certificacion actual 
    $idc = $resultados[$i]["IdCerInt"];
    $nombre = $resultados[$i]["NomCertInt"];
    $abre = $resultados[$i]["abrevCertInt"];
    $desc = $resultados[$i]["DesCerInt"];
    $status = $resultados[$i]["EstatusCertInt"];
    $precioG = $base->buscarUltimoPrecioG($idc);
    $precioA = $base->buscarUltimoPrecioA($idc);

    //poner las celdas de los precios como tipo money
    $hoja->getStyle('D'. strval($i+2))->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $hoja->getStyle('E' . strval($i+2))->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    //poner los datos en la tabla
    $hoja->setCellValue('A'. strval($i+2), $nombre)->setCellValue('B'.strval($i+2), $abre)->setCellValue('C'. strval($i+2), $desc)->
    setCellValue('D'. strval($i+2), $precioG)->setCellValue('E' . strval($i+2), $precioA);

    //aplicar el estilo a la descripción
    $hoja->getStyle('A'. strval($i+2))->applyFromArray($style);
    $hoja->getStyle('C'. strval($i+2))->applyFromArray($style);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2) . ':E' . strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    
}

//colocar los bordes
$estilo = $hoja->getStyle('A2:E'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(32);
$hoja->getColumnDimension('B')->setWidth(16);
$hoja->getColumnDimension('C')->setWidth(45);
$hoja->getColumnDimension('D')->setWidth(26);
$hoja->getColumnDimension('E')->setWidth(26);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de certificaciones al '. date('d-m-Y'). '.Xlsx"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>