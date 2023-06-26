<?php session_start(); ?>
<?php
    require_once("../../model/socio-asociado/Reg_Servicios.php");

    if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
        $headhunter = $_POST['headhunter'];
        $outplacement = $_POST['outplacement'];
        $fecha = $_POST['fecha'];

        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];

        $objeto = new funciones_servicios();
        $objeto->BD();
        $datos_personales = $objeto->datos_usuario($tipo_usuario,$usuario);

        $id_usuario = $datos_personales[0]['IdPerso'];

        if($headhunter == 1){
            $id_servicio = $objeto->get_id_servicio();

            if($id_servicio == null){
                $id_servicio = '000001';
            }
            else{
                $id_servicio = $id_servicio[0]['IdSer'];
                $id_servicio = str_pad((int)substr($id_servicio,1)+1,6,"0",STR_PAD_LEFT);
            }
            $estatus = 0;
            $resultado = $objeto->registrar_servicio_headhunter($id_servicio, $id_usuario, $fecha, $estatus);
        }   
        if($outplacement == 1){
            $id_servicio = $objeto->get_id_servicio();

            if($id_servicio == null){
                $id_servicio = '000001';
            }
            else{
                $id_servicio = $id_servicio[0]['IdSer'];
                $id_servicio = str_pad((int)substr($id_servicio,1)+1,6,"0",STR_PAD_LEFT);
            }
            $estatus = 0;
            $resultado = $objeto->registrar_servicio_outplacement($id_servicio, $id_usuario, $fecha, $estatus);
        }
    
    }
?>