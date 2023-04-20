<?php
include('../../config/Crud_bd.php');
class EliminarSeguimento{

    private $base;

    function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //Eliminar Seguimiento
    function eliminar($idSeg){

        //obtener IdParP de la tabla persoparticipa
        $querry_IdParP = "SELECT IdParP FROM persoparticipa WHERE IdSeg = :idSeg";
        $arreidSeg = [":idSeg"=>$idSeg];

        $resultados_IdParP = $this->base->mostrar($querry_IdParP, $arreidSeg);
        
        //Ciclo para eliminar cada IdParP
        for ($i=0; $i < count($resultados_IdParP); $i++){

            //Consultar el IdGas de la tabla persogastos
            $idParP = $resultados_IdParP[i];
            $querry_IdGas = "SELECT IdGas FROM persogastos WHERE IdParP = :idParP";
            $arreIdParp = [":idParP"=>$idParP];

            $resultado_IdGas = $this->base->mostrar($querry_IdGas, $arreIdParp);

            //Eliminar en la tabla persogastos con el IdParp que tenemos
            $q_Elim_Persogastos = "DELETE FROM persogastos WHERE IdParP = :idParP";

            $this->base->insertar_eliminar_actualizar($q_Elim_Persogastos, $arreIdParp);

            //consultar IdIngre de la tabla persoingresos
            $querry_IdIngre = "SELECT IdIngre FROM persoingresos WHERE IdParP = :idParP";

            $resultado_IdIngre = $this->base->mostrar($querry_IdIngre, $arreIdParp);

            //Eliminar en la tabla persoingresos con el IdParp que tenemos
            $q_Elim_Persoingresos = "DELETE FROM persoingresos WHERE IdParP = :idParP";

            $this->base->insertar_eliminar_actualizar($q_Elim_Persoingresos, $arreIdParp);

            //Eliminar en la tabla contipogas con el IdGas que tenemos
            $idGas = $resultado_IdGas[i];
            $q_Elim_Contipogas = "DELETE FROM contipogas WHERE IdGas = :idGas";
            $arreIdGas = [":idGas"=>$idGas];

            $this->base->insertar_eliminar_actualizar($q_Elim_Contipogas, $arreIdGas);

            //Elimiar en la tabla de controlgas con el IdGas
            $q_Elim_controlgas = "DELETE FROM controlgas WHERE IdGas = :idGas";

            $this->base->insertar_eliminar_actualizar($q_Elim_controlgas, $arreIdGas);

            //Eliminar en la tabla controlingre con el IdIngre
            $idIngre = $resultado_IdIngre[i];
            $q_Elim_controlingre = "DELETE FROM controlingre WHERE IdIngre = :idIingre";
            $arreIdIngre = [":idIngre"=>$idIngre];

            $this->base->insertar_eliminar_actualizar($q_Elim_controlingre, $arreIdIngre);

            //Eliminar en tabla persoparticipa
            $q_Elim_persoparticipa = "DELETE FROM persoparticipa WHERE IdParP = :idParP";
            $this->base->insertar_eliminar_actualizar($q_Elim_persoparticipa, $arreIdParp);
        }

         



    }
}

?>