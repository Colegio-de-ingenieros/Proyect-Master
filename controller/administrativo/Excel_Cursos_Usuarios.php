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
$cursos = $base->cursos_disponibles($idSocio); 

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
$spreadsheet->getProperties()->setTitle("Cursos del usuario ". $nombre_persona)->setCreator("Colegio de Ingeneieros en Sistemas Computacionales")
->setCategory("Reporte de Cusros de usuario")->setCompany("CISIG")->setLastModifiedBy("CISCIG");

//establecer la hoja en la que vamos a trabajar
$spreadsheet->setActiveSheetIndex(0)->setTitle("Cursos");
$hoja = $spreadsheet->getActiveSheet();

//poner los encabezados de las columnas
$hoja -> setCellValue('A1', "Nombre") -> setCellValue("B1", "Organización") -> setCellValue("C1", "Horas") ->
    setCellValue("D1", "Estado");

//cambiar el color de las celdas de encabezado
$hoja->getStyle('A1:D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FF085262');


 //poner estilo a los encabezados
$estilo = $hoja->getStyle('A1:D1');
$estilo->getFont()->setBold(true)->setSize(12.5)->getColor()->setARGB('FFFFFFFF');
$estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
$estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
$estilo->getFont()->setName("Inter', sans-serif")->setSize(12.5); //cambiar el tipo de letra y tamaño

for($i=0; $i<count($cursos); $i++){
    //guardar los datos del curso actual
    $idV = $cursos[$i]["IdCurPerso"];
    $nombre = $cursos[$i]["NomCurPerso"];
    $horas = $cursos[$i]["HraCurPerso"];
    $organizacion = $cursos[$i]["OrgCurPerso"];
    $estatus = $cursos[$i]["EstatusCurPerso"];
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
    $hoja->setCellValue('A'. strval($i+2), $nombre)->setCellValue('B'.strval($i+2), $organizacion)->setCellValue('C'. strval($i+2), $horas)->setCellValue('D'. strval($i+2), $estatus);

    //centrar el contenido
    $estilo = $hoja->getStyle('A'. strval($i+2) . ':D' . strval($i+2));
    $estilo->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER); //centra el contenido horizontalmente
    $estilo->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER); //centra el contenido verticalmente
    $estilo->getFont()->setName("Inter', sans-serif")->setSize(11.5); //cambiar el tipo de letra y tamaño

}

//colocar los bordes
$estilo = $hoja->getStyle('A2:D'.strval($i+2));
$estilo->getBorders()->getHorizontal()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)->setColor($color);

//definir los tamaños de las columnas
$hoja->getColumnDimension('A')->setWidth(40);
$hoja->getColumnDimension('B')->setWidth(40);
$hoja->getColumnDimension('C')->setWidth(15);
$hoja->getColumnDimension('D')->setWidth(20);

//guardar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Cusros del usuario '. $nombre_persona. '.Xls"');
header('Cache-Control: max-age=0');

$writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
?>