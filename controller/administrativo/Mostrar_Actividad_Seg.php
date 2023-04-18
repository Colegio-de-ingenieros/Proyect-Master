<?php

require_once('../../model/administrativo/Mostrar_Actividad_Seg.php');
$objeto=new Actividad_Seguimiento();
$data =[];

$oculto=$_POST["valueHidden"];

if ($oculto==1){
    $tipo=$_POST["tipoAct"];
    $id=$_POST["idAct"];
    $data = $objeto->buscar_datos($tipo, $id);  
} else if ($oculto==2){
    $idParP=$_POST["gastos_participante"];
    $tipoGasto=$_POST["gastos_Tipo_Gasto"];
    $monto=floatval($_POST["gastos_monto"]);
    $fecha=$_POST["gastos_Fecha"];
    $doc=$_FILES["gastos_comprobante"]['name'];
    $temp = $_FILES['gastos_comprobante']['tmp_name'];
    $doc = file_get_contents($temp);

    $idGas=$objeto->id_gastos();

    //$idParP="";
    //$idParE="";
    
    $result = $objeto->insert_gastos($idGas, $monto, $fecha, $doc, $tipoGasto, $idParP);  
    if($result == true){
        $data=('Registro exitoso');
    }

    else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }
} else if ($oculto==3){
    $idParP=$_POST["ingresos_Participante"];
    $monto=floatval($_POST["ingresos_monto"]);
    $fecha=$_POST["ingresos_Fecha"];
    $doc=$_FILES["ingresos_comprobante"]['name'];
    $temp = $_FILES['ingresos_comprobante']['tmp_name'];
    $doc = file_get_contents($temp);

    $idIngre=$objeto->id_ingre();

    //$idParP="";
    //$idParE="";
    
    $result = $objeto->insert_ingresos($idIngre, $monto, $fecha, $doc, $idParP);  
    if($result == true){
        $data=('Registro exitoso');
    }

    else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }
}

echo json_encode($data)

?>