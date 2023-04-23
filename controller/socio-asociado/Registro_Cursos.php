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

    $u=$objeto->insertar_cursos($id_curso, $nombre, $organizacion, $horas, $archivo, $id_final);

    if ($u==true){
        echo json_encode('exito');
    }else{
        echo json_encode('no exito');
    }
}

?>