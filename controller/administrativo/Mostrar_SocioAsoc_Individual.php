<?php

include_once('../../model/administrativo/Mostrar_SocioAsoc_Individual.php');

$objeto=new Mostrar_SocioAsoc();
$idp=$_POST["idP"];

$certifica=$objeto->get_certificacion($idp);
//Tabla para mostrar certificaciones
$salida = '';
 if ($certifica == true) {    
    $salida .= '<table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Organización</th>
                            <th>Fecha de emisión</th>
                            <th>Fecha de vigencia</th>
                        </tr>
                    </thead>
            
                <tbody>';

   
    for ($i = 0; $i < count($certifica); $i++) {
        $nombre= $certifica[$i]["NomCerExt"];
        $organizacion= $certifica[$i]["OrgCerExt"];
        $emision = $certifica[$i]["IniCerExt"];
        $vigencia = $certifica[$i]["FinCerExt"];
       
        $salida .= '<tr>';
        $salida .= '<td>' . $nombre . '</td>';
        $salida .= '<td>' . $organizacion . '</td>';
        $salida .= '<td>' . $emision . '</td>';
        $salida .= '<td>' . $vigencia. '</td>';
        
        $salida .= '</tr>';
        
    }
} 

else {
    $salida .= 'No registrado';
}

$salida .= "</tbody></table>";

echo $salida;

?>