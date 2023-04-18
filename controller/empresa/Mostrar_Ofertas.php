<?php
include_once('../../model/empresa/Mostrar_Ofertas.php');
$salida = '';
$base = new MostrarOfertas();
$base->instancias();

$id=0;
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
                                <th>Nombre vacante</th>
                                <th>Requisitos académicos</th>
                                <th>Experiencia requerida</th>
                                <th>Contacto</th>
                                <th>Numero de Aplicantes</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $req = $resultado[$i]["ReqAcaEmpBol"];
            $exp = $resultado[$i]["AñoEmpBol"];
            $tel = $resultado[$i]["TelEmpBol"];
            //$extension = getExt($logo);
    
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $req . '</td>';
            $salida .= '<td>' . $exp . '</td>';
            $salida .= '<td>' . $tel . '</td>';
            $salida .= '<td>' .'0' . '<a href="../../controller/empresa/Mostrar_Oferta.php?id='.$id.'" >Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
            $salida .= '<td><a href="../../controller/administrativo/Get_Trabajadores.php?rfc='.$id.'" >Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../../controller/empresa/Mostrar_Oferta.php?id='.$id.'" >Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
    $resultado = $base->getOfertas();
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
                                <th>Nombre vacante</th>
                                <th>Requisitos académicos</th>
                                <th>Experiencia requerida</th>
                                <th>Contacto</th>
                                <th>Numero de Aplicantes</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $req = $resultado[$i]["ReqAcaEmpBol"];
            $exp = $resultado[$i]["AñoEmpBol"];
            $tel = $resultado[$i]["TelEmpBol"];
            //$extension = getExt($logo);
    
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $req . '</td>';
            $salida .= '<td>' . $exp . '</td>';
            $salida .= '<td>' . $tel . '</td>';
            $salida .= '<td>' .'0' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../../controller/empresa/Mostrar_Oferta.php?id='.$id.'" >Ver Aplicantes</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
            $salida .= '<td><a href="../../controller/administrativo/Get_Trabajadores.php?rfc='.$id.'" >Modificar</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="../../controller/empresa/Mostrar_Oferta.php?id='.$id.'" >Ver más</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
}
//manda a hacer la busqueda
//$resultado = $base->getTrabajadores();
//echo '<script>alert("si entra al php");</script>';
//echo "si entra al php";


$salida .= "</tbody></table>";
echo '<script type="text/javascript">

function confirmDesactiv()
{
   var flag = confirm("¿Estás seguro de eliminar la oferta?");
   if(flag)
        window.location.assign("../../controller/empresa/Eliminar_Oferta.php?id='.$id.'");
    else
        window.location.assign("Vista_Ofertas.html");
}

</script>';
//echo '<script>alert("si entra al php");</script>';

echo $salida;
//echo '<script src="../../controller/administrativo/js/Eliminar_Trabajadores_Confirmacion.js"></script>';
?>