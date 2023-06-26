<?php session_start(); ?>
<?php
    require_once("../../model/socio-asociado/Mostrar_Servicios.php");

    if (isset ($_SESSION['usuario'])&& isset($_SESSION['tipo_usuario'])){

        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
        $servicio = $_POST['servicio'];

        $objeto = new Mostrar_Servicios();
        $objeto -> BD();
        $datos_personales = $objeto -> datos_usuario($tipo_usuario,$usuario);

        $id_usuario = $datos_personales[0]['IdPerso'];

        if ($servicio == 'all'){
            $resultados_servicios = $objeto -> servicios_solicitados($id_usuario);
        
            echo json_encode($resultados_servicios);
        }
        else if ($servicio == 'headhunter'){
            $resultados_servicios = $objeto -> servicios_solicitados_headhunter($id_usuario);

            echo json_encode($resultados_servicios);
        }
        else if($servicio == 'outplacement'){
            $resultados_servicios = $objeto -> servicios_solicitados_outplacement($id_usuario);

            echo json_encode($resultados_servicios);
        }
    }
?>