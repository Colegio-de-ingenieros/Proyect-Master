<?php
include('../../config/Crud_bd.php');
class EliminarSeguimento{
    

    private $base;

    public function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    public function cerrarCone(){
        $this->base = new Crud_bd();
        $this->base->cerrar_conexion();
    }

    //Eliminar Seguimiento Socios/Asociados
    public function eliminarSoc($idSeg){
        //obtener todos los IdP de socios/asociados
        $querry = "SELECT persoparticipa.IdParP 
                            FROM seguimiento, persoparticipa 
                            WHERE seguimiento.IdSeg = persoparticipa.IdSeg and seguimiento.IdSeg=:idSeg";
        
        $arre = [":idSeg"=>$idSeg];
        $resultados = $this->base->mostrar($querry, $arre);
        
        //Ciclo para eliminar cada IdParP
        for ($i=0; $i < count($resultados); $i++){
            //Obtiene el IdParP
            $idParP = $resultados[$i]["persoparticipa.IdParP"];
            //consultar IdIngre de la tabla persoingresos del participante
            $q_Ingre = "SELECT persoingresos.IdIngre 
                        FROM seguimiento, persoparticipa, persoingresos 
                        WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persoingresos.IdParP 
                        and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a_Ingre=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $res_Ingre = $this->base->mostrar($q_Ingre, $a_Ingre);

            //Eliminar en la tabla persoingresos con el IdParp que tenemos
            $q1 = "DELETE FROM persoingresos 
                                    WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persoingresos.IdParP 
                                    and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a1=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q1, $a1);

            #Elimina todos los ingresos que tiene un participante en la tabla controlingre
            for ($x=0; $x < count($res_Ingre); $x++){
                $idIngre = $res_Ingre[$x]["persoingresos.IdIngre"];
                $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                $a2=[":idIngre"=>$idIngre];
                $this->base->insertar_eliminar_actualizar($q2, $a2);
            }

            //Obtiene todos los gastos que tiene un socio/asociado
            $q_Gas = "SELECT persogastos.IdGas
                        FROM seguimiento, persoparticipa, persogastos
                        WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persogastos.IdParP 
                        and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a_Gas=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $res_Gas = $this->base->mostrar($q_Gas, $a_Gas);

            //Eliminar en la tabla persogastos con el IdParp que tenemos
            $q3 = "DELETE FROM persogastos 
                                    WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persogastos.IdParP 
                                    and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a3=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q3, $a3);


            //Elimina todos los gastos que tiene un participante 
            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["persogastos.IdGas"];
                //Elimina un gasto de la tabla contipogs
                $q4 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                $a4=[":idGas"=>$idGas];
                $this->base->insertar_eliminar_actualizar($q4, $a4);

