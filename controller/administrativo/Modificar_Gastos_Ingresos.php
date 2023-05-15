<?php

require_once('../../model/administrativo/Modificar_Gastos_Ingresos.php');
$objeto=new Gastos_Ingresos();

$data =[];

$idOperacion=$_POST["idOperacion"];
$aux=$_POST["aux"];

if ($aux=="gasto"){
    $tipoGasto=$_POST["gastos_Tipo_Gasto"];
    $monto=floatval($_POST["gastos_monto"]);
    $fecha=$_POST["gastos_Fecha"];

    $result = $objeto->modificar_gasto($idOperacion, $monto, $fecha);
    if($result == true){
        $result = $objeto->modificar_gasto_tipo($idOperacion, $tipoGasto);  
        if($result == true){
            if ($_FILES["gastos_comprobante"]['name'] !=""){
                $doc=$_FILES["gastos_comprobante"]['name'];
                $temp = $_FILES['gastos_comprobante']['tmp_name'];
                $doc = file_get_contents($temp);
        
                if ($_FILES['gastos_comprobante']['type'] != 'application/pdf'){
                    $data = "Solo se admiten documentos PDF";
                } else if ($_FILES['gastos_comprobante']['size'] > 1000000){
                    $data = "El tamaño del documentos debe ser menor a 1 MB";
                } else{
                    $result = $objeto->modificar_gasto_doc($idOperacion, $doc);
                    if($result == true){
                        $data=('Actualización exitosa');
                    } else{
                        $data=('Ha ocurrido un error al conectar con la base de datos');
                    }
                }
            }else{
                $data=('Actualización exitosa');
            }
        }
        else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }
    else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }

} else{
    $monto=floatval($_POST["ingresos_monto"]);
    $fecha=$_POST["ingresos_Fecha"];

    $result = $objeto->modificar_ingreso($idOperacion, $monto, $fecha);
    if($result == true){
        if ($_FILES["ingresos_comprobante"]['name'] !=""){
            $doc=$_FILES["ingresos_comprobante"]['name'];
            $temp = $_FILES['ingresos_comprobante']['tmp_name'];
            $doc = file_get_contents($temp);
    
            if ($_FILES['ingresos_comprobante']['type'] != 'application/pdf'){
                $data = "Solo se admiten documentos PDF";
            } else if ($_FILES['ingresos_comprobante']['size'] > 1000000){
                $data = "El tamaño del documentos debe ser menor a 1 MB";
            } else{
                $result = $objeto->modificar_ingreso_doc($idOperacion, $doc);
                if($result == true){
                    $data=('Actualización exitosa');
                } else{
                    $data=('Ha ocurrido un error al conectar con la base de datos');
                }
            }
        }else{
            $data=('Actualización exitosa');
        }
    }
    else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }
}

echo json_encode($data);

?>