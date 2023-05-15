<?php
include('../../config/Crud_bd.php');
class EliminarGasIngre{
    

    private $base;

    public function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //Eliminar Gasto de un partcipante
    public function eliminarGasto($idParP, $idGas){
        $a=[":idGas"=>$idGas];
        if (strpos($idParP, 'P') !== false) {
            //Elimina gasto de UN ASOCIADOS            
            //Elimina el gasto de la tabla persogastos
            $q1 = "DELETE FROM persogastos  WHERE IdGas=:idGas";               
            $this->base->insertar_eliminar_actualizar($q1, $a);


        } else if(strpos($idParP, 'E') !== false) {
            //Elimina gasto de UNA EMPRESA                  
            //Elimina el gasto de la tabla empgastos
            $q1 = "DELETE FROM empgastos  WHERE IdGas=:idGas";                 
            $this->base->insertar_eliminar_actualizar($q1, $a);

        } else {
           //Elimina gasto de UN INSTRUCTOR
           //Elimina el gasto de la tabla insgastos
           $q1 = "DELETE FROM insgastos  WHERE IdGas=:idGas";              
           $this->base->insertar_eliminar_actualizar($q1, $a);
        }
        //Elimina el  gasto de la tabla contipogas
        $q2 = "DELETE FROM contipogas  WHERE IdGas=:idGas";
        $this->base->insertar_eliminar_actualizar($q2, $a);
        //Elimina el gasto de la tabla controlgas
        $q3= "DELETE FROM controlgas  WHERE IdGas=:idGas";    
        $this->base->insertar_eliminar_actualizar($q3, $a);

        return "eliminado";
    }

    //Elimina Ingreso de un participante
    public function eliminarIngreso($idParP, $idIngre){
        $a=[":idIngre"=>$idIngre];

        if (strpos($idParP, 'P') !== false) {
            //Elimina Ingresos de UN ASOCIADOS
            $q1 = "DELETE FROM persoingresos  WHERE IdIngre=:idIngre";            
            $this->base->insertar_eliminar_actualizar($q1, $a);

        } else if(strpos($idParP, 'E') !== false) {
             //Elimina Ingresos de UNA EMPRESA
            $q1 = "DELETE FROM empingresos  WHERE IdIngre=:idIngre";                 
            $this->base->insertar_eliminar_actualizar($q1, $a);

        } else {
            //Elimina Ingresos de UN INSTRUCTOR
            $q1 = "DELETE FROM insingresos  WHERE IdIngre=:idIngre";             
            $this->base->insertar_eliminar_actualizar($q1, $a);

        }
        //Elimina el ingreso de la tabla controlingre
        $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
        $this->base->insertar_eliminar_actualizar($q2, $a);
       
        return "eliminado";
    }

}

?>