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
$resultados = $base->DatosGenerales($idc);
//$datosInd = $base->getDatosInd($idc);

//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de pólizas al " . date('d-m-Y'))->setCreator("Colegio de Ingenieros en Sistemas Computacionales")
->setCategory("Reporte de Pólizas")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//-----------------------------------------------crear la hoja de ingresos----------------------------------------------
$spreadsheet->setActiveSheetIndex(0)->setTitle("Ingresos");
$hoja = $spreadsheet->getActiveSheet(); 

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Fólio") -> setCellValue("B1", "Tipo de servicio") -> setCellValue("C1", "Concepto general")
-> setCellValue("D1", "Fecha") -> setCellValue("E1", "Realizado por");

$hoja->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:E1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$style = [
    'alignment' => [
        'wrapText' => true]];

//llenar el archivo con los datos
for($i=0; $i<count($resultados); $i++){
    //guardar los datos de la certificacion actual 
    $nombre = $resultados[$i]["Nombre"];
    $conGral = $resultados[$i]["CoceptoGral"];
    $fecha = $resultados[$i]["FechaPolGral"];
    $tipoPol = $resultados[$i]["NombrePol"];

    //poner los daros en la hoja
    $hoja->setCellValue('A'. strval($i+2), $nombre)->setCellValue('B'.strval($i+2), $conGral)->setCellValue('C'. strval($i+2), $fecha)->setCellValue('D'. strval($i+2), $tipoPol);
}


//colocar los bordes
$estilo = $hoja->getStyle('A2:E'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(25);
$hoja->getColumnDimension('B')->setWidth(25);
$hoja->getColumnDimension('C')->setWidth(50);
$hoja->getColumnDimension('D')->setWidth(25);
$hoja->getColumnDimension('E')->setWidth(50);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de pólizas al '. date('d-m-Y'). '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
?>