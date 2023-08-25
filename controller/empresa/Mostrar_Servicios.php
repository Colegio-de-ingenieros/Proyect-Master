<?php session_start(); ?>
<?php
    require_once("../../model/empresa/Mostrar_Servicios.php");

    if (isset ($_SESSION['usuario'])&& isset($_SESSION['tipo_usuario'])){

        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];
        $servicio = $_POST['servicio'];
        $fecha = $_POST['fecha'];

        $objeto = new Mostrar_Servicios();
        $objeto -> BD();

        $rfc = $objeto -> get_rfc($usuario);
        $id_usuario = $rfc[0]['RFCUsuaEmp'];


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
        else if($servicio == 'busqueda'){
            $resultados_servicios = $objeto -> busqueda_inteligente($fecha);

            echo json_encode($resultados_servicios);
        }
    }
?>