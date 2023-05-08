<?php
include_once('../../model/empresa/Mostrar_Cuotas_empresa.php');

session_start();
if (isset ($_SESSION['usuario']  )){
    $usuario = $_SESSION['usuario'];

    $respuesta = '';
    $bd = new MostrarCuota();
    $id = $bd->usuario($usuario);

    if (isset($_POST['consulta'])) {
        $busqueda = $_POST['consulta'];
        

        if(empty($busqueda)){
        $respuesta = $bd->cuotas_disponibles($id[0]['RFCUsuaEmp']);         
        }else{
            $respuesta = $bd->buscar($busqueda,$id[0]['RFCUsuaEmp']);
        }   

        
    }

header("Content-Type: application/json");
echo json_encode($respuesta);
    }
?>