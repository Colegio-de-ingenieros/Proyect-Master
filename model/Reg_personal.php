<?php
    include('../../config/Crud_bd.php');

    class Personal extends Crud_bd{

        public function obtener_id_personal(){

            $this->conexion_bd();
            $sql = "SELECT Count(IdPerso) FROM usuaperso";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            return $resultado;
        }

        public function obtener_id_personal_emp(){

            $this->conexion_bd();
            $sql = "SELECT Count(IdEmpPerso) FROM usuapersoemp";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            return $resultado;
        }
        
        public function insertar_usuaperso($nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $contra, $codigoPostal, $gradoEst, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp){
            
            $arreglo = $this->obtener_id_personal();
            $id = "";
            if(is_null($arreglo[0][0]) == 1){
                $id = 1;
                
            }else{
                $id = $arreglo[0][0];
                $id++;
                
            }
            

            $arreglo1 = $this->obtener_id_personal_emp();
            $id1 = "";
            if(is_null($arreglo1[0][0]) == 1){
                $id1 = 1;
                
            }else{
                $id1 = $arreglo1[0][0];
                $id1++;
            }

//---------------------------------------------------------------------------------------------------
            //ingresa los datos de la tabla usuaperso
            $this->conexion_bd();
            $q1 = "INSERT INTO usuaperso (IdPerso, NomPerso, ApePPerso, ApeMPerso, CorreoPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, AntecePerso, DatosVerPerso, AvisoPerso, ContraPerso)
            VALUES(:id, :nombre, :apeP, :apeM, :correo, :cedula, :telF, :telM, :fecha, :calle, :pasan, :antece, :veridi, :aviso, :contra)";
            $a1 = [":id"=>$id, ":nombre"=>$nombre, ":apeP"=>$apeP, ":apeM"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":telF"=>$telF, ":telM"=>$telM, ":fecha"=>$fecha, ":calle"=>$calle, ":pasan"=>$pasan, ":antece"=>$antece, ":veridi"=>$veridi, ":aviso"=>$aviso, ":contra"=>$contra];

//---------------------------------------------------------------------------------------------------
            //Ingresa datos en la tabla persotipousua


//---------------------------------------------------------------------------------------------------
            //ingresa datos en la tabla personintel



//---------------------------------------------------------------------------------------------------

            //ingresa datos en la tabla persoestudios
            $sql = "SELECT IdColonia FROM
             estados,municipios,colonias WHERE estados.idestado = municipios.idestado AND
              municipios.idmunicipio =colonias.idmunicipio AND colonias.codpostal = :cod ";
            $resultado = $this->mostrar($sql,[":cod"=>$codigoPostal]);
            $id_colonia=[];
            for($i=0; $i<count($resultado);$i++){
                array_push($id_colonia, $resultado[$i]["IdColonia"]);
                $id_colonia1=$id_colonia[$i];
            }
    
            $q3 = "INSERT INTO persolugares (IdPerso,IdColonia) VALUES(:id2,:colonia)";
            $a3 = [":id2"=>$id,":colonia"=>$id_colonia1];   


//---------------------------------------------------------------------------------------------------
            //ingresa datos en la tabla persoestudio
            $q4 = "INSERT INTO persoestudios (IdPerso,IdGrado) VALUES(:id3,:idG)";
            $a4 = [":id3"=>$id,":idG"=>$gradoEst];

//---------------------------------------------------------------------------------------------------
            //Ingresa datos en la tabla persocertexterna


//---------------------------------------------------------------------------------------------------
            //ingresa datos en la tabla usuapersoemp
            $q5 = "INSERT INTO usuapersoemp (IdPerso, IdEmpPerso)
            VALUES(:id4, :idE)";
            $a5 = [":id4"=>$id, ":idE"=>$id1];

            //ingresa datos en la tabla empresaperso
            $q6 = "INSERT INTO empresaperso (IdEmpPerso, NomEmpPerso, PuestoEmpPerso, CorreoEmpPerso, TelFEmpPerso, ExtenTelFEmpPerso)
            VALUES(:idEmpre, :nombre, :puesto, :correo, :telFEmp, :extTelFEmp)";
            $a6 = [":idEmpre"=>$id1, ":nombre"=>$empresaLab, ":puesto"=>$puestoEmp, ":correo"=>$correoEmp, ":telFEmp"=>$telFEmp, ":extTelFEmp"=>$extTelFEmp];

            $query=[$q1, $q3, $q4, $q5, $q6];
            $parametros=[$a1, $a3, $a4, $a5, $a6];

            $resultado=$this->insertar_eliminar_actualizar($q1, $a1);
            $resultado1=$this->insertar_eliminar_actualizar($q3, $a3);
            $resultado2=$this->insertar_eliminar_actualizar($q4, $a4);
            $resultado3=$this->insertar_eliminar_actualizar($q5, $a5);
            $resultado4=$this->insertar_eliminar_actualizar($q6, $a6);
            $this->cerrar_conexion();

            return $resultado;
            return $resultado1;
            return $resultado2;
            return $resultado3;
            return $resultado4;
        }

        public function buscar_colonias($codigoPostal){
            # esta funcion trae todas las colonias en base al codigo postal
            $this->conexion_bd();
            $sql = "SELECT IdColonia,nomcolonia,ciudad,nomestado FROM"
                    ." estados,municipios,colonias WHERE estados.idestado = municipios.idestado AND"
                    ." municipios.idmunicipio =colonias.idmunicipio AND colonias.codpostal = :cod ";
            $resultado = $this->mostrar($sql,[":cod"=>$codigoPostal]);
            $this->cerrar_conexion();
            return $resultado;
        }
    }
    

?>