                //Elimina de la tabla controlgas
                $q5 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                $this->base->insertar_eliminar_actualizar($q5, $a4);
            }

            //Eliminar en tabla persoparticipa
            $q6 = "DELETE FROM persoparticipa WHERE IdParP = :idParP";
            $a6=[":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q6, $a6);
        }
        
        return 'Eliminado soc';
  
    }

    //Elimina el seguimiento de las empresas
    public function eliminarEmp($idSeg){
        //obtener todos los IdP de empresas
        $querry = "SELECT persoparticipa.IdParP 
                            FROM seguimiento, persoparticipa 
                            WHERE seguimiento.IdSeg = persoparticipa.IdSeg and seguimiento.IdSeg=:idSeg";
        
        $arre = [":idSeg"=>$idSeg];
        $resultados = $this->base->mostrar($querry, $arre);
        
        //Ciclo para eliminar cada IdParP
        for ($i=0; $i < count($resultados); $i++){
            //Obtiene el IdParP
            $idParP = $resultados[$i]["persoparticipa.IdParP"];
            //consultar IdIngre de la tabla persoingresos del participante
            $q_Ingre = "SELECT persoingresos.IdIngre 
                        FROM seguimiento, persoparticipa, persoingresos 
                        WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persoingresos.IdParP 
                        and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a_Ingre=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $res_Ingre = $this->base->mostrar($q_Ingre, $a_Ingre);

            //Eliminar en la tabla persoingresos con el IdParp que tenemos
            $q1 = "DELETE FROM persoingresos 
                                    WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persoingresos.IdParP 
                                    and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a1=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q1, $a1);

            #Elimina todos los ingresos que tiene un participante en la tabla controlingre
            for ($x=0; $x < count($res_Ingre); $x++){
                $idIngre = $res_Ingre[$x]["persoingresos.IdIngre"];
                $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                $a2=[":idIngre"=>$idIngre];
                $this->base->insertar_eliminar_actualizar($q2, $a2);
            }

            //Obtiene todos los gastos que tiene un socio/asociado
            $q_Gas = "SELECT persogastos.IdGas
                        FROM seguimiento, persoparticipa, persogastos
                        WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persogastos.IdParP 
                        and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a_Gas=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $res_Gas = $this->base->mostrar($q_Gas, $a_Gas);

            //Eliminar en la tabla persogastos con el IdParp que tenemos
            $q3 = "DELETE FROM persogastos 
                                    WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persogastos.IdParP 
                                    and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a3=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q3, $a3);


            //Elimina todos los gastos que tiene un participante 
            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["persogastos.IdGas"];
                //Elimina un gasto de la tabla contipogs
                $q4 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                $a4=[":idGas"=>$idGas];
                $this->base->insertar_eliminar_actualizar($q4, $a4);

                //Elimina de la tabla controlgas
                $q5 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                $this->base->insertar_eliminar_actualizar($q5, $a4);
            }

            //Eliminar en tabla persoparticipa
            $q6 = "DELETE FROM persoparticipa WHERE IdParP = :idParP";
            $a6=[":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q6, $a6);
        }

 
    }

    //Elimina el seguimiento de los instructores
    public function eliminarIns($idSeg){
        //obtener todos los IdP de instructores
        $querry = "SELECT insparticipa.IdParI 
                    FROM seguimiento, insparticipa 
                    WHERE seguimiento.IdSeg = insparticipa.IdSeg and seguimiento.IdSeg=:idSeg";
        
        $arre = [":idSeg"=>$idSeg];
        $resultados = $this->base->mostrar($querry, $arre);
        
        //Ciclo para eliminar cada IdParI
        for ($i=0; $i < count($resultados); $i++){
            //Obtiene el IdParI
            $idParI = $resultados[$i]["insparticipa.IdParI"];
            //consultar IdIngre de la tabla insingresos del participante
            $q_Ingre = "SELECT insingresos.IdIngre 
                        FROM seguimiento, insparticipa, insingresos 
                        WHERE seguimiento.IdSeg = insparticipa.IdSeg and insparticipa.IdParI=insingresos.IdParI 
                        and seguimiento.IdSeg=:idSeg and insparticipa.IdParI=:idParI";

            $a_Ingre=[":idSeg"=>$idSeg, ":idParI"=>$idParI];
            $res_Ingre = $this->base->mostrar($q_Ingre, $a_Ingre);

            //Eliminar en la tabla insingresos con el IdParI que tenemos
            $q1 = "DELETE FROM insingresos 
                        WHERE seguimiento.IdSeg = insparticipa.IdSeg and insparticipa.IdParI=insingresos.IdParI 
                        and seguimiento.IdSeg=:idSeg and insparticipa.IdParI=:idParI";

            $a1=[":idSeg"=>$idSeg, ":idParI"=>$idParI];
            $this->base->insertar_eliminar_actualizar($q1, $a1);

            #Elimina todos los ingresos que tiene un instructor en la tabla controlingre
            for ($x=0; $x < count($res_Ingre); $x++){
                $idIngre = $res_Ingre[$x]["insingresos.IdIngre"];
                $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                $a2=[":idIngre"=>$idIngre];
                $this->base->insertar_eliminar_actualizar($q2, $a2);
            }

            //Obtiene todos los gastos de un instructor
            $q_Gas = "SELECT insgastos.IdGas 
                        FROM seguimiento, insparticipa, insgastos 
                        WHERE seguimiento.IdSeg = insparticipa.IdSeg and insparticipa.IdParI=insgastos.IdParI 
                        and seguimiento.IdSeg=:idSeg and insparticipa.IdParI=:idParI";

            $a_Gas=[":idSeg"=>$idSeg, ":idParI"=>$idParI];
            $res_Gas = $this->base->mostrar($q_Gas, $a_Gas);

            //Eliminar en la tabla insgastos con el IdParI que tenemos
            $q3 = "DELETE FROM insgastos 
                        WHERE seguimiento.IdSeg = insparticipa.IdSeg and insparticipa.IdParI=insgastos.IdParI 
                        and seguimiento.IdSeg=:idSeg and insparticipa.IdParI=:idParI";

            $a3=[":idSeg"=>$idSeg, ":idParI"=>$idParI];
            $this->base->insertar_eliminar_actualizar($q3, $a3);


            //Elimina todos los gastos que tiene un participante 
            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["insgastos.IdGas"];
                //Elimina un gasto de la tabla contipogs
                $q4 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                $a4=[":idGas"=>$idGas];
                $this->base->insertar_eliminar_actualizar($q4, $a4);

                //Elimina de la tabla controlgas
                $q5 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                $this->base->insertar_eliminar_actualizar($q5, $a4);
            }

            //Eliminar en tabla insparticipa
            $q6 = "DELETE FROM insparticipa WHERE IdParI = :idParI";
            $a6=[":idParI"=>$idParI];
            $this->base->insertar_eliminar_actualizar($q6, $a6);
        }
    }

    public function estatusAct($idSeg,$tipo){
        if($tipo=='proyecto'){
            $querry = "UPDATE proyectos SET EstatusPro=:estatus WHERE IdPro=:id";
            $arre = [":estatus"=>0, ":id"=>$idpro ];
            $this->insertar_eliminar_actualizar($querry, $arre);
        }
       else if($tipo='certificacion'){
            $querry = "UPDATE certinterna SET EstatusCertInt=:estatus WHERE IdCerInt=:id";
            $arre = [":estatus"=>0, ":id"=>$idcert ];
            $this->insertar_eliminar_actualizar($querry, $arre);
       }
       else{
            $querry = "UPDATE cursos SET EstatusCur=:estatus WHERE ClaveCur=:id";
            $arre = [":estatus"=>0, ":id"=>$idcurso ];
            $this->insertar_eliminar_actualizar($querry, $arre);
       }
    }

    public function estatusIns($idSeg){
            $querry = "UPDATE instructor SET EstatusIns=:estatus WHERE ClaveIns=:id";
            $arre = [":estatus"=>0, ":id"=>$idIns ];
            $this->insertar_eliminar_actualizar($querry, $arre);
    }



}

?>