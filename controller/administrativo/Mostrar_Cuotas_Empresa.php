<?php
$id=$_GET['id'];
include_once('../../model/administrativo/Mostrar_Empresa.php');
$base = new MostrarEmpresa();
$base->instancias();
$rfc_Num = $base->getRFC($id);
$salida="";
$rfc=$rfc_Num[0]["RFCUsuaEmp"];
    $cuotas = $base->cuotas_disponibles($rfc); 

    if (isset($_POST['consulta'])) {
        //echo($_POST['consulta']);
        $busqueda = $_POST['consulta'];

        $resultado = $base->buscar($busqueda,$rfc);

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
                        <th>Tipo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalización</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($resultado); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idV = $resultado[$i]["IdVigCuo"];
                $monto = $resultado[$i]["MontoVigCuo"];
                $tipo = $resultado[$i]["TipoCuota"];
                $fecha_inicio = $resultado[$i]["IniVigCuo"];
                $fecha_fin = $resultado[$i]["FinVigCuo"];
                $estatus = $cuotas[$i]["EstatusVigCuo"];
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
                $salida .= '<td>' . $tipo . '</td>';
                $salida .= '<td>' . $fecha_inicio . '</td>';
                $salida .= '<td>' . $fecha_fin . '</td>';
                $salida .= '<td>' . $monto . '</td>';
                $salida .= '<td>' . $estatus . '</td>';
                $salida .= '<td> 
                <a href="../../controller/empresa/Get_Cuotas.php?idV='.$idV.'">Modificar</a>&nbsp;&nbsp;&nbsp
                <a href="#" class="table_item__link eliminar-elemento" data-idc="' . $idV . '">Eliminar</a>
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
                        <th>Tipo</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de finalización</th>
                        <th>Monto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

            //agrega los resultados de la busqueda
            for ($i = 0; $i < count($cuotas); $i++) {
                //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
                $idV = $cuotas[$i]["IdVigCuo"];
                $monto = $cuotas[$i]["MontoVigCuo"];
                $tipo = $cuotas[$i]["TipoCuota"];
                $fecha_inicio = $cuotas[$i]["IniVigCuo"];
                $fecha_fin = $cuotas[$i]["FinVigCuo"];
                $estatus = $cuotas[$i]["EstatusVigCuo"];
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
                $salida .= '<td>' . $tipo . '</td>';
                $salida .= '<td>' . $fecha_inicio . '</td>';
                $salida .= '<td>' . $fecha_fin . '</td>';
                $salida .= '<td>' . $monto . '</td>';
                $salida .= '<td>' . $estatus . '</td>';
                $salida .= '<td> 
                <a href="../../controller/administrativo/Mostrar_Cuota_Individual_Empresa.php?id='.$idV.'">Más...</a>
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
