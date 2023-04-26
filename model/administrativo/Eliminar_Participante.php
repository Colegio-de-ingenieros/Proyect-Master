<?php
include('../../config/Crud_bd.php');
class EliminarParticipante{
    

    private $base;

    public function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    public function eliminar_GasIngre($idParP){
        //$idPar=$_POST["ingresos_Participante"];

        if (strpos($idParP, 'P') !== false) {
            //Elimina Ingresos de UN ASOCIADOS
            $q="SELECT IdIngre FROM persoingresos WHERE IdParP=:idParP";
            $a=[":idParP"=>$idParP];
            $res_Ingre = $this->base->mostrar($q,$a);

            $q1 = "DELETE FROM persoingresos  WHERE IdParP=:idParP";                 
            $this->base->insertar_eliminar_actualizar($q1, $a);

            for ($x=0; $x < count($res_Ingre); $x++){

                $idIngre = $res_Ingre[$x]["IdIngre"];
                $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                $a2=[":idIngre"=>$idIngre];
                $this->base->insertar_eliminar_actualizar($q2, $a2);
            }
            //ELIMINA LOS GASTOS DE UN ASOCIADO
            $q3="SELECT IdGas FROM persogastos WHERE IdParP=:idParP";
            $res_Gas = $this->base->mostrar($q3, $a);

            $q4 = "DELETE FROM persogastos WHERE IdParP=:idParP";
            $this->base->insertar_eliminar_actualizar($q3, $a);

            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["IdGas"];

                $q5 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                $a5=[":idGas"=>$idGas];
                $this->base->insertar_eliminar_actualizar($q5, $a5);

                $q6 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                $this->base->insertar_eliminar_actualizar($q6, $a5);
            }
            //ELIMINA ASOCIADO DE PERSOPARTICIPA
            $q7 = "DELETE FROM persoparticipa WHERE IdParP = :idParP";
            $this->base->insertar_eliminar_actualizar($q7, $a);

        } else if(strpos($idParP, 'E') !== false) {
             //Elimina Ingresos de UNA EMPRESA
             $q="SELECT IdIngre FROM empingresos WHERE IdParP=:idParP";
             $a=[":idParP"=>$idParP];
             $res_Ingre = $this->base->mostrar($q,$a);
 
             $q1 = "DELETE FROM empingresos  WHERE IdParP=:idParP";                 
             $this->base->insertar_eliminar_actualizar($q1, $a);
 
             for ($x=0; $x < count($res_Ingre); $x++){
 
                 $idIngre = $res_Ingre[$x]["IdIngre"];
                 $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                 $a2=[":idIngre"=>$idIngre];
                 $this->base->insertar_eliminar_actualizar($q2, $a2);
             }
             //ELIMINA LOS GASTOS DE UNA EMPRESA
             $q3="SELECT IdGas FROM empgastos WHERE IdParP=:idParP";
             $res_Gas = $this->base->mostrar($q3, $a);
 
             $q4 = "DELETE FROM empgastos WHERE IdParP=:idParP";
             $this->base->insertar_eliminar_actualizar($q3, $a);
 
             for ($y=0; $y < count($res_Gas); $y++){
                 $idGas = $res_Gas[$y]["IdGas"];
 
                 $q5 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                 $a5=[":idGas"=>$idGas];
                 $this->base->insertar_eliminar_actualizar($q5, $a5);
 
                 $q6 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                 $this->base->insertar_eliminar_actualizar($q6, $a5);
             }
             //ELIMINA ASOCIADO DE EMPPARTICIPA
             $q7 = "DELETE FROM empparticipa WHERE IdParP = :idParP";
             $this->base->insertar_eliminar_actualizar($q7, $a);

        } else {
             //Elimina Ingresos de UN INSTRUCTOR
             $q="SELECT IdIngre FROM insingresos WHERE IdParP=:idParP";
             $a=[":idParP"=>$idParP];
             $res_Ingre = $this->base->mostrar($q,$a);
 
             $q1 = "DELETE FROM insingresos  WHERE IdParP=:idParP";                 
             $this->base->insertar_eliminar_actualizar($q1, $a);
 
             for ($x=0; $x < count($res_Ingre); $x++){
 
                 $idIngre = $res_Ingre[$x]["IdIngre"];
                 $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                 $a2=[":idIngre"=>$idIngre];
                 $this->base->insertar_eliminar_actualizar($q2, $a2);
             }
             //ELIMINA LOS GASTOS DE UN ASOCIADO
             $q3="SELECT IdGas FROM insgastos WHERE IdParP=:idParP";
             $res_Gas = $this->base->mostrar($q3, $a);
 
             $q4 = "DELETE FROM insgastos WHERE IdParP=:idParP";
             $this->base->insertar_eliminar_actualizar($q3, $a);
 
             for ($y=0; $y < count($res_Gas); $y++){
                 $idGas = $res_Gas[$y]["IdGas"];
 
                 $q5 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                 $a5=[":idGas"=>$idGas];
                 $this->base->insertar_eliminar_actualizar($q5, $a5);
 
                 $q6 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                 $this->base->insertar_eliminar_actualizar($q6, $a5);
             }
             //ELIMINA ASOCIADO DE INSPARTICIPA
             $q7 = "DELETE FROM insparticipa WHERE IdParP = :idParP";
             $this->base->insertar_eliminar_actualizar($q7, $a);
            
        }
        
    }

   
}