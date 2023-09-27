<?php
//importar los archivos necesarios
use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_Cursos.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//hacer la consulta para obtener los precios
$base = new MostrarCurso();
$base->BD();
$resultado = $base->cursos_disponibles();


//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Reporte de proyectos al " . date('d-m-Y'))->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Proyectos")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Cursos");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Clave") -> setCellValue("B1", "Nombre") -> setCellValue("C1", "Duración");

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');


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

//crear un objeto de estilo para ajustar el texto de descripcion
$style = [
    'alignment' => [
        'wrapText' => true]];

//llenar el archivo con los datos
for($i=0; $i<count($resultado); $i++){
    //guardar los datos de la certificacion actual 
    $clave = $resultado[$i]["ClaveCur"];
    $nombre = $resultado[$i]["NomCur"];
    $duracion = $resultado[$i]["DuracionCur"];

    //poner los datos en la tabla
    $hoja->setCellValue('A'. strval($i+2), $clave)->setCellValue('B'.strval($i+2), $nombre)->setCellValue('C'. strval($i+2), $duracion);

    //aplicar el estilo a la descripción
    $hoja->getStyle('C'. strval($i+2))->applyFromArray($style);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('B'. strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    $estilo = $hoja->getStyle('C'. strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

}

//colocar los bordes
$estilo = $hoja->getStyle('A2:C'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(26);
$hoja->getColumnDimension('B')->setWidth(58);
$hoja->getColumnDimension('C')->setWidth(26);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Reporte de cursos al '. date('d-m-Y'). '.Xlsx"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

?>