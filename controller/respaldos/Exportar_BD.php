<?php

$host='localhost';
$nombreBD='u283658544_colegiociscig';
$usuario='u283658544_colegiociscig';
$password='ColegioCISCIG2023.';

$fecha=date('Y-m-d-His');

$nombre_sql=$nombreBD . '_' . $fecha.'.sql';

$dump="mysqldump -h$host -p$password -u$usuario $nombreBD > $nombre_sql";

system($dump,$output);

$zip = new ZipArchive(); 
$nombre_zip=$nombreBD . '_' . $fecha.'.zip';

if ($zip->open($nombre_zip, ZIPARCHIVE::CREATE) === true) { 
    $zip->addFile($nombre_sql); 
    $zip->close();
    
    #header("Location: $nombre_zip");
} else {
    $data=('Error en la exportación');
}

header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=$nombre_zip");
// Leer el contenido binario del zip y enviarlo
readfile($nombre_zip);

// Si quieres puedes eliminarlo después:
unlink($nombre_sql); 
unlink($nombre_zip);

?>