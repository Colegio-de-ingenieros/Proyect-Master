<?php

require_once('../../model/administrativo/Modificar_Gastos_Ingresos.php');
$objeto=new Gastos_Ingresos();

$data =[];

$idOperacion=$_POST["idOperacion"];
$aux=$_POST["aux"];

if ($aux=="gasto"){
    $tipoGasto=$_POST["gastos_Tipo_Gasto"];
    $monto=$_POST["gastos_monto"];
    $fecha=$_POST["gastos_Fecha"];

    $result = $objeto->modificar_gasto($idOperacion, $monto, $fecha);
    if($result == true){
        $result = $objeto->modificar_gasto_tipo($idOperacion, $tipoGasto);  
        if($result == true){
            if ($_FILES["gastos_comprobante"]['name'] ==""){
                $data=('Actualización exitosa');
            }else{
                $nuevoNombre=$idOperacion;
                $target_path = "../comprobantes/administrativo/gastos/";
                $parts = explode(".",$_FILES['gastos_comprobante']['name']);
                $target_path = $target_path . $nuevoNombre.".". end($parts);
                
                if(move_uploaded_file($_FILES['gastos_comprobante']['tmp_name'], $target_path)){
                    $data=('Actualización exitosa');
                }else{
                    $data=('Ha ocurrido un error al conectar con la base de datos');
                }
            }
        }else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }
} else{
    $monto=$_POST["ingresos_monto"];
    $fecha=$_POST["ingresos_Fecha"];
    
    $result = $objeto->modificar_ingreso($idOperacion, $monto, $fecha);
    if($result == true){
        if ($_FILES["ingresos_comprobante"]['name'] ==""){
            $data=('Actualización exitosa');
        }else{
            $nuevoNombre=$idOperacion;
            $target_path = "../comprobantes/administrativo/ingresos/";
            $parts = explode(".",$_FILES['ingresos_comprobante']['name']);
            $target_path = $target_path . $nuevoNombre.".". end($parts);
            
            if((move_uploaded_file($_FILES['ingresos_comprobante']['tmp_name'], $target_path)) and ($result == true)){
                $data=('Actualización exitosa');
            }else{
                $data=('Ha ocurrido un error al conectar con la base de datos');
            }
        }
    }
    else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }
}

echo json_encode($data);

?>