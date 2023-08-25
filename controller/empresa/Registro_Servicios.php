<?php session_start(); ?>
<?php
    require_once("../../model/empresa/Reg_Servicios.php");

    if (isset ($_SESSION['usuario']) && isset($_SESSION['tipo_usuario'])){
        $headhunter = $_POST['headhunter'];
        $outplacement = $_POST['outplacement'];
        $fecha = $_POST['fecha'];

        // * Instanciación del CRUD y extracción de datos
        $bd = new funciones_servicios();
        $bd -> BD();

        $correo_empresa = $_SESSION['usuario'];
        $rfc_empresa = $bd -> get_rfc($correo_empresa);
        $rfc_empresa = $rfc_empresa[0][0];

        //* Registro del servicio

        if($headhunter == 1){
            $id_servicio = $bd -> get_id_servicio();

            if($id_servicio == null){
                $id_servicio = '000001';
            }
            else{
                $id_servicio = $id_servicio[0]['IdSer'];
                $id_servicio = str_pad((int)substr($id_servicio,1)+1,6,"0",STR_PAD_LEFT);
            }
            $estatus = 0;
            $resultado = $bd -> registrar_servicio_headhunter($id_servicio, $rfc_empresa, $fecha, $estatus);
        }   

        if($outplacement == 1){
            $id_servicio = $bd -> get_id_servicio();

            if($id_servicio == null){
                $id_servicio = '000001';
            }
            else{
                $id_servicio = $id_servicio[0]['IdSer'];
                $id_servicio = str_pad((int)substr($id_servicio,1)+1,6,"0",STR_PAD_LEFT);
            }
            $estatus = 0;
            $resultado = $bd -> registrar_servicio_outplacement($id_servicio, $rfc_empresa, $fecha, $estatus);
        }
    }
?>