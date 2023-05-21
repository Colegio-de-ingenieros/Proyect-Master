<?php

require_once('../../model/socio-asociado/Reg_Cursos.php');
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    $objeto=new Cursos();
    $id_curso=$objeto->id_cursos();
    $id_perso=$objeto->usuario($usuario);
    $idperso=$id_perso[0]['IdPerso'];
    $id_final=$idperso;
    $nombre=$_POST["nombre"];
    $organizacion=$_POST["organizacion"];
    $horas=$_POST["totalhoras"];
    $archivo=$_FILES["archivo"]["name"];
    

    $new_name_file=null;

    if ($archivo!='' || $archivo!=null){
        $tipo = $_FILES['archivo']['type'];
        list($type, $extension)=explode('/', $tipo);
        if ($extension=='pdf'){
            $dir='../Comprobantes/socio-asociado/cursos/';
            if (!file_exists($dir)){
                mkdir($dir,0777, true);
            }
            $temp = $_FILES['archivo']['tmp_name'];
            $new_name_file=$dir. $id_curso;
            if (copy($temp, $new_name_file)){

            }
        }
        
    }

    $u=$objeto->insertar_cursos($id_curso, $nombre, $organizacion, $horas, $id_final);

    if ($u==true){
        echo json_encode('exito');
    }else{
        echo json_encode('no exito');
    }
}

?>