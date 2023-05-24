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
            $rfcc="'".$rfc."'";
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $rfc. '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $apat . '</td>';
            $salida .= '<td>' . $amat . '</td>';
            $salida .= '<td>' . $correo . '</td>';
            $salida .= '<td>' . $telefono . '</td>';
            $salida .= '<td><a href="../../controller/administrativo/Get_Trabajadores.php?rfc='.$rfc.'" >Modificar</a>&nbsp;&nbsp;&nbsp<a href="#" onclick="confirmDesactiv(String('.$rfcc.'))" class="table_item__link">Eliminar</a></td>';
            //
            //
            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
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
            $rfcc="'".$rfc."'";
            $salida .= '<td><a href="../../controller/administrativo/Get_Trabajadores.php?rfc='.$rfc.'" >Modificar</a>&nbsp;&nbsp;&nbsp<a href="#" onclick="confirmDesactiv(String('.$rfcc.'))" class="table_item__link">Eliminar</a></td>';

            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
        $salida .= 'No se encontraron resultados';
    }
}



$salida .= "</tbody></table>";
echo '<script type="text/javascript">

function confirmDesactiv(dato)
{
    var cadena="../../controller/administrativo/Eliminar_Trabajadores.php?rfc="+dato;
   var flag = confirm("¿Está seguro de eliminar este trabajador?");
   if(flag){
        alert("Eliminado con éxito");
        window.location.assign(cadena);
        
   }else
        window.location.assign("Vista_Trabajadores.html");
}

</script>';


echo $salida;

?>
