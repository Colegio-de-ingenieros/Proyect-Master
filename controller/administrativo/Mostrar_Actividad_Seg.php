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
    $parP=isset($_POST["participante_Socio_Aso"]);
    $parE=isset($_POST["participante_Empresas"]);
    $parI=isset($_POST["participante_Instructores"]);

    $idSeg=$_POST["idAct"];

    if ($parP != "") {
        $parP=$_POST["participante_Socio_Aso"];
        
        $idP=$objeto->id_parP();

        $result = $objeto->insert_socios($idSeg, $parP, $idP);
    }
    if($parE != "") {
        $parE=$_POST["participante_Empresas"];

        $idE=$objeto->id_parE();

        $result = $objeto->insert_empresas($idSeg, $parE, $idE);
    }
    if ($parI != ""){    
        $parI=$_POST["participante_Instructores"];

        $idI=$objeto->id_parI();

        $result = $objeto->insert_instructores($idI,$idSeg, $parI);
    }
    
    if($result == true){
        $data=('Participante añadido exitosamente');
    }
    else{
        $data=('Ha ocurrido un error al conectar con la base de datos');
    }
} else if ($oculto==3){
    $idPar=$_POST["gastos_participante"];
    $tipoGasto=$_POST["gastos_Tipo_Gasto"];
    $monto=floatval($_POST["gastos_monto"]);
    $fecha=$_POST["gastos_Fecha"];

    $doc=$_FILES["gastos_comprobante"]['name'];
    $temp = $_FILES['gastos_comprobante']['tmp_name'];
    $doc = file_get_contents($temp);
    if ($_FILES['gastos_comprobante']['type'] != 'application/pdf'){
        $data = "Solo se admiten documentos PDF";
    } else if ($_FILES['gastos_comprobante']['size'] > 1000000){
        $data = "El tamaño del documentos debe ser menor a 1 MB";
    } else{
        $idGas=$objeto->id_gastos();
        

        if (strpos($idPar, 'P') !== false) {
            $result = $objeto->insert_gastos_perso($idGas, $monto, $fecha, $doc, $tipoGasto, $idPar);  
        } else if(strpos($idPar, 'E') !== false) {
            $result = $objeto->insert_gastos_empresa($idGas, $monto, $fecha, $doc, $tipoGasto, $idPar);
        } else {    
            $result = $objeto->insert_gastos_instr($idGas, $monto, $fecha, $doc, $tipoGasto, $idPar);
        }
        
        if($result == true){
            $nuevoNombre=$idGas;
            $target_path = "../comprobantes/administrativo/gastos/";
            $parts = explode(".",$_FILES['gastos_comprobante']['name']);
            $target_path = $target_path . $nuevoNombre.".". end($parts);
            move_uploaded_file($_FILES['gastos_comprobante']['tmp_name'], $target_path);
            
            $data=('Gasto registrado exitosamente');
        }
        else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }

} else if ($oculto==4){
    $idPar=$_POST["ingresos_Participante"];
    $monto=floatval($_POST["ingresos_monto"]);
    $fecha=$_POST["ingresos_Fecha"];
    
    $doc=$_FILES["ingresos_comprobante"]['name'];
    $temp = $_FILES['ingresos_comprobante']['tmp_name'];
    $doc = file_get_contents($temp);
    if ($_FILES['ingresos_comprobante']['type'] != 'application/pdf'){
        $data = "Solo se admiten documentos PDF";
    } else if ($_FILES['ingresos_comprobante']['size'] > 1000000){
        $data = "El tamaño del documentos debe ser menor a 1 MB";
    } else{

        $idIngre=$objeto->id_ingre();

        if (strpos($idPar, 'P') !== false) {
            $result = $objeto->insert_ingresos_perso($idIngre, $monto, $fecha, $doc, $idPar);  
        } else if(strpos($idPar, 'E') !== false) {
            $result = $objeto->insert_ingresos_empresa($idIngre, $monto, $fecha, $doc, $idPar);
        } else {    
            $result = $objeto->insert_ingresos_instr($idIngre, $monto, $fecha, $doc, $idPar);
        }

        if($result == true){
            $nuevoNombre=$idIngre;
            $target_path = "../comprobantes/administrativo/ingresos/";
            $parts = explode(".",$_FILES['ingresos_comprobante']['name']);
            $target_path = $target_path . $nuevoNombre.".". end($parts);
            move_uploaded_file($_FILES['ingresos_comprobante']['tmp_name'], $target_path);

            $data=('Ingreso registrado exitosamente');
        }
        else{
            $data=('Ha ocurrido un error al conectar con la base de datos');
        }
    }
}

echo json_encode($data);

?>