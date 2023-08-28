<?php
//importar los archivos necesarios

use PhpOffice\PhpSpreadsheet\Style\Color;

require_once('../../model/administrativo/Mostrar_Servicios.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los datos
$objeto=new Mostrar_Servicio();

$headHunter = $objeto->buscar_headhunter();
$outplacement = $objeto->buscar_outplacement();


//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de servicios al " . date('d-m-Y'))->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Servicios")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//-----------------------------------------------crear la hoja de headhunter    ----------------------------------------------
$spreadsheet->setActiveSheetIndex(0)->setTitle("Headhunter");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Nombre") -> setCellValue("B1", "Teléfono")->setCellValue("C1", "Correo electrónico")
->setCellValue("D1", "Fecha de aplicación")->setCellValue("E1", "Estatus");

$hoja->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:E1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//crear un objeto de estilo para ajustar el texto de nombre
$style = [
    'alignment' => [
        'wrapText' => true]];

//llenar la hoja con los datos
for($i=0; $i<count($headHunter); $i++){
    $id = $headHunter[$i]["IdPerso"];
    $nombre = $headHunter[$i]["NomPerso"].' ' . $headHunter[$i]["ApePPerso"] . ' ' . $headHunter[$i]["ApeMPerso"];
    $correo = $headHunter[$i]["CorreoPerso"];
    $telefono = $headHunter[$i]["TelMPerso"];
    $fecha = $headHunter[$i]["FechaSer"];

    //poner un guion en caso de que el campo de teléfono sea nulo
    if ($telefono == "" or $telefono == null){
        $telefono = ' - ';
    }

    //mosrtar el estatus
    if ($headHunter[$i]["EstatusSer"] == '0') {
        $estatus = "En espera";
    } else if ($headHunter[$i]["EstatusSer"] == '1') {
        $estatus = "Aprobado";
    } else if ($headHunter[$i]["EstatusSer"] == '2') {
        $estatus = "Rechazado";
    }else if ($headHunter[$i]["EstatusSer"] == '3') {
        $estatus = "Cancelado";
    }

    $hoja -> setCellValue('A' . strval($i+2), $nombre) -> setCellValue("B". strval($i+2), $telefono)
    ->setCellValue("C". strval($i+2), $correo)->setCellValue("D". strval($i+2), $fecha)
    ->setCellValue("E". strval($i+2), $estatus);
    
    $hoja->getStyle('A' . strval($i+2))->applyFromArray($style);

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
$hoja->getColumnDimension('A')->setWidth(45);
$hoja->getColumnDimension('B')->setWidth(20);
$hoja->getColumnDimension('C')->setWidth(30);
$hoja->getColumnDimension('D')->setWidth(25);
$hoja->getColumnDimension('E')->setWidth(15);


//-----------------------------------------------crear la hoja de outplacement    ----------------------------------------------
$spreadsheet->createSheet(1);
$spreadsheet->setActiveSheetIndex(1)->setTitle("Outplacement");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Nombre") -> setCellValue("B1", "Teléfono")->setCellValue("C1", "Correo electrónico")
->setCellValue("D1", "Fecha de aplicación")->setCellValue("E1", "Estatus");

$hoja->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:F1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//crear un objeto de estilo para ajustar el texto de nombre
$style = [
    'alignment' => [
        'wrapText' => true]];

//llenar la hoja con los datos
for($i=0; $i<count($outplacement); $i++){
    $id = $outplacement[$i]["IdPerso"];
    $nombre = $outplacement[$i]["NomPerso"].' ' . $outplacement[$i]["ApePPerso"] . ' ' . $outplacement[$i]["ApeMPerso"];
    $correo = $outplacement[$i]["CorreoPerso"];
    $telefono = $outplacement[$i]["TelMPerso"];
    $fecha = $outplacement[$i]["FechaSer"];

    //poner un guion en caso de que el campo de teléfono sea nulo
    if ($telefono == "" or $telefono == null){
        $telefono = ' - ';
    }

    //mosrtar el estatus
    if ($outplacement[$i]["EstatusSer"] == '0') {
        $estatus = "En espera";
    } else if ($outplacement[$i]["EstatusSer"] == '1') {
        $estatus = "Aprobado";
    } else if ($outplacement[$i]["EstatusSer"] == '2') {
        $estatus = "Rechazado";
    }else if ($outplacement[$i]["EstatusSer"] == '3') {
        $estatus = "Cancelado";
    }

    $hoja -> setCellValue('A' . strval($i+2), $nombre) -> setCellValue("B". strval($i+2), $telefono)
    ->setCellValue("C". strval($i+2), $correo)->setCellValue("D". strval($i+2), $fecha)
    ->setCellValue("E". strval($i+2), $estatus);

    $hoja->getStyle('A' . strval($i+2))->applyFromArray($style);

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
$hoja->getColumnDimension('A')->setWidth(45);
$hoja->getColumnDimension('B')->setWidth(20);
$hoja->getColumnDimension('C')->setWidth(30);
$hoja->getColumnDimension('D')->setWidth(25);
$hoja->getColumnDimension('E')->setWidth(15);
//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de servicios al '. date('d-m-Y'). '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');


?>