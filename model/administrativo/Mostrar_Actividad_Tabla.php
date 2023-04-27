<?php
    include('../../config/Crud_bd.php');

    class Actividad_Seg_Tabla extends Crud_bd{
        public function buscar_partic_socios($id){
            $this->conexion_bd();
            $sql = "SELECT persoparticipa.IdParP, CONCAT_WS(' ', 'Asoc.', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso, persoparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = persoparticipa.IdSeg AND
                        persoparticipa.IdPerso = usuaperso.IdPerso ORDER BY NomPerso ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_partic_empresas($id){
            $this->conexion_bd();
            $sql = "SELECT empparticipa.IdParE, CONCAT_WS(' ', 'Emp.', usuaemp.NomUsuaEmp) as Nombre
                    FROM usuaemp, empparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = empparticipa.IdSeg AND
                        empparticipa.RFCUsuaEmp = usuaemp.RFCUsuaEmp ORDER BY NomUsuaEmp ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_partic_instructores($id){
            $this->conexion_bd();
            $sql = "SELECT insparticipa.IdParI, CONCAT_WS(' ', 'Instr.', instructor.NomIns, instructor.ApePIns, instructor.ApeMIns) as Nombre
                    FROM instructor, insparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = insparticipa.IdSeg AND
                    insparticipa.ClaveIns = instructor.ClaveIns ORDER BY NomIns ASC";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function consul_datos_tabla($id){
            $lista=[];
            $particSocios=$this->buscar_partic_socios($id);
            $particEmp=$this->buscar_partic_empresas($id);
            $particIns=$this->buscar_partic_instructores($id);

            //Todos los participantes en un solo array
            $participantes = array_merge($particSocios, $particEmp, $particIns);

            //Ingresos por cada socio
            $ingreSocio=[];
            $gastosHotelSocio=[];
            $gastosTransSocio=[];
            $gastosComidaSocio=[];
            $gastosOficinaSocio=[];
            $gastosHonoSocio=[];
            for ($i=0; $i<count($particSocios);$i++){
                $idP=$particSocios[$i][0];
                $auxIngresos=$this->buscar_socios_ingresos($idP, $id);
                if ($auxIngresos[0][0]==NULL){
                    array_push($ingreSocio, "$ 0"); 
                }else{
                    array_push($ingreSocio, "$ ".$auxIngresos[0][0]); 
                }
                $temporalGastos=[];
                for ($x=1; $x<6;$x++){
                    $auxGastos=$this->buscar_socios_gastos($idP, $id, $x);
                    //var_dump($auxGastos[0][0]);
                    if ($auxGastos[0][0]==NULL){
                        array_push($temporalGastos, "$ 0"); 
                    }else{
                        array_push($temporalGastos, "$ ".$auxGastos[0][0]); 
                    }   
                }
                array_push($gastosHotelSocio, $temporalGastos[0]); 
                array_push($gastosTransSocio, $temporalGastos[1]); 
                array_push($gastosComidaSocio, $temporalGastos[2]); 
                array_push($gastosOficinaSocio, $temporalGastos[3]); 
                array_push($gastosHonoSocio, $temporalGastos[4]); 
            }
            
            //Gastos por cada empresa
            $ingreEmp=[];
            $gastosHotelEmp=[];
            $gastosTransEmp=[];
            $gastosComidaEmp=[];
            $gastosOficinaEmp=[];
            $gastosHonoEmp=[];
             for ($i=0; $i<count($particEmp);$i++){
                $idP=$particEmp[$i][0];
                $auxIngresos=$this->buscar_empresa_ingresos($idP, $id);
                if ($auxIngresos[0][0]==NULL){
                    array_push($ingreEmp, "$ 0"); 
                }else{
                    array_push($ingreEmp, "$ ".$auxIngresos[0][0]); 
                }
                $temporalGastos=[];
                for ($x=1; $x<6;$x++){
                    $auxGastos=$this->buscar_empresa_gastos($idP, $id, $x);
                    //var_dump($auxGastos[0][0]);
                    if ($auxGastos[0][0]==NULL){
                        array_push($temporalGastos, "$ 0"); 
                    }else{
                        array_push($temporalGastos, "$ ".$auxGastos[0][0]); 
                    }   
                }
                array_push($gastosHotelEmp, $temporalGastos[0]); 
                array_push($gastosTransEmp, $temporalGastos[1]); 
                array_push($gastosComidaEmp, $temporalGastos[2]); 
                array_push($gastosOficinaEmp, $temporalGastos[3]); 
                array_push($gastosHonoEmp, $temporalGastos[4]); 
            }

            //Gastos por cada instructor
            $ingreInstr=[];
            $gastosHotelInstr=[];
            $gastosTransInstr=[];
            $gastosComidaInstr=[];
            $gastosOficinaInstr=[];
            $gastosHonoInstr=[];
             for ($i=0; $i<count($particIns);$i++){
                $idP=$particIns[$i][0];
                $auxIngresos=$this->buscar_instr_ingresos($idP, $id);
                if ($auxIngresos[0][0]==NULL){
                    array_push($ingreInstr, "$ 0"); 
                }else{
                    array_push($ingreInstr, "$ ".$auxIngresos[0][0]); 
                }
                $temporalGastos=[];
                for ($x=1; $x<6;$x++){
                    $auxGastos=$this->buscar_instr_gastos($idP, $id, $x);
                    //var_dump($auxGastos[0][0]);
                    if ($auxGastos[0][0]==NULL){
                        array_push($temporalGastos, "$ 0"); 
                    }else{
                        array_push($temporalGastos, "$ ".$auxGastos[0][0]); 
                    }   
                }
                array_push($gastosHotelInstr, $temporalGastos[0]); 
                array_push($gastosTransInstr, $temporalGastos[1]); 
                array_push($gastosComidaInstr, $temporalGastos[2]); 
                array_push($gastosOficinaInstr, $temporalGastos[3]); 
                array_push($gastosHonoInstr, $temporalGastos[4]); 
            }

            //Todos los ingresos en un solo array
            $ingresos = array_merge($ingreSocio, $ingreEmp, $ingreInstr);

            //Todos los gastos en un solo array
            $gastosHotel = array_merge($gastosHotelSocio, $gastosHotelEmp, $gastosHotelInstr);
            $gastosTrans = array_merge($gastosTransSocio, $gastosTransEmp, $gastosTransInstr);
            $gastosComida = array_merge($gastosComidaSocio, $gastosComidaEmp, $gastosComidaInstr);
            $gastosOficina = array_merge($gastosOficinaSocio, $gastosOficinaEmp, $gastosOficinaInstr);
            $gastosHonorario = array_merge($gastosHonoSocio, $gastosHonoEmp, $gastosHonoInstr);


            //Crear un array por para ids y otro para nombre)
            $id=[];
            $nombre=[];
            for ($i=0;$i<count($participantes);$i++){
                array_push($id, $participantes[$i][0]);  //Array de IDs
                array_push($nombre, $participantes[$i][1]);  //Array de nombres
            }

            $lista[0]=$id;
            $lista[1]=$nombre;
            $lista[2]=$gastosHotel;
            $lista[3]=$gastosTrans;
            $lista[4]=$gastosComida;
            $lista[5]=$gastosOficina;
            $lista[6]=$gastosHonorario;
            $lista[7]=$ingresos;

            return $lista;
        }

        public function buscar_socios_ingresos($idP, $id){
            $this->conexion_bd();
            $sql = "SELECT sum(MontoIngre) as TotalIngre 
            FROM usuaperso, persoparticipa, seguimiento, persoingresos, controlingre 
            WHERE seguimiento.IdSeg = :idS AND persoparticipa.IdParP= :idP AND seguimiento.IdSeg = persoparticipa.IdSeg AND persoparticipa.IdPerso = usuaperso.IdPerso AND persoparticipa.IdParP = persoingresos.IdParP AND persoingresos.IdIngre = controlingre.IdIngre";
            $arre = [":idS"=>$id, ":idP"=>$idP];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresa_ingresos($idE, $id){
            $this->conexion_bd();
            $sql = "SELECT sum(MontoIngre) as TotalIngre
            FROM empparticipa, seguimiento, empingresos, controlingre 
            WHERE  seguimiento.IdSeg = :idS AND empparticipa.IdParE= :idE  AND seguimiento.IdSeg = empparticipa.IdSeg AND empparticipa.IdParE = empingresos.IdParE and empingresos.IdIngre = controlingre.IdIngre";
            $arre = [":idS"=>$id, ":idE"=>$idE];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_instr_ingresos($idI, $id){
            $this->conexion_bd();
            $sql = "SELECT sum(MontoIngre) as TotalIngre, controlingre.IdIngre
            FROM insparticipa, seguimiento, insingresos, controlingre 
            WHERE  seguimiento.IdSeg = :idS  AND insparticipa.IdParI= :idI AND seguimiento.IdSeg = insparticipa.IdSeg AND insparticipa.IdParI = insingresos.IdParI AND insingresos.IdIngre = controlingre.IdIngre";
            $arre = [":idS"=>$id, ":idI"=>$idI];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_socios_gastos($idP, $id, $tipo){
            $this->conexion_bd();
            $sql = "SELECT sum(MontoGas) as TotalGasto
            FROM persoparticipa, seguimiento, persogastos, controlgas, contipogas, tipogastos
            WHERE seguimiento.IdSeg = :idS AND persoparticipa.IdParP = :idP AND seguimiento.IdSeg = persoparticipa.IdSeg AND persoparticipa.IdParP = persogastos.IdParP AND persogastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND contipogas.IdGasto = tipogastos.IdGasto AND tipogastos.IdGasto = :tipo";
            $arre = [":idS"=>$id, ":idP"=>$idP, ":tipo"=>$tipo];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresa_gastos($idE, $id, $tipo){
            $this->conexion_bd();
            $sql = "SELECT sum(MontoGas) as TotalGasto
            FROM empparticipa, seguimiento, empgastos, controlgas, contipogas, tipogastos
            WHERE seguimiento.IdSeg = :idS AND empparticipa.IdParE = :idE AND seguimiento.IdSeg = empparticipa.IdSeg AND empparticipa.IdParE = empgastos.IdParE AND empgastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND contipogas.IdGasto = tipogastos.IdGasto AND tipogastos.IdGasto= :tipo";
            $arre = [":idS"=>$id, ":idE"=>$idE, ":tipo"=>$tipo];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_instr_gastos($idI, $id, $tipo){
            $this->conexion_bd();
            $sql = "SELECT sum(MontoGas) as TotalGasto
            FROM insparticipa, seguimiento, insgastos, controlgas, contipogas, tipogastos
            WHERE seguimiento.IdSeg = :idS AND insparticipa.IdParI = :idI AND seguimiento.IdSeg = insparticipa.IdSeg AND insparticipa.IdParI = insgastos.IdParI AND insgastos.IdGas = controlgas.IdGas AND controlgas.IdGas = contipogas.IdGas AND contipogas.IdGasto = tipogastos.IdGasto AND tipogastos.IdGasto = :tipo";
            $arre = [":idS"=>$id, ":idI"=>$idI, ":tipo"=>$tipo];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }


    }

?>