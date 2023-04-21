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
            $idParP = $resultados[$i]["IdParP"];
            //consultar IdIngre de la tabla persoingresos del participante
            $q_Ingre = "SELECT persoingresos.IdIngre 
                        FROM seguimiento, persoparticipa, persoingresos 
                        WHERE seguimiento.IdSeg = persoparticipa.IdSeg and persoparticipa.IdParP=persoingresos.IdParP 
                        and seguimiento.IdSeg=:idSeg and persoparticipa.IdParP=:idParP";

            $a_Ingre=[":idSeg"=>$idSeg, ":idParP"=>$idParP];
            $res_Ingre = $this->base->mostrar($q_Ingre, $a_Ingre);

            //Eliminar en la tabla persoingresos con el IdParp que tenemos
            $q1 = "DELETE FROM persoingresos 
                                    WHERE IdParP=:idParP";

            $a1=[":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q1, $a1);

            #Elimina todos los ingresos que tiene un participante en la tabla controlingre
            for ($x=0; $x < count($res_Ingre); $x++){

                $idIngre = $res_Ingre[$x]["IdIngre"];
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
                                    WHERE IdParP=:idParP";

            $a3=[ ":idParP"=>$idParP];
            $this->base->insertar_eliminar_actualizar($q3, $a3);


            //Elimina todos los gastos que tiene un participante 
            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["IdGas"];
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
        //obtener todos los IdE  de Empresas
        $querry = "SELECT empparticipa.IdParE 
                            FROM seguimiento, empparticipa 
                            WHERE seguimiento.IdSeg = empparticipa.IdSeg and seguimiento.IdSeg=:idSeg";
        
        $arre = [":idSeg"=>$idSeg];
        $resultados = $this->base->mostrar($querry, $arre);
        
        //Ciclo para eliminar cada IdParE
        for ($i=0; $i < count($resultados); $i++){
            //Obtiene el IdParE
            $idParE = $resultados[$i]["IdParE"];
            //consultar IdIngre de la tabla empingresos de las empresas
            $q_Ingre = "SELECT empingresos.IdIngre 
                        FROM seguimiento, empparticipa, empingresos 
                        WHERE seguimiento.IdSeg = empparticipa.IdSeg and empparticipa.IdParE=empingresos.IdParE 
                        and seguimiento.IdSeg=:idSeg and empparticipa.IdParE=:idParE";

            $a_Ingre=[":idSeg"=>$idSeg, ":idParE"=>$idParE];
            $res_Ingre = $this->base->mostrar($q_Ingre, $a_Ingre);

            //Eliminar en la tabla empingresos con el IdParE que tenemos
            $q1 = "DELETE FROM empingresos 
                                    WHERE IdParE=:idParE";

            $a1=[":idParE"=>$idParE];
            $this->base->insertar_eliminar_actualizar($q1, $a1);

            #Elimina todos los ingresos que tiene una empresa en la tabla controlingre
            for ($x=0; $x < count($res_Ingre); $x++){

                $idIngre = $res_Ingre[$x]["IdIngre"];
                $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                $a2=[":idIngre"=>$idIngre];
                $this->base->insertar_eliminar_actualizar($q2, $a2);
            }

            //Obtiene todos los gastos que tiene un socio/asociado
            $q_Gas = "SELECT empgastos.IdGas
                        FROM seguimiento, empparticipa, empgastos
                        WHERE seguimiento.IdSeg = empparticipa.IdSeg and empparticipa.IdParE=empgastos.IdParE 
                        and seguimiento.IdSeg=:idSeg and empparticipa.IdParE=:idParE";

            $a_Gas=[":idSeg"=>$idSeg, ":idParE"=>$idParE];
            $res_Gas = $this->base->mostrar($q_Gas, $a_Gas);

            //Eliminar en la tabla persogastos con el IdParp que tenemos
            $q3 = "DELETE FROM empgastos 
                                    WHERE IdParE=:idParE";

            $a3=[ ":idParE"=>$idParE];
            $this->base->insertar_eliminar_actualizar($q3, $a3);


            //Elimina todos los gastos que tiene un participante 
            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["IdGas"];
                //Elimina un gasto de la tabla contipogs
                $q4 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                $a4=[":idGas"=>$idGas];
                $this->base->insertar_eliminar_actualizar($q4, $a4);

                //Elimina de la tabla controlgas
                $q5 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                $this->base->insertar_eliminar_actualizar($q5, $a4);
            }

            //Eliminar en tabla persoparticipa
            $q6 = "DELETE FROM empparticipa WHERE IdParE = :idParE";
            $a6=[":idParE"=>$idParE];
            $this->base->insertar_eliminar_actualizar($q6, $a6);
        }
        
        return 'Eliminado emp';
        
    }

    //Elimina el seguimiento de los instructores
    public function eliminarIns($idSeg){
        //obtener todos los IdI de instructores
        $querry = "SELECT insparticipa.IdParI 
                            FROM seguimiento, insparticipa 
                            WHERE seguimiento.IdSeg = insparticipa.IdSeg and seguimiento.IdSeg=:idSeg";
        
        $arre = [":idSeg"=>$idSeg];
        $resultados = $this->base->mostrar($querry, $arre);
        
        //Ciclo para eliminar cada IdParI
        for ($i=0; $i < count($resultados); $i++){
            //Obtiene el IdParI
            $idParI = $resultados[$i]["IdParI"];
            //consultar IdIngre de la tabla insingresos de los instructores
            $q_Ingre = "SELECT insingresos.IdIngre 
                        FROM seguimiento, insparticipa, insingresos 
                        WHERE seguimiento.IdSeg = insparticipa.IdSeg and insparticipa.IdParI=insingresos.IdParI 
                        and seguimiento.IdSeg=:idSeg and insparticipa.IdParI=:idParI";

            $a_Ingre=[":idSeg"=>$idSeg, ":idParI"=>$idParI];
            $res_Ingre = $this->base->mostrar($q_Ingre, $a_Ingre);

            //Eliminar en la tabla insingresos con el IdParI que tenemos
            $q1 = "DELETE FROM insingresos 
                                    WHERE IdParI=:idParI";

            $a1=[":idParI"=>$idParI];
            $this->base->insertar_eliminar_actualizar($q1, $a1);

            #Elimina todos los ingresos que tiene un instructor en la tabla controlingre
            for ($x=0; $x < count($res_Ingre); $x++){

                $idIngre = $res_Ingre[$x]["IdIngre"];
                $q2 = "DELETE FROM controlingre  WHERE IdIngre=:idIngre";                 
                $a2=[":idIngre"=>$idIngre];
                $this->base->insertar_eliminar_actualizar($q2, $a2);
            }

            //Obtiene todos los gastos que tiene un instructor
            $q_Gas = "SELECT insgastos.IdGas
                        FROM seguimiento, insparticipa, insgastos
                        WHERE seguimiento.IdSeg = insparticipa.IdSeg and insparticipa.IdParI=insgastos.IdParI 
                        and seguimiento.IdSeg=:idSeg and insparticipa.IdParI=:idParI";

            $a_Gas=[":idSeg"=>$idSeg, ":idParI"=>$idParI];
            $res_Gas = $this->base->mostrar($q_Gas, $a_Gas);

            //Eliminar en la tabla persogastos con el IdParp que tenemos
            $q3 = "DELETE FROM insgastos 
                                    WHERE IdParI=:idParI";

            $a3=[ ":idParI"=>$idParI];
            $this->base->insertar_eliminar_actualizar($q3, $a3);


            //Elimina todos los gastos que tiene un participante 
            for ($y=0; $y < count($res_Gas); $y++){
                $idGas = $res_Gas[$y]["IdGas"];
                //Elimina un gasto de la tabla contipogs
                $q4 = "DELETE FROM contipogas  WHERE IdGas=:idGas";                 
                $a4=[":idGas"=>$idGas];
                $this->base->insertar_eliminar_actualizar($q4, $a4);

                //Elimina de la tabla controlgas
                $q5 = "DELETE FROM controlgas  WHERE IdGas=:idGas";                 
                $this->base->insertar_eliminar_actualizar($q5, $a4);
            }
            //Consulta la clave del instructor
            $querry = "SELECT ClaveIns FROM insparticipa WHERE IdParI=:idParI";
            $arre = [":idParI"=>$idParI];
            $resul = $this->base->mostrar($querry, $arre);

            //Eliminar en tabla insparticipa
            $q6 = "DELETE FROM insparticipa WHERE IdParI = :idParI";
            $a6=[":idParI"=>$idParI];
            $this->base->insertar_eliminar_actualizar($q6, $a6);

            $querry = "SELECT * FROM insparticipa WHERE IdParI=:idParI";
            $arre = [":idParI"=>$idParI];
            $resulta = $this->base->mostrar($querry, $arre);

            if ($resulta!=null){
                return false;
            }
            else{
                //No tiene seguimientos, cambia el estatus 
                $idIns=$resul[0]["ClaveIns"];
                $querry = "UPDATE instructor SET EstatusIns=:estatus WHERE ClaveIns=:id";
                $arre = [":estatus"=>0, ":id"=>$idIns ];
                $this->insertar_eliminar_actualizar($querry, $arre);
            }

        }
        
        return 'Eliminado ins';
        
    }

    public function estatus($idSeg, $actividad){
        if($actividad=='proyecto'){
            $querry = "SELECT IdPro FROM segproyectos WHERE IdSeg=:idSeg";
            $arre = [":idSeg"=>$idSeg];
            $resultados = $this->base->mostrar($querry, $arre);

            //Elimina el seguimiento
            $this->eliminar_seg($idSeg);
            //Busca si tiene mas seguimientos
            $idp=$resultados[0]["IdPro"];
            $querry1 = "SELECT * FROM segproyectos WHERE IdPro=:idp";
            $arre1 = [":idp"=>$idp];
            $res = $this->base->mostrar($querry1, $arre1);
            
            //Tiene un seguimiento el proyecto
            if ($res!=null){
                return false;
            }
            else{
                //No tiene seguimientos, cambia el estatus 
                $querry = "UPDATE proyectos SET EstatusPro=:estatus WHERE IdPro=:id";
                $arre = [":estatus"=>0, ":id"=>$idp ];
                $this->insertar_eliminar_actualizar($querry, $arre);
            }
        }
        else if($actividad=='curso'){
            $querry = "SELECT ClaveCur FROM segcursos WHERE IdSeg=:idSeg";
            $arre = [":idSeg"=>$idSeg];
            $resultados = $this->base->mostrar($querry, $arre);

            //Elimina el seguimiento
            $this->eliminar_seg($idSeg);
            //Busca si tiene mas seguimientos
            $idc=$resultados[0]["ClaveCur"];
            $querry1 = "SELECT * FROM segcursos WHERE ClaveCur=:idc";
            $arre1 = [":idc"=>$idc];
            $res = $this->base->mostrar($querry1, $arre1);
            
            //Tiene un seguimiento el curso
            if ($res!=null){
                return false;
            }
            else{
                //No tiene seguimientos, cambia el estatus 
                $querry = "UPDATE proyectos SET EstatusCur=:estatus WHERE ClaveCur=:id";
                $arre = [":estatus"=>0, ":id"=>$idc ];
                $this->insertar_eliminar_actualizar($querry, $arre);
            }

        }
        else{
            $querry = "SELECT IdCerInt FROM segcertint WHERE IdSeg=:idSeg";
            $arre = [":idSeg"=>$idSeg];
            $resultados = $this->base->mostrar($querry, $arre);

            //Elimina el seguimiento
            $this->eliminar_seg($idSeg);
            //Busca si tiene mas seguimientos
            $idc=$resultados[0]["IdCerInt"];
            $querry1 = "SELECT * FROM segcertint WHERE IdCerInt=:idc";
            $arre1 = [":idc"=>$idc];
            $res = $this->base->mostrar($querry1, $arre1);
            
            //Tiene un seguimiento el curso
            if ($res!=null){
                return false;
            }
            else{
                //No tiene seguimientos, cambia el estatus 
                $querry = "UPDATE certinterna SET EstatusCertInt=:estatus WHERE IdCerInt=:id";
                $arre = [":estatus"=>0, ":id"=>$idc ];
                $this->insertar_eliminar_actualizar($querry, $arre);
            }

        }
    }
    public function eliminar_seg($idSeg){
        $q1 = "DELETE FROM seguimiento WHERE IdSeg = :idSeg";
        $a1=[":idSeg"=>$idSeg];
        $this->base->insertar_eliminar_actualizar($q1, $a1);
    }

}

?>