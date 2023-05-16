<?php
    require_once("../../model/socio-asociado/Bolsa_Trabajo2.php");
    session_start();
    if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];

        $objeto = new dato();
        $objeto->BD();
        $datos_personales = $objeto->usuario($tipo_usuario,$usuario);

        $id = $datos_personales[0]['IdPerso'];

        $bolsa = $objeto->bolsacv($id);
        $xp_academica = $objeto->experiencia_academica($id);
        $xp_profesional = $objeto->experiencia_profesional($id);
        $datos_de_certificaciones = $objeto->certificaciones($id);
        
        $datos_de_lugar = $objeto->lugar($id);

        $datos = array_merge($datos_personales,$datos_de_lugar);

        if ($datos_de_certificaciones != null){
        $datos = array_merge($datos,["certificaciones"]);
        $datos = array_merge($datos,$datos_de_certificaciones);
        }
        else{
            $datos = array_merge($datos,["no hay certificaciones"]);
        }

        if ($bolsa != null){
        $datos = array_merge($datos,["bolsa"]);
        $datos = array_merge($datos,$bolsa);
        }
        
        if ($xp_academica != null){
        $datos = array_merge($datos,["academica"]);    
        $datos = array_merge($datos,$xp_academica);
        }
        

        if ($xp_profesional != null){
        $datos = array_merge($datos,["profesional"]); 
        $datos = array_merge($datos,$xp_profesional);
        }
       

        header("Content-Type: application/json");
        echo json_encode($datos);
    }
?>