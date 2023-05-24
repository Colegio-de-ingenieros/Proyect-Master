<?php
include_once('../../model/administrativo/Reporte_General.php');

class Reporte{

    function buscar(){
        $tipo = $_GET["tipo"];
        $fechaI = $_GET["fi"];
        $fechaF = $_GET["ff"];
        $base = new ReporteGral();
        $base->conexion();
        $datos = [];

        $tabla = '';

        if ($tipo == 'cursos'){
            $tabla = 'segcursos';
        }

        else if($tipo == 'proyectos'){
            $tabla = 'segproyectos';
        }

        else{
            $tabla = 'segcertint';
        }

        $seguimientos = $base->get($tabla);
        $fechaMax = '0000-00-00';
        $fechaMin = '9999-99-99';

        for ($i = 0; $i < count($seguimientos); $i++) {
            //           nom, h, t, c, o, h, s, i
            $datos_seg = ['', 0, 0, 0, 0, 0, 0, 0];
            $ids = $seguimientos[$i]["IdSeg"];
            $hotel = 0;
            $transporte = 0;
            $comida = 0;
            $oficina = 0;
            $honorarios = 0;
            $nombre = $base->getNombres($ids, $tipo);

            //consultas de historial completo
            if($fechaI == '-' and $fechaF == '-'){
                $gastosIns = $base->getGastosIns($ids);
                $gastosEmp = $base->getGastosEmp($ids);
                $gastosPer = $base->getGastosPerso($ids);
                $ingreInst = $base->getIngresosPerso($ids);
                $ingreEmp = $base->getIngresosEmpresa($ids);
                $ingrePerso = $base->getIngresosInst($ids);
            }

            else{
                $gastosIns = $base->getGastosIns($ids, $fechaI, $fechaF);
                $gastosEmp = $base->getGastosEmp($ids, $fechaI, $fechaF);
                $gastosPer = $base->getGastosPerso($ids, $fechaI, $fechaF);
                $ingreInst = $base->getIngresosPerso($ids, $fechaI, $fechaF);
                $ingreEmp = $base->getIngresosEmpresa($ids, $fechaI, $fechaF);
                $ingrePerso = $base->getIngresosPerso($ids, $fechaI, $fechaF);
            }
            

            //suma los gastos de los instructores
            for ($j = 0; $j < count($gastosIns); $j++) {
                if ($gastosIns[$j]["TipoGas"] == 'Hotel') {
                    $hotel = $hotel + $gastosIns[$j]["MontoGas"];
                } 
                
                else if ($gastosIns[$j]["TipoGas"] == 'Transporte') {
                    $transporte = $transporte + $gastosIns[$j]["MontoGas"];
                } 
                
                else if ($gastosIns[$j]["TipoGas"] == 'Comida') {
                    $comida = $comida + $gastosIns[$j]["MontoGas"];
                } 
                
                else if ($gastosIns[$j]["TipoGas"] == 'Oficina') {
                    $oficina = $oficina + $gastosIns[$j]["MontoGas"];
                } 
                
                else if ($gastosIns[$j]["TipoGas"] == 'Honorario') {
                    $honorarios = $honorarios + $gastosIns[$j]["MontoGas"];
                }

                //compara la fehca del gasto
                if($gastosIns[$j]["FechaGas"] <= $fechaMin){
                    $fechaMin = $gastosIns[$j]["FechaGas"];
                }

                if ($gastosIns[$j]["FechaGas"] >= $fechaMax) {
                    $fechaMax = $gastosIns[$j]["FechaGas"];
                }

            }

            //suma los gastos de las empresas
            for ($j = 0; $j < count($gastosEmp); $j++) {
                if ($gastosEmp[$j]["TipoGas"] == 'Hotel') {
                    $hotel = $hotel + $gastosEmp[$j]["MontoGas"];
                } 
                
                else if ($gastosEmp[$j]["TipoGas"] == 'Transporte') {
                    $transporte = $transporte + $gastosEmp[$j]["MontoGas"];
                } 
                
                else if ($gastosEmp[$j]["TipoGas"] == 'Comida') {
                    $comida = $comida + $gastosEmp[$j]["MontoGas"];
                } 
                
                else if ($gastosEmp[$j]["TipoGas"] == 'Oficina') {
                    $oficina = $oficina + $gastosEmp[$j]["MontoGas"];
                } 
                
                else if ($gastosEmp[$j]["TipoGas"] == 'Honorario') {
                    $honorarios = $honorarios + $gastosEmp[$j]["MontoGas"];
                }

                //compara la fehca del gasto
                if ($gastosEmp[$j]["FechaGas"] <= $fechaMin) {
                    $fechaMin = $gastosEmp[$j]["FechaGas"];
                }

                if ($gastosEmp[$j]["FechaGas"] >= $fechaMax) {
                    $fechaMax = $gastosEmp[$j]["FechaGas"];
                }
            }

            //suma los gastos de los asociados
            for ($j = 0; $j < count($gastosPer); $j++) {
                if ($gastosPer[$j]["TipoGas"] == 'Hotel') {
                    $hotel = $hotel + $gastosPer[$j]["MontoGas"];
                } 
                
                else if ($gastosPer[$j]["TipoGas"] == 'Transporte') {
                    $transporte = $transporte + $gastosPer[$j]["MontoGas"];
                } 
                
                else if ($gastosPer[$j]["TipoGas"] == 'Comida') {
                    $comida = $comida + $gastosPer[$j]["MontoGas"];
                } 
                
                else if ($gastosPer[$j]["TipoGas"] == 'Oficina') {
                    $oficina = $oficina + $gastosPer[$j]["MontoGas"];
                } 
                
                else if ($gastosPer[$j]["TipoGas"] == 'Honorario') {
                    $honorarios = $honorarios + $gastosPer[$j]["MontoGas"];
                }

                //compara la fehca del gasto
                if ($gastosPer[$j]["FechaGas"] <= $fechaMin) {
                    $fechaMin = $gastosPer[$j]["FechaGas"];
                }

                if ($gastosPer[$j]["FechaGas"] >= $fechaMax) {
                    $fechaMax = $gastosPer[$j]["FechaGas"];
                }
            }

            //suma todos los gastos
            $subtotal = $hotel + $transporte + $comida + $oficina + $honorarios;
            //suma los ingresos de los instructores
            $ingreTotal = $ingreEmp[0]["total"] + $ingreInst[0]["total"] + $ingrePerso[0]["total"];

            $datos_seg[0] = $ids . ' - ' . $nombre[0]["nombre"];
            $datos_seg[1] = $hotel;
            $datos_seg[2] = $transporte;
            $datos_seg[3] = $comida;
            $datos_seg[4] = $oficina;
            $datos_seg[5] = $honorarios;
            $datos_seg[6] = $subtotal;
            $datos_seg[7] = $ingreTotal;

            array_push($datos, $datos_seg);

            $fechas = $base->getFechas($tabla);
            //echo $fechas[0]["maximo"] . '<br>';
            
        }

        /*echo $fechas[0][0]["maximo"];
        echo $fechas[1][0]["maximo"];*/

        //echo count($fechas);
        for($i=0; $i<count($fechas); $i++){
            if($fechas[$i][0]["maximo"] >= $fechaMax and $fechas[$i][0]["maximo"] != null){
                $fechaMax = $fechas[$i][0]["maximo"];
                //echo $fechaMax;
            }

            if ($fechas[$i][0]["minimo"] <= $fechaMin and $fechas[$i][0]["minimo"] != null) {
                $fechaMin = $fechas[$i][0]["minimo"];
                //echo $fechaMin;
            }
            //echo $fechaMin . '<br>';
        }

        array_push($datos, $fechaMin);
        array_push($datos, $fechaMax);
    
        //echo '<script>alert("' . $datos[0][0] . '")</script>';
        //echo json_encode("hola");
        echo json_encode($datos);

        /*for($fila=0; $fila<count($datos); $fila++){
            for($col=0; $col<7; $col++){
                echo $datos[$fila][$col] . '  ';
            }

            echo '<br>';
        }*/
    }
}

$obj = new Reporte();
$obj->buscar();

?>