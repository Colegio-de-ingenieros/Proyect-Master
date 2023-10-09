<?php

$host='localhost';
$nombreBD='u283658544_colegiociscig';
$usuario='u283658544_colegiociscig';
$password='ColegioCISCIG2023.';

$fecha=date('dmY-His');

$nombre_sql=$nombreBD . '_' . $fecha.'.sql';

$dump="mysqldump -h$host -p$password -u$usuario $nombreBD > $nombre_sql";

system($dump,$output);


$zip = new ZipArchive(); 
$salida_zip = $nombreBD . '.zip';

if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) { //Creamos y abrimos el archivo ZIP
    $zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
    $zip->close(); //Cerramos el ZIP
    unlink($salida_sql); //Eliminamos el archivo temporal SQL
    header("Location: $salida_zip"); // Redireccionamos para descargar el Arcivo ZIP
} else {
    echo 'Error'; //Enviamos el mensaje de error
}

?>