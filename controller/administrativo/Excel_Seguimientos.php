<?php
//importar los archivos necesarios

use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Seguimiento.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los datos
$base = new Mostrar_Seguimiento();

$cursos = $base->buscar_cursos();
$proyectos = $base->buscar_proyectos();
$certificaciones = $base->buscar_certificaciones();

//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de seguimientos al " . date('d-m-Y'))->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//-----------------------------------------------crear la hoja de cursos----------------------------------------------
$spreadsheet->setActiveSheetIndex(0)->setTitle("Cursos");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Clave") -> setCellValue("B1", "Nombre");

$hoja->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:B1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
for($i=0; $i<count($cursos); $i++){
    $clave= $cursos[$i]["IdSeg"];
    $nombre = $cursos[$i]["NomCur"];

    $hoja->setCellValue('A'.strval($i+2), $clave)->setCellValue('B'.strval($i+2), $nombre);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2) . ':B' . strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño
}

//colocar los bordes
$estilo = $hoja->getStyle('A2:B'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(10);
$hoja->getColumnDimension('B')->setWidth(50);

//-----------------------------------crear la hoja de proyectos--------------------------------------------------
$spreadsheet->createSheet(1);
$spreadsheet->setActiveSheetIndex(1)->setTitle("Proyectos");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Clave") -> setCellValue("B1", "Nombre");

$hoja->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:B1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
for($i=0; $i<count($proyectos); $i++){
    $clave= $proyectos[$i]["IdSeg"];
    $nombre = $proyectos[$i]["NomProyecto"];

    $hoja->setCellValue('A'.strval($i+2), $clave)->setCellValue('B'.strval($i+2), $nombre);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2) . ':B' . strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño
}

//colocar los bordes
$estilo = $hoja->getStyle('A2:B'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(10);
$hoja->getColumnDimension('B')->setWidth(50);

//-----------------------------------crear la hoja de certificaciones--------------------------------------------------
$spreadsheet->createSheet(2);
$spreadsheet->setActiveSheetIndex(2)->setTitle("Certificaciones");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Clave") -> setCellValue("B1", "Nombre");

$hoja->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:B1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
for($i=0; $i<count($certificaciones); $i++){
    $clave= $certificaciones[$i]["IdSeg"];
    $nombre = $certificaciones[$i]["NomCertInt"];

    $hoja->setCellValue('A'.strval($i+2), $clave)->setCellValue('B'.strval($i+2), $nombre);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2) . ':B' . strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño
}

//colocar los bordes
$estilo = $hoja->getStyle('A2:B'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(10);
$hoja->getColumnDimension('B')->setWidth(50);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de seguimientos al '. date('d-m-Y'). '.Xlsx"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>