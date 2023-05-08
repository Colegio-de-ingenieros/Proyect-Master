<?php
include_once('../../model/socio-asociado/Mostrar_Cuotas_socio.php');

session_start();
if (isset ($_SESSION['usuario']  )){
    $usuario = $_SESSION['usuario'];

    $respuesta = '';
    $bd = new MostrarCuota();
    $id = $bd->usuario($usuario);

    if (isset($_POST['consulta'])) {
        $busqueda = $_POST['consulta'];
        

        if(empty($busqueda)){
        $respuesta = $bd->cuotas_disponibles($id[0]['IdPerso']);         
        }else{
            $respuesta = $bd->buscar($busqueda,$id[0]['IdPerso']);
        }   

        
    }

header("Content-Type: application/json");
echo json_encode($respuesta);
    }
?>