<?php
require_once('../../model/administrativo/Mostrar_Seguimiento.php');
$objeto=new Mostrar_Seguimiento();

$salida = '';



if(isset($_POST["tipo"])){
    $valTipo=$_POST["tipo"];
    //$data = [$radio];
    if ($valTipo=="curso"){
        $resultado = $objeto->buscar_cursos();
    }else if ($valTipo=="proyecto"){
        $resultado = $objeto->buscar_proyectos();
    }else{
        $resultado = $objeto->buscar_certificaciones();
    }

}
$resultado = $objeto->buscar_certificaciones();

if (isset($_POST['consulta'])){
    $q=($_POST['consulta']);
    $resultado = $objeto->buscar_cursos();
}

if ($resultado == true) {
    //pone los encabezados de la tabla
    $salida .= '<table>
                    <thead>
                        <tr>
                            <th>Clave</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
            
                <tbody>';

    //agrega los resultados de la busqueda
    for ($i = 0; $i < count($resultado); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $clave= $resultado[$i]["IdSeg"];
        $nombre = $resultado[$i]["NomCertInt"];
        

        //escribe los valores en la tabla
        $salida .= '<tr>';
        $salida .= '<td>' . $clave . '</td>';
        $salida .= '<td>' . $nombre . '</td>';
        $salida .= '<td>  <a href="#">Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a href="#">Eliminar</a></td>';
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