<?php
include_once('../../model/administrativo/Modificar_Proyectos.php');
 
$data =[];

$obj = new ModificarProyecto();
$obj->conexion();
$idp = $_POST["idp"];
$nombre = $_POST["nom_proyecto"];
$inicio = $_POST["ini_proyecto"];
$fin = $_POST["fin_proyecto"];
$objetivo = $_POST["obj_proyecto"];
$monto = $_POST["monto_proyecto"];

$FechaI= new DateTime($inicio);
$FechaF= new DateTime($fin);

//Compara que la fecha fin sea posterios a la fecha de inicio
if ($FechaF > $FechaI){
    $obj->modificar($idp, $nombre, $inicio,$fin, $objetivo, $monto);
    $data=('Actualización exitosa');
    
}
else{
    $data('Fecha de finalización debe ser posterior a fecha de inicio');
}

echo json_encode($data); 


?>