<?php
//importar los archivos necesarios

use PhpOffice\PhpSpreadsheet\Style\Color;

include_once('../../model/administrativo/Mostrar_SocioAsociado.php');
include_once('../../model/administrativo/Mostrar_SocioAsoc_Individual.php');
require '../../controller/CrearExcel/vendor/autoload.php';

$color = new Color('000000');

//obtener el id del usuario
$id=$_GET['id'];

//hacer la consulta para obtener los datos del curso
$base = new MostrarSocioAsociado();
$base->instancias();
$id_arre = $base->getId($id);
$idSocio=$id_arre[0]["IdPerso"];
$cuotas = $base->cuotas_disponibles($idSocio); 

//consulta para obtener el nombre
$base2 = new Mostrar_SocioAsoc();
$resultado = $base2->get_datos($idSocio);
if($resultado != false){
    $nombre_persona = $resultado[0]["NomPerso"]." ".$resultado[0]["ApePPerso"]." ".$resultado[0]["ApeMPerso"];
}

else{
    $nombre_persona = $id;
}


//crear el objeto des excel
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

//establecer las propiedades del archivo
$spreadsheet->getProperties()->setTitle("Cuotas del usuario ". $nombre_persona)->setCreator("Colegio de Ingenieros en Sistemas Computacionales")
->setCategory("Reporte de Cuotas de usuario")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Cuotas");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Tipo") -> setCellValue("B1", "Fecha de inicio") -> setCellValue("C1", "Fecha de finalización") ->
    setCellValue("D1", "Monto")->setCellValue("E1", "Estado");

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');


 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:E1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

for($i=0; $i<count($cuotas); $i++){
    //guardar los datos de la cuota actual
    $idV = $cuotas[$i]["IdVigCuo"];
    $monto = $cuotas[$i]["MontoVigCuo"];
    $tipo = $cuotas[$i]["TipoCuota"];
    $fecha_inicio = $cuotas[$i]["IniVigCuo"];
    $fecha_fin = $cuotas[$i]["FinVigCuo"];
    $estatus = $cuotas[$i]["EstatusVigCuo"];
    if ($estatus==1) {
        $estatus="Aprobado";
        }
        else if ($estatus==2){
        $estatus="Rechazado";
        }
        else{
        $estatus="En espera";
        }


    //poner los daros en la hoja
    $hoja->setCellValue('A'. strval($i+2), $tipo)->setCellValue('B'.strval($i+2), $fecha_inicio)
    ->setCellValue('C'. strval($i+2), $fecha_fin)->setCellValue('D'. strval($i+2), $monto)->setCellValue("E".strval($i+2), $estatus);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2) . ':E' . strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

    //poner la celda de monto como tipo money
    $hoja->getStyle('D'. strval($i+2))->getNumberFormat()->setFormatCode(PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

    //alinear la celda de monto a la derecha
    $estilo = $hoja->getStyle('D'. strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

}

//colocar los bordes
$estilo = $hoja->getStyle('A2:E'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(40);
$hoja->getColumnDimension('B')->setWidth(40);
$hoja->getColumnDimension('C')->setWidth(15);
$hoja->getColumnDimension('D')->setWidth(20);
$hoja->getColumnDimension('E')->setWidth(20);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Cuotas del usuario '. $nombre_persona. '.Xlsx"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>