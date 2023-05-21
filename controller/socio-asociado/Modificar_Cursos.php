<?php

require_once('../../model/socio-asociado/Modificar_Cursos.php');
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $objeto=new modificarCursos();
    $id_perso=$objeto->usuario($usuario);
    $idperso=$id_perso[0]['IdPerso'];
    $id_final=$idperso;
    $id=$_POST["idc"];
    $nombre=$_POST["nombre"];
    $organizacion=$_POST["organizacion"];
    $horas=$_POST["totalhoras"];
    $archivo=$_FILES["archivo1"]["name"];
    

    $new_name_file=null;

    if ($archivo!='' || $archivo!=null){
        $tipo = $_FILES['archivo1']['type'];
        list($type, $extension)=explode('/', $tipo);
        if ($extension=='pdf'){
            $dir='../Comprobantes/socio-asociado/cursos/';
            if (!file_exists($dir)){
                mkdir($dir,0777, true);
            }
            $temp = $_FILES['archivo1']['tmp_name'];
            $new_name_file=$dir. $id;
            if (copy($temp, $new_name_file)){

            }
        }
        
    }

    $u=$objeto->actualizar($id, $nombre, $horas, $organizacion);

    if ($u==true){
        echo json_encode('exito');
    }
}

?>