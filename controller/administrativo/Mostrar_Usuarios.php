<?php
require_once('../../model/administrativo/Mostrar_Usuarios.php');
$objeto=new Mostrar_Usuarios();

$salida = '';

$valTipo=$_POST["tipo"];


if($valTipo!=""){
    if ($valTipo=="asociados"){
        $resultado = $objeto->buscar_asociados();
    }else if ($valTipo=="socios"){
        $resultado = $objeto->buscar_socios();
    }else if ($valTipo=="empresas"){
        $resultado = $objeto->buscar_empresas();
    }

    if (isset($_POST['consulta'])){
        $busqueda=($_POST['consulta']);
        if ($valTipo=="asociados"){
            $resultado = $objeto->consul_intel_asociados($busqueda);
        }else if ($valTipo=="socios"){
            $resultado = $objeto->consul_intel_socios($busqueda);
        }elseif ($valTipo=="empresas"){
            $resultado = $objeto->consul_intel_empresas($busqueda);
        }
    }

    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '<table>
                        <thead>
                            <tr>
                                <th>Número inteligente</th>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
            if ($valTipo=="asociados" or $valTipo == "socios"){
                //$auxValTipo="Curso";
                $numInte= $resultado[$i]["NInteligente"];
                $nombre = $resultado[$i]["Nombre"];
                $idUsuario = $resultado[$i]["IdPerso"];

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $numInte . '</td>';
                $salida .= '<td>' . $nombre . '</td>';
                $salida .= '<td>  <a href="../../view/administrativo/Vista_Datos_Usuario.html?usuario='.$idUsuario.'">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#">Cursos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#">Cuotas</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>';
                $salida .= '</tr>';  

            }else if ($valTipo=="empresas"){
                //$auxValTipo="Certificacion";
                $numInte= $resultado[$i]["NInteligente"];
                $nombre = $resultado[$i]["NomUsuaEmp"];
                $idUsuario = $resultado[$i]["RFCUsuaEmp"];

                //escribe los valores en la tabla
                $salida .= '<tr>';
                $salida .= '<td>' . $numInte . '</td>';
                $salida .= '<td>' . $nombre . '</td>';
                $salida .= '<td>  <a href="../../controller/administrativo/Mostrar_Empresa_Individual.php?id='.$numInte.'">Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="../../view/administrativo/Vista_Cuotas_Empresa.html?id='.$numInte.'">Cuotas</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>';
                $salida .= '</tr>';
            }  
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

<script src="../../controller/administrativo/js/Eliminar_Seguimiento_Confirmacion.js"></script>