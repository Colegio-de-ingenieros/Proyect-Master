<?php
$id=$_GET['id'];
include_once('../../model/administrativo/Mostrar_SocioAsociado.php');
$base = new MostrarSocioAsociado();
$base->instancias();
$id_arre = $base->getId($id);
$salida="";
$idSocio=$id_arre[0]["IdPerso"];
$cuotas = $base->cursos_disponibles($idSocio); 
    if (isset($_POST['consulta'])) {
        //echo($_POST['consulta']);
        $busqueda = $_POST['consulta'];

        $resultado = $base->cursos_buscar($busqueda,$idSocio);

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
                        <th>Nombre</th>
                        <th>Organización</th>
                        <th>Horas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($resultado); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idV = $resultado[$i]["IdCurPerso"];
                $nombre = $resultado[$i]["NomCurPerso"];
                $horas = $resultado[$i]["HraCurPerso"];
                $organizacion = $resultado[$i]["OrgCurPerso"];
                $estatus = $resultado[$i]["EstatusCurPerso"];
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
                $salida .= '<td>' . $nombre . '</td>';
                $salida .= '<td>' . $organizacion . '</td>';
                $salida .= '<td>' . $horas . '</td>';
                $salida .= '<td>' . $estatus . '</td>';
                $salida .= '<td> 
                <a href="../../controller/administrativo/Mostrar_Curso_Individual_SocioAsociado.php?id='.$idV.'">Más...</a>
                </td>';
                $salida .= '</tr>';
            }
        } else {
            $salida .= 'No se encontraron resultados';
        }

        $salida .= "</tbody></table></div>";

    } else {
        //manda a hacer la busqueda

        if ($cuotas == true) {
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
                        <th>Nombre</th>
                        <th>Organización</th>
                        <th>Horas</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($cuotas); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idV = $cuotas[$i]["IdCurPerso"];
                $nombre = $cuotas[$i]["NomCurPerso"];
                $horas = $cuotas[$i]["HraCurPerso"];
                $organizacion = $cuotas[$i]["OrgCurPerso"];
                $estatus = $cuotas[$i]["EstatusCurPerso"];
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
                $salida .= '<td>' . $nombre . '</td>';
                $salida .= '<td>' . $organizacion . '</td>';
                $salida .= '<td>' . $horas . '</td>';
                $salida .= '<td>' . $estatus . '</td>';
                $salida .= '<td> 
                <a href="../../controller/administrativo/Mostrar_Curso_Individual_SocioAsociado.php?id='.$idV.'">Más...</a>
                </td>';
                $salida .= '</tr>';
            }
        } else {
            $salida .= 'No se encontraron resultados';
        }

        $salida .= "</tbody></table></div>";

    }
    echo $salida;
?>