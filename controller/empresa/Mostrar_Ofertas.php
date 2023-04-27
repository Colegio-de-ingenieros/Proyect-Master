<?php
include_once('../../model/empresa/Mostrar_Ofertas.php');
$salida = '';
$base = new MostrarOfertas();
$base->instancias();

$id=000000;
session_start();
$username = $_SESSION['usuario'];
$rfccorreo1=$obj->rfccorreo($username);

$rfce=$rfccorreo1[0][0];
//echo $rfce;
if (isset($_POST['consulta'])) {
    $busqueda = $_POST['consulta'];
    $resultado = $base->buscador($busqueda,$rfce);
    
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
                        <thead>
                            <tr>
                                <th>Vacante</th>
                                <th>Descripción del puesto</th>
                                <th>Modalidad</th>
                                <th>Experiencia requerida</th>                
                                <th>Número de aplicantes</th>
                                <th>Acciones     </th>
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $desc=$resultado[$i]["DesEmpBol"];
            $req = $resultado[$i]["ReqAcaEmpBol"];
            $exp = $resultado[$i]["AñoEmpBol"];
            $tel = $resultado[$i]["TipoMod"];
            //$extension = getExt($logo);
            $aplicantes=$base->contar($id);
            $aplica=$aplicantes[0]["total"];
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';
            $salida .= '<td>' . $tel . '</td>';
            $salida .= '<td>' . $exp . '</td>';            
            $salida .= '<td>' .$aplica. '</td>';
            $salida .= '<td><a href="../../view/empresa/Vista_Aplicantes.php?id='.$id.'" >Aplicantes</a>&nbsp;&nbsp;&nbsp;<a href="../../controller/empresa/Mostrar_Oferta.php?id='.$id.'" >Más...</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="confirmDesactiv(String('.$id.'))" class="table_item__link">Eliminar</a></td>';
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
    $resultado = $base->getOfertas($rfce);
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
                                <th>Vacante</th>
                                <th>Descripción del puesto</th>
                                <th>Modalidad</th>
                                <th>Experiencia requerida</th>                
                                <th>Número de aplicantes</th>
                                <th>Acciones     </th>
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $id = $resultado[$i]["IdEmpBol"];
            $nombre = $resultado[$i]["VacEmpBol"];
            $desc=$resultado[$i]["DesEmpBol"];
            $req = $resultado[$i]["ReqAcaEmpBol"];
            $exp = $resultado[$i]["AñoEmpBol"];
            $tel = $resultado[$i]["TipoMod"];
            //$extension = getExt($logo);
            $aplicantes=$base->contar($id);
            $aplica=$aplicantes[0]["total"];
            //escribe los valores en la tabla
            $sid="s".$id;
            $salida .= '<tr>';
            $salida .= '<td>' . $nombre . '</td>';
            $salida .= '<td>' . $desc . '</td>';
            $salida .= '<td>' . $tel . '</td>';
            $salida .= '<td>' . $exp . '</td>';            
            $salida .= '<td>' .$aplica. '</td>';
            
            
            $salida .= '<td><a href="../../view/empresa/Vista_Aplicantes.php?id='.$id.'" >Aplicantes</a>&nbsp;&nbsp;&nbsp;<a href="../../controller/empresa/Mostrar_Oferta.php?id='.$id.'" >Más...</a>&nbsp;&nbsp;&nbsp;<a href="#" onclick="confirmDesactiv(String('.$id.'))" class="table_item__link">Eliminar</a></td>';
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
//echo '<script>alert("si entra al php");</script>';

echo $salida;
//echo '<script src="../../controller/administrativo/js/Eliminar_Trabajadores_Confirmacion.js"></script>';
?>