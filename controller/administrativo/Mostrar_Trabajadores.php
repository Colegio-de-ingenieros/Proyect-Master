<?php
include_once('../../model/Mostrar_Trabajadores.php');
echo'<script type="text/javascript">
        alert("Tarea Guardada");
        window.location.href="index.php";
        </script>';
$salida = '';
$base = new MostrarTrabajadores();
$base->instancias();

//manda a hacer la busqueda
$resultado = $base->getTrabajadores();

if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table>
                    <thead>
                        <tr>
                            <th>RFC</th>
                            <th>Nombre</th>
                            <th>Apellido paterno</th>
                            <th>Apellido materno</th>
                            <th>Correo electronico</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
            <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $rfc = $resultado[$i]["RFCT"];
        $nombre = $resultado[$i]["NombreT"];
        $apat = $resultado[$i]["ApePT"];
        $amat = $resultado[$i]["ApeMT"];
        $correo = $resultado[$i]["CorreoT"];
        $telefono = $resultado[$i]["TelT"];
        //$extension = getExt($logo);

        //escribe los valores en la tabla
        $salida .= '<tr>';
        $salida .= '<td>' . $rfc. '</td>';
        $salida .= '<td>' . $nombre . '</td>';
        $salida .= '<td>' . $apat . '</td>';
        $salida .= '<td>' . $amat . '</td>';
        $salida .= '<td>' . $correo . '</td>';
        $salida .= '<td>' . $telefono . '</td>';
        $salida .= "<a href='editar.php?rfc=". $rfc ."'>Editar</a>""<a href='eliminar.php?rfc=". $rfc ."'>Eliminar</a>";
        $salida .= '</tr>';

        
    }
} 

else {
    $salida .= 'No se encontraron resultados';
}

$salida .= "</tbody></table>";
//echo '<script>alert("si entra al php");</script>';

echo $salida;

?>