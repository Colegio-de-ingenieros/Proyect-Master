<?php session_start(); ?>
<?php
    require_once("../../model/socio-asociado/Mostrar_Servicios.php");

    if (isset ($_SESSION['usuario'])&& isset($_SESSION['tipo_usuario'])){

        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];

        $objeto = new Mostrar_Servicios();
        $objeto -> BD();
        $datos_personales = $objeto -> datos_usuario($tipo_usuario,$usuario);

        $id_usuario = $datos_personales[0]['IdPerso'];
        
        $servicios = $objeto -> servicios_solicitados($id_usuario);
        
        echo json_encode($servicios);
    }
?>