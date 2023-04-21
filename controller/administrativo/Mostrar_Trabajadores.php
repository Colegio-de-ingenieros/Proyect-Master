<?php
include_once('../../model/administrativo/Mostrar_Trabajadores.php');
$salida = '';
$base = new MostrarTrabajadores();
$base->instancias();

$rfc=0;
if (isset($_POST['consulta'])) {
    $busqueda = $_POST['consulta'];
    $resultado = $base->buscador($busqueda);
    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '
        <style>
        table{
            width: 150%;
            border-collapse: collapse;
            font-family: "Manrope";
    
        }
        
        .header_table thead th {
            
            top: 0;
            background-color: #085262;
            color: #e6e7e8;
            font-size: 1.125rem;
        }
        th,td {
            border-bottom: 1px solid #000000;
            padding: 10px 20px;
            font-size: 15px;
            text-align: center;
            background-color: #dfe3e7;
        }
        .di{
           padding-top: 20px;
        }
        </style>
        <div class="di">
        <table class="header_table" >
                        <thead  >
                            <tr>
                                <th>RFC</th>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Correo electrónico</th>
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
            $salida .= '<td><a href="../../controller/administrativo/Get_Trabajadores.php?rfc='.$rfc.'" >Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="confirmDesactiv()" class="table_item__link">Eliminar</a></td>';
            //
            //
            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
        //echo "si entra al else";
        $salida .= 'No se encontraron resultados';
    }
} else {
    $resultado = $base->getTrabajadores();
    if ($resultado == true) {
        //pone los encabezados de la tabla
        $salida .= '
        <style>
        table{
            width: 150%;
            border-collapse: collapse;
            font-family: "Manrope";
    
        }
        
        .header_table thead th {
            
            top: 0;
            background-color: #085262;
            color: #e6e7e8;
            font-size: 1.125rem;
        }
        th,td {
            border-bottom: 1px solid #000000;
            padding: 10px 20px;
            font-size: 15px;
            text-align: center;
            background-color: #dfe3e7;
        }
        .di{
           padding-top: 20px;
        }
        </style>
        <div class="di">
        <table class="header_table" >
                        <thead  >
                            <tr>
                                <th>RFC</th>
                                <th>Nombre</th>
                                <th>Apellido paterno</th>
                                <th>Apellido materno</th>
                                <th>Correo electrónico</th>
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
            $salida .= '<td><a href="../../controller/administrativo/Get_Trabajadores.php?rfc='.$rfc.'" >Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" onclick="confirmDesactiv()" class="table_item__link">Eliminar</a></td>';
            //<a href="../../controller/administrativo/Eliminar_Trabajadores.php?rfc='.$rfc.'" class="table_item__link">Eliminar</a></td>';
            //
            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
        //echo "si entra al else";
        $salida .= 'No se encontraron resultados';
    }
}
//manda a hacer la busqueda
//$resultado = $base->getTrabajadores();
//echo '<script>alert("si entra al php");</script>';
//echo "si entra al php";


$salida .= "</tbody></table>";
echo '<script type="text/javascript">

function confirmDesactiv()
{
   var flag = confirm("¿Estás seguro de eliminar al trabajador?");
   if(flag){
        window.location.assign("../../controller/administrativo/Eliminar_Trabajadores.php?rfc='.$rfc.'");
        alert("Eliminado con éxito");
   }else
        window.location.assign("Vista_Trabajadores.php");
}

</script>';
//echo '<script>alert("si entra al php");</script>';

echo $salida;
echo '<script src="../../controller/administrativo/js/Eliminar_Trabajadores_Confirmacion.js"></script>';
?>
<script src="../../controller/administrativo/js/Eliminar_Trabajadores_Confirmacion.js"></script>