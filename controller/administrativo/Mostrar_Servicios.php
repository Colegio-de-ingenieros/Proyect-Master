<?php
require_once('../../model/administrativo/Mostrar_Servicios.php');
$objeto=new Mostrar_Servicio();

$salida = '';

$valTipo=$_POST["tipo"];


if($valTipo!=""){
    if ($valTipo=="headhunter"){
        $resultado = $objeto->buscar_headhunter();
    }else if ($valTipo=="outplacement"){
        $resultado = $objeto->buscar_outplacement();
    }

    if (isset($_POST['consulta'])){
        $busqueda=($_POST['consulta']);
        if ($valTipo=="headhunter"){
            $resultado = $objeto->consul_intel_headhunter($busqueda);
        }else if ($valTipo=="outplacement"){
            $resultado = $objeto->consul_intel_outplacement($busqueda);
        }
    }

    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '<table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Fecha de aplicación</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                
                    <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            if ($valTipo=="headhunter"){
                $id = $resultado[$i]["IdPerso"];
                $nombre = $resultado[$i]["NomPerso"];
                $correo = $resultado[$i]["CorreoPerso"];
                $telefono = $resultado[$i]["TelMPerso"];
            }else if ($valTipo=="outplacement"){
                $id = $resultado[$i]["IdAreaEmp"];
                $nombre = $resultado[$i]["NomEncArea"];
                $correo = $resultado[$i]["CorreoEncArea"];
                $telefono = $resultado[$i]["TelFEncArea"];
            }

            if ($resultado[$i]["EstatusSer"] == '0') {
                $estatus = "En espera";
            } else if ($resultado[$i]["EstatusSer"] == '1') {
                $estatus = "Aprobado";
            } else if ($resultado[$i]["EstatusSer"] == '2') {
                $estatus = "Rechazado";
            }

            
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $telefono . '</td>';
            $salida .= '<td>' . $correo . '</td>';
            $salida .= '<td>' . $resultado[$i]["FechaSer"] . '</td>';
            $salida .= '<td>' . $estatus . '</td>';
            $salida .= '<td>  <a href="../../controller/administrativo/Mostrar_Oferta_Servicios.php?id='.$id.'">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </td>';
            $salida .= '</tr>';   
        }
    } 
    else {
        $salida .= 'No se encontraron resultados';
    }

} else{
    $salida .= "";
}
echo $salida;

?>

