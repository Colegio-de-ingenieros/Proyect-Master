<?php
include_once('../../model/administrativo/Reg_Proyectos.php');

class RegistroPro{
    private $obj, $idp, $nombre, $inicio, $fin, $objetivo, $monto;

    function instancias(){
        $this->obj = new NuevoProyecto();
        $this->obj->conexion();
        $this->idp = $this->obj->buscarUltimoIdPro();
        $this->nombre = $_POST["nom_proyecto"];
        $this->inicio = $_POST["ini_proyecto"];
        $this->fin = $_POST["fin_proyecto"];
        $this->objetivo = $_POST["obj_proyecto"];
        $this->monto = $_POST["monto_proyecto"];

        $FechaI= new DateTime($this->inicio);
        $FechaF= new DateTime($this->fin);

        //Compara que la fecha fin sea posterios a la fecha de inicio
        if ($FechaF > $FechaI){
            $this->insertar();
        }
        else{
            echo json_encode('Fechas');
        }
    }

    //busca el ultimo ID de la tabla que le piden y genera el siguiente
    function generarID(){
       
        $ids = $this->obj->buscarUltimoIdPro();
        $id = floatval($ids) +1; 
        $ids = strval($id);
        for($i=strlen($ids); $i<6; $i++){
            $ids = '0'.$ids;
        }

        return $ids;
    }

    function insertar(){
        $this->monto=floatval($this->monto);
        $this->obj->insertar($this->idp, $this->nombre, $this->inicio,$this->fin, $this->objetivo, $this->monto);

        $resultados = $this->obj->buscarPorId($this->idp);

        if($resultados == true){
            echo json_encode('Correcto');
        }

        else{
            echo json_encode('Ha ocurrido un error al conectar con la base de datos');
        }
    }

    

}

$obj = new RegistroPro();
$obj->instancias();

?>