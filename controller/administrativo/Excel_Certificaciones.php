<?php
//importar los archivos necesarios
include_once('../../model/Mostrar_Certificaciones.php');
require '../../config/CrearExcel/vendor/autoload.php';

//hacer la consulta para obtener los datos
$base = new MostrarCertificaciones();
$base->instancias();
$resultados = $base->getCertificaciones();

//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de certificaciones al " . date('d-m-Y'))->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle(date('D-M-Y'));
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Nombre") -> setCellValue("B1", "Abreviación") -> setCellValue("C1", "Descripción") ->
    setCellValue("D1", "Precio general") -> setCellValue("E1", "Precio socio/asociado");

//vrear un objeto de estilo para ajustar el texto de descripcion
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
    $hoja->getStyle('D'. $i+2)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
    $hoja->getStyle('E' . $i + 2)->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    //poner los datos en la tabla
    $hoja->setCellValue('A'. $i+2, $nombre)->setCellValue('B'.$i+2, $abre)->setCellValue('C'. $i+2, $desc)->
    setCellValue('D'. $i+2, $precioG)->setCellValue('E' . $i + 2, $precioA);

    //aplicar el estilo a la descripción
    $hoja->getStyle('C'. $i+2)->applyFromArray($style);
}

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(27);
$hoja->getColumnDimension('B')->setWidth(12);
$hoja->getColumnDimension('C')->setWidth(40);
$hoja->getColumnDimension('D')->setWidth(14);
$hoja->getColumnDimension('E')->setWidth(20);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de certificaciones al '. date('d-m-Y'). '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');

?>