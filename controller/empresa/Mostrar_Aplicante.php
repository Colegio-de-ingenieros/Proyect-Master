<?php
include_once('../../model/empresa/Mostrar_Aplicantes.php');
$salida = '';
$base = new MostrarAplicantes();
$base->instancias();
$url= $_GET['id'];
$id=0;

if (isset($_POST['consulta'])) {
    $busqueda = $_POST['consulta'];

    $resultado = $base->buscadorAplicante($busqueda,$url);
    
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Salario esperado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $nom = $resultado[$i]["NomPerso"].' '.$resultado[$i]["ApePPerso"].' '.$resultado[$i]["ApeMPerso"];
            $carrera= $resultado[$i]["DesProCv"];
            $cedula= $resultado[$i]["CorreoPerso"];
            $sal= $resultado[$i]["ExpSalCv"];
            $tel = $resultado[$i]["TelMPerso"];
            $id = $resultado[$i]["IdBolCv"];
            //$extension = getExt($logo);
    
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nom . '</td>';
            $salida .= '<td>' . $carrera . '</td>';
            $salida .= '<td>' . $cedula . '</td>';
            $salida .= '<td>' . $tel . '</td>';
            $salida .= '<td>' . $sal . '</td>';
            $salida .= '<td> <a href="../../controller/empresa/Mostrar_Cv.php?id='.$id.'" >Ver más</a></td>';
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
    $resultado = $base->getAplicantes($url);
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Salario esperado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                <tbody>';
    
        //agrega los resultados de la busqueda
        for ($i = 0; $i < count($resultado); $i++) {
    
            //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
            $nom = $resultado[$i]["NomPerso"].' '.$resultado[$i]["ApePPerso"].' '.$resultado[$i]["ApeMPerso"];
            $carrera= $resultado[$i]["DesProCv"];
            $cedula= $resultado[$i]["CorreoPerso"];
            $sal= $resultado[$i]["ExpSalCv"];
            $tel = $resultado[$i]["TelMPerso"];
            $id = $resultado[$i]["IdBolCv"];
            //$extension = getExt($logo);
    
            //escribe los valores en la tabla
            $salida .= '<tr>';
            $salida .= '<td>' . $nom . '</td>';
            $salida .= '<td>' . $carrera . '</td>';
            $salida .= '<td>' . $cedula . '</td>';
            $salida .= '<td>' . $tel . '</td>';
            $salida .= '<td>' . $sal . '</td>';
            $salida .= '<td> <a href="../../controller/empresa/Mostrar_Cv.php?id='.$id.'" >Ver más</a></td>';
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
   var flag = confirm("¿Estás seguro de eliminar este oferta?");
   if(flag)
        window.location.assign("../../controller/empresa/Eliminar_Oferta.php?id='.$id.'");
    else
        window.location.assign("Vista_Ofertas.html");
}

</script>';


echo $salida;

?>