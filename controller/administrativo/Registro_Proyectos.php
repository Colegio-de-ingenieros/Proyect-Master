<?php
include_once('../../model/Reg_Proyectos.php');

class RegistroPro{
    private $obj, $idp, $nombre, $inicio, $fin, $objetivo, $monto;

    //inicializa los valores que ocupan las demas funciones
    function instancias(){
        $this->obj = new NuevoProyecto();
        $this->obj->conexion();
        $this->idp = $this->generarID();
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
        //echo json_encode($tipo . ' ' . $ids);

        return $ids;
    }

    //manda a llamar al archivo de model para meter los datos a la base
    function insertar(){
        $this->monto=floatval($this->monto);
        $this->obj->insertar($this->idp, $this->nombre, $this->inicio,$this->fin, $this->objetivo, $this->monto);

        //verifica que los datos se insertarin en la base de datos
        $resultados = $this->obj->buscarPorId($this->idp);

        if($resultados == true){
            echo json_encode('Correcto');
        }

        else{
            echo json_encode('Ha ocurrido un error al conectar con la base de datos');
        }
    }

    

}

/*$base = new NuevaCertificacion();
$base->conexion();
$id = $base->buscarUltimoId();

echo($id[0]);*/

$obj = new RegistroPro();
$obj->instancias();

?>