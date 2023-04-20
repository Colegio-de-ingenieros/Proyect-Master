<?php
$claveCurso = $_GET["id"];

//importar los archivos necesarios
use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/Mostar_Temario.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$negro = new Color('000000');
$blanco = new Color('FFFFFF');

//hacer la consulta para obtener los datos
$base = new MostrarTemas();
$base->BD();
$temas = $base->tema($claveCurso);
$datosCurso = $base->cursos($claveCurso);

//guarda los datos del curso en variables
$nombre = $datosCurso[0]["NomCur"];
$duracion = $datosCurso[0]["DuracionCur"];
$objetivo = $datosCurso[0]["ObjCur"];


//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Temario del curso: ". $nombre)->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Certificaciones")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Temario");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Clave") -> setCellValue("A2", "Nombre") -> setCellValue("A3", "Duración") ->
    setCellValue("A4", "Objetivo") -> setCellValue("A6", "Temario");

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('085262');
$hoja->getStyle('A6')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('085262');


 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A2');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A3');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A4');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('A6');
$estilo->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

//colocar los bordes de encabezados
$estilo = $hoja->getStyle('A1:A4');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($blanco);
$estilo = $hoja->getStyle('A6');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($blanco);

//poner los datos del curso
$hoja -> setCellValue('B1', $claveCurso) -> setCellValue("B2", $nombre) -> setCellValue("B3", $duracion) ->
    setCellValue("B4", $objetivo);

//centrar el contenido
$estilo = $hoja->getStyle('B1');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B2');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B3');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

$estilo = $hoja->getStyle('B4');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

//colocar los bordes de los datos
$estilo = $hoja->getStyle('B1:B5');
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($negro);

//crear un objeto de estilo para ajustar los tectos largos
$style = [
    'alignment' => [
        'wrapText' => true
    ]
];

//aplicar el estilo al objetivo
$hoja->getStyle('B4')->applyFromArray($style);

//colocar el temario
$fila = 7;
$temas = $base->tema($claveCurso);

for($i=0; $i<count($temas); $i++){
    //guarda los datos del tema
    $tema = $temas[$i]["NomTema"];
    $idTema = $temas[$i]["IdTema"];

    //pone el nombre del tema en el archivo
    $hoja->setCellValue('A'. strval($fila), $tema);

    $estilo = $hoja->getStyle('A'. strval($fila));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5)->setBold(true); //cambiar el tipo de letra y tamaño

    $fila++;

    //obtiene los subtemas correspondientes al tema actual
    $subtemas = $base->subtema($claveCurso, $idTema);

    for($j=0; $j<count($subtemas); $j++){
        //pone los subtemas en el archivo
        $subtema = $subtemas[$j]["NomSubT"];
        $hoja->setCellValue('A' . strval($fila), $subtema);

        $estilo = $hoja->getStyle('A' . strval($fila));
        $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
        $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
        $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

        $fila++;
    }

    $fila ++;
}

//colocar los bordes de los datos
$estilo = $hoja->getStyle('A7:A'. $fila-1);
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($negro);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(45);
$hoja->getColumnDimension('B')->setWidth(45);
//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Temario del curso '. $nombre .  '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
