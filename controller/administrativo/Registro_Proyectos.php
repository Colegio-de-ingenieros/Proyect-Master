<?php
include_once('../../model/Registro_Proyectos.php');

class RegistroProyectos{
    private $idP, $nombreP, $iniP, $finP, $objP, $montoP;

    //inicializa los valores que ocupan las demas funciones
    function instancias(){
        $this->obj = new NuevoProyecto();
        $this->obj->conexion();
        $this->idP = $this->generarID();
        $this->nombreP = $_POST["nom_proyecto"];
        $this->iniP = $_POST["ini_proyecto"];
        $this->finP = $_POST["fin_proyecto"];
        $this->objP = $_POST["obj_proyecto"];
        $this->montoP = $_POST["monto_proyecto"];
     

    }

    //busca el ultimo ID de la tabla que le piden y genera el siguiente
    function generarID(){
        $idp = $this->obj->buscarUltimoIdCert();
        $id = floatval($idp) +1; 
        $idp = strval($id);
        for($i=strlen($idp); $i<6; $i++){
            $idp = '0'.$idp;
        }
        return $ids;
    }

    //manda a llamar al archivo de model para meter los datos a la base
    function insertar(){
        $this->obj->insertar($this->idP, $this->nombreP, $this->iniP,$this->finP, $this->objP,$this->montoP);

        //Lo datos se insertan en la base de datos
        $resultados = $this->obj->buscarPorId($this->idP);

        if($resultados == true){
            echo json_encode('Correcto');
        }

        else{
            echo json_encode('Ha ocurrido un error al conectar con la base de datos');
        }
    }

    
}

$obj = new RegistroProyectos();
$obj->instancias();

?>