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

                $nombre = $resultado[$i]["NomPerso"];
                $correo = $resultado[$i]["CorreoPerso"];
            }else if ($valTipo=="outplacement"){

                $nombre = $resultado[$i]["NomUsuaEmp"];
                $correo = $resultado[$i]["CorreoUsuaemp"];
            }

            
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $correo . '</td>';
            $salida .= '<td>' . $resultado[$i]["FechaSer"] . '</td>';
            $salida .= '<td>' . $resultado[$i]["EstatusSer"] . '</td>';
            $salida .= '<td>  <a href="#">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

