<?php
include('../../config/Crud_bd.php');

class Nuevapoliza{
    private $base;

    //crea un objeto del CRUD para hacer las consultas
    function conexion(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

   
    function insertar($id, $des, $monto, $des_pdf, $tipo){
      
        $q1 = "INSERT INTO polindividual (IdPolInd, DesPolInd, Monto, DesDocInd)
        VALUES(:IdPolInd, :DesPolInd, :Monto, :DesDocInd)";
        $a1= [":IdPolInd"=>$id, ":DesPolInd"=>$des, ":Monto"=>$monto, ":DesDocInd"=>$des_pdf];
        
        if ($tipo == "Debe"){
            $q2="INSERT INTO indpolacc (IdPolInd,IdPolAcc)
            VALUES (:IdPolInd, :IdPolAcc)";
            $a2= [":IdPolInd"=>$id,":IdPolAcc"=>"1"];
        }else{
            $q2="INSERT INTO indpolacc (IdPolInd,IdPolAcc)
            VALUES (:IdPolInd, :IdPolAcc)";
            $a2= [":IdPolInd"=>$id,":IdPolAcc"=>"2"];
        }
        

        $querry = [$q1,$q2];
        $parametros = [$a1,$a2];           
        
        $this->base->insertar_eliminar_actualizar($querry, $parametros);
        
    }

    public function agregar_ceros($numero){
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < 6 ; $i++) { 
            $numero_nuevo = $ceros . $numero;
            if(strlen($numero_nuevo) == 6){
                break;
            }else{
                $ceros = $ceros . "0";
            }
        }
        return $numero_nuevo;
    }


    function id_individual(){
        $querry = "SELECT Max(IdPolInd) FROM polindividual ";
        $resultados = $this->base->mostrar($querry);
        return $resultados;

    }

}

?>