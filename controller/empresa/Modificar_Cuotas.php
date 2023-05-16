<?php

require_once('../../model/empresa/Modificar_Cuotas_empresa.php');
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $objeto=new modificarCuotas();
    $id=$_POST["idV"];
    $tipo=$_POST["tipo"];
    $monto=$_POST["monto"];
    $inicio=$_POST["fechainicio"];
    $fin=$_POST["fechafin"];
    $archivo=$_FILES["archivo"]["name"];
    

    $new_name_file=null;

    if ($archivo!='' || $archivo!=null){
        $tipo = $_FILES['archivo']['type'];
        list($type, $extension)=explode('/', $tipo);
        if ($extension=='pdf'){
            $dir='../Comprobantes/';
            if (!file_exists($dir)){
                mkdir($dir,0777, true);
            }
            $temp = $_FILES['archivo']['tmp_name'];
            $new_name_file=$dir. $archivo;
            if (copy($temp, $new_name_file)){

            }
        }
        
    }

    $u=$objeto->actualizar($id, $tipo, $monto, $inicio, $fin, $archivo);

    if ($u==true){
        echo json_encode('exito');
    }else{
        echo json_encode('no exito');
    }
}

?>