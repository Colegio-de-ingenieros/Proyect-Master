<?php
include_once('../../model/socio-asociado/Mostrar_Solicitudes.php');
$salida = '';
$base = new MostrarSolicitud();
$base->instancias();

$id=000000;
session_start();
$username = $_SESSION['usuario'];
$idPersona=$base->getId($username);
$id=$idPersona[0][0];

$cv=$base->getCv($id);
if ($cv==false){
    $salida .= 'No hay un CV registrado, por favor regístrelo.';
}
else{
    $cvPersona=$cv[0][1];

if (isset($_POST['consulta'])) {
    $busqueda = $_POST['consulta'];
    $resultado = $base->busquedaSolicitud($busqueda,$cvPersona);
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
                                <th>Empresa</th>
                                <th>Vacante</th>
                                <th>Descripción del puesto</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $empresa = $resultado[$i]["NomUsuaEmp"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $desc=$resultado[$i]["DesEmpBol"];
            //escribe los valores en la tabla
            $sid="s".$id;
            $salida .= '<tr>';
            $salida .= '<td>' . $empresa . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';         
            $salida .= '<td><a href="../../controller/socio-asociado/Mostrar_Oferta_Individual.php?id='.$id.'" >Ver oferta</a></td>';
            
            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
        $salida .= 'No se encontraron resultados';
    }
} else {
    $resultado = $base->mostrarSolicitud($cvPersona);
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
                                <th>Empresa</th>
                                <th>Vacante</th>
                                <th>Descripción del puesto</th>
                                <th>Acciones</th>
                                
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $empresa = $resultado[$i]["NomUsuaEmp"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $desc=$resultado[$i]["DesEmpBol"];
            //escribe los valores en la tabla
            $sid="s".$id;
            $salida .= '<tr>';
            $salida .= '<td>' . $empresa . '</td>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';         
            $salida .= '<td><a href="../../controller/socio-asociado/Mostrar_Oferta_Individual.php?id='.$id.'" >Ver oferta</a></td>';
            
            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
        $salida .= 'No se encontraron resultados';
    }
}}
//manda a hacer la busqueda


$salida .= "</tbody></table>";

echo $salida;

?>
