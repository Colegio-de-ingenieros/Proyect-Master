<?php
include_once('../../model/administrativo/Mostrar_Ofertas.php');
$salida = '';
$base = new MostrarOfertas();
$base->instancias();


$rfce=" ";
//echo $rfce;
if (isset($_POST['consulta'])) {
    $busqueda = $_POST['consulta'];
    $resultado = $base->buscadorOfertas($busqueda);
    
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
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($resultado); $i++) {

            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $empresa=$resultado[$i]["NomUsuaEmp"];
            $estatus= $resultado[$i]["EstatusEmpBol"];
            if ($estatus==1) {
            $estatus="Aprobado";
            }
            else if ($estatus==2){
            $estatus="Rechazado";
            }
            else{
            $estatus="En espera";
            }
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $empresa . '</td>';
            $salida .= '<td>' . $nombre . '</td>';         
            $salida .= '<td>' .$estatus. '</td>';
            $salida .= '<td><a href="../../controller/administrativo/Mostrar_Oferta.php?id='.$id.'" >Más...</a>&nbsp;&nbsp;&nbsp;<a href="../../view/administrativo/Vista_Cvadmin.html?id='.$id.'" >Aplicantes</a></td>';
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
                                <th>Empresa</th>
                                <th>Vacante</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                <tbody>';

        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {

            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $empresa=$resultado[$i]["NomUsuaEmp"];
            $estatus= $resultado[$i]["EstatusEmpBol"];
            if ($estatus==1) {
            $estatus="Aprobado";
            }
            else if ($estatus==2){
            $estatus="Rechazado";
            }
            else{
            $estatus="En espera";
            }
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $empresa . '</td>';
            $salida .= '<td>' . $nombre . '</td>';           
            $salida .= '<td>' .$estatus. '</td>';
            $salida .= '<td><a href="../../controller/administrativo/Mostrar_Oferta.php?id='.$id.'" >Más...</a>&nbsp;&nbsp;&nbsp;<a href="../../view/administrativo/Vista_Cvadmin.html?id='.$id.'" >Aplicantes</a></td>';
            $salida .= '</tr></div>';
    
            
        }
    } 
    
    else {
        //echo "si entra al else";
        $salida .= 'No se encontraron resultados';
    }
}
//manda a hacer la busqueda


$salida .= "</tbody></table>";
echo '<script type="text/javascript">

function confirmDesactiv(dato)
{
   var cadena="../../controller/empresa/Eliminar_Oferta.php?id="+dato;
   //console.log(cadena);
   var flag = confirm("¿Estás seguro de eliminar la oferta?");
   if(flag)
   {
        alert("Eliminada con éxito");
        window.location.assign(cadena);
   }
    else
        window.location.assign("Vista_Ofertas.html");
}

</script>';


echo $salida;

?>