<?php
//importar los archivos necesarios

use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Usuarios.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los datos
$objeto=new Mostrar_Usuarios();

$asociados = $objeto->buscar_asociados();
$socios = $objeto->buscar_socios();
$empresas = $objeto->buscar_empresas();

//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de usuarios al " . date('d-m-Y'))->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Usuarios")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//-----------------------------------------------crear la hoja de asociados----------------------------------------------
$spreadsheet->setActiveSheetIndex(0)->setTitle("Asociados");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Número inteligente") -> setCellValue("B1", "Nombre");

$hoja->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:B1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
for($i=0; $i<count($asociados); $i++){
    $clave= $asociados[$i]["NInteligente"];
    $nombre = $asociados[$i]["Nombre"];

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
$hoja->getColumnDimension('A')->setWidth(25);
$hoja->getColumnDimension('B')->setWidth(50);

//-----------------------------------crear la hoja de socios--------------------------------------------------
$spreadsheet->createSheet(1);
$spreadsheet->setActiveSheetIndex(1)->setTitle("Socios");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Número inteligente") -> setCellValue("B1", "Nombre");

$hoja->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:B1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
for($i=0; $i<count($socios); $i++){
    $clave= $socios[$i]["NInteligente"];
    $nombre = $socios[$i]["Nombre"];

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
$hoja->getColumnDimension('A')->setWidth(25);
$hoja->getColumnDimension('B')->setWidth(50);

//-----------------------------------crear la hoja de certificaciones--------------------------------------------------
$spreadsheet->createSheet(2);
$spreadsheet->setActiveSheetIndex(2)->setTitle("Empresas");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Número inteligente") -> setCellValue("B1", "Nombre");

$hoja->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');

 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:B1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//llenar la hoja con los datos
for($i=0; $i<count($empresas); $i++){
    $clave= $empresas[$i]["NInteligente"];
    $nombre = $empresas[$i]["NomUsuaEmp"];

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
$hoja->getColumnDimension('A')->setWidth(25);
$hoja->getColumnDimension('B')->setWidth(50);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de usuarios al '. date('d-m-Y'). '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
?>