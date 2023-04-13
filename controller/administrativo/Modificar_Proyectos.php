<?php
include_once('../../model/administrativo/Modificar_Proyectos.php');

class ModificaPro{
    private $obj, $idp, $nombre, $inicio, $fin, $objetivo, $monto;

    //inicializa los valores que ocupan las demas funciones
    function instancias(){
        $this->obj = new ModificarProyecto();
        $this->obj->conexion();
        $this->idp = $_POST["idp"];
        $this->nombre = $_POST["nom_proyecto"];
        $this->inicio = $_POST["ini_proyecto"];
        $this->fin = $_POST["fin_proyecto"];
        $this->objetivo = $_POST["obj_proyecto"];
        $this->monto = $_POST["monto_proyecto"];

        $FechaI= new DateTime($this->inicio);
        $FechaF= new DateTime($this->fin);

        //Compara que la fecha fin sea posterios a la fecha de inicio
        if ($FechaF > $FechaI){
            $this->modificar();
        }
        else{
            echo json_encode('Fechas');
        }
        

    }

    //manda a llamar al archivo de model para meter los datos a la base
    function modificar(){
        $this->monto=floatval($this->monto);
        $this->obj->modificar($this->idp, $this->nombre, $this->inicio,$this->fin, $this->objetivo, $this->monto);

        echo json_encode('Correcto');
      
    }

    

}

$obj = new ModificaPro();
$obj->instancias();

?>