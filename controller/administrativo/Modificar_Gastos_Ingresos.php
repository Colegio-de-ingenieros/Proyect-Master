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

    if ($_FILES["gastos_comprobante"]['name'] !=""){
        $doc=$_FILES["gastos_comprobante"]['name'];
        $temp = $_FILES['gastos_comprobante']['tmp_name'];
        $doc = file_get_contents($temp);

        if ($_FILES['gastos_comprobante']['type'] != 'application/pdf'){
            $data = "Solo se admiten documentos PDF";
        } else if ($_FILES['gastos_comprobante']['size'] > 3000000){
            $data = "El tamaño del documentos debe ser menor a 3 MB";
        } else{

            $result = $objeto->modificar_gasto($idOperacion, $monto, $fecha);
            if($result == true){
                $result = $objeto->modificar_gasto_tipo($idOperacion, $tipoGasto);  
                if($result == true){
                    $nuevoNombre=$idOperacion;
                    $target_path = "../comprobantes/administrativo/gastos/";
                    $parts = explode(".",$_FILES['gastos_comprobante']['name']);
                    $target_path = $target_path . $nuevoNombre.".". end($parts);
                    
                    if(move_uploaded_file($_FILES['gastos_comprobante']['tmp_name'], $target_path)){
                        $data=('Actualización exitosa');
                    }else{
                        $data=('Ha ocurrido un error al conectar con la base de datos');
                    }
                    #$result = $objeto->modificar_gasto_doc($idOperacion, $doc);
                } else{
                    $data=('Ha ocurrido un error al conectar con la base de datos');
                }
            } else{
                $data=('Ha ocurrido un error al conectar con la base de datos');
            }
        }
    }else{
        $result = $objeto->modificar_gasto($idOperacion, $monto, $fecha);
        if($result == true){
            $result = $objeto->modificar_gasto_tipo($idOperacion, $tipoGasto);  
            if($result == true){
                $data=('Actualización exitosa');
            }else{
                $data=('Ha ocurrido un error al conectar con la base de datos');
            }
        }else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }

} else{
    $monto=$_POST["ingresos_monto"];
    $fecha=$_POST["ingresos_Fecha"];

    if ($_FILES["ingresos_comprobante"]['name'] !=""){
        $doc=$_FILES["ingresos_comprobante"]['name'];
        $temp = $_FILES['ingresos_comprobante']['tmp_name'];
        $doc = file_get_contents($temp);

        if ($_FILES['ingresos_comprobante']['type'] != 'application/pdf'){
            $data = "Solo se admiten documentos PDF";
        } else if ($_FILES['ingresos_comprobante']['size'] > 3000000){
            $data = "El tamaño del documentos debe ser menor a 3 MB";
        } else{

            $result = $objeto->modificar_ingreso($idOperacion, $monto, $fecha);

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
    }else{
        $result = $objeto->modificar_ingreso($idOperacion, $monto, $fecha);
        if($result == true){
            $data=('Actualización exitosa');
        }
        else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }
}

echo json_encode($data);

?>