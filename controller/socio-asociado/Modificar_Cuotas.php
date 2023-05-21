<?php

require_once('../../model/socio-asociado/Modificar_Cuotas.php');
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $objeto=new modificarCuotas();
    $id_perso=$objeto->usuario($usuario);
    $idperso=$id_perso[0]['IdPerso'];
    $id_final=$idperso;


    $id_c=$objeto->id_cuotas($id_final);
    $idcuo=$id_c[0]['IdVigCuo'];
    $id_final_cup=$idcuo;


    $id=$_POST["idV"];
    $tipo1=$_POST["tipo"];
    $monto=$_POST["monto"];
    $inicio=$_POST["fechainicio"];
    $fin=$_POST["fechafin"];
    $archivo=$_FILES["archivo1"]["name"];

    if ($fin> $inicio){

        if ($tipo1== 1){
            $tipo1="1";
        }
        else if ($tipo1 == 2){
            $tipo1= "2";
        }
        else if ($tipo1 == 3){
            $tipo1= "3";
        }

        $new_name_file=null;

        if ($archivo!='' || $archivo!=null){
            $tipo = $_FILES['archivo1']['type'];
            list($type, $extension)=explode('/', $tipo);
            if ($extension=='pdf'){
                $dir='../Comprobantes/socio-asociado/cuotas/';
                if (!file_exists($dir)){
                    mkdir($dir,0777, true);
                }
                $temp = $_FILES['archivo1']['tmp_name'];
                $new_name_file=$dir. $id;
                if (copy($temp, $new_name_file)){
    
                }
            }
        }
        

        $u=$objeto->actualizar($id, $monto, $inicio, $fin, $tipo1);

        if ($u==true){
            echo json_encode('exito');
        }
    }else{
        echo json_encode('fechas');
    }
}

?>