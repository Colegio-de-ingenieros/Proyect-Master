<?php
    include('../config/Crud_bd.php');

    class Personal extends Crud_bd{

        public function agregar_ceros($numero){
        $ceros = "";
        $numero_nuevo="";
        for ($i=0; $i < 4 ; $i++) { 
            $numero_nuevo = $ceros .$numero;
            if(strlen($numero_nuevo) == 4){
                break;
            }else{
                $ceros = $ceros . "0";
            }

        }

        return $numero_nuevo;
        }

        public function obtener_numero_consecutivo()
        {
            # esta funcion te dara el numero en el que se quedaron

            $this->conexion_bd();//convertimos el numero de char a integer para tomar el mayor
            
            $sql = "SELECT COUNT(IdPerso) FROM usuaperso";
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

        public function obtener_id_empresa_funcion(){

            $this->conexion_bd();
            $sql = "SELECT Count(IdFuncion) FROM persoempfun";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            return $resultado;
        }

        
        
        public function insertar_usuaperso($nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fecha, $calle, $pasan, $antece, $veridi, $aviso, $contra, $codigoPostal, $gradoEst, $empresaLab, $puestoEmp, $correoEmp, $telFEmp, $extTelFEmp, $noCert, $certifi, $orgCert, $fechaICert, $fechaFCert, $funcionEmp){
            
            $arreglo = $this->obtener_numero_consecutivo();
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $numero_con_ceros = $this->agregar_ceros($numero);
            $id = "P".$numero_con_ceros;
            

            $arreglo1 = $this->obtener_id_personal_emp();
            $id1 = "";
            if(is_null($arreglo1[0][0]) == 1){
                $id1 = 1;
                
            }else{
                $id1 = $arreglo1[0][0];
                $id1++;
            }

            $arreglo2 = $this->obtener_id_empresa_funcion();
            $id2 = "";
            if(is_null($arreglo2[0][0]) == 1){
                $id2 = 1;
                
            }else{
                $id2 = $arreglo2[0][0];
                $id2++;
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
            $q7 = "INSERT INTO persocertexterna (IdPerso,IdCertExt) VALUES(:id4,:idC)";
            $a7 = [":id4"=>$id,":idC"=>$noCert];

            //Ingresa datos en la tabla certexterna
            $q8 = "INSERT INTO certexterna (IdCerExt, NomCerExt, OrgCerExt, IniCerExt, FinCerExt) VALUES(:idCE,:nombreC, :orgCer, :iniFecha, :finFecha)";
            $a8 = [":idCE"=>$noCert,":nombreC"=>$certifi,":orgCer"=>$orgCert,":iniFecha"=>$fechaICert,":finFecha"=>$fechaFCert];


//---------------------------------------------------------------------------------------------------
            //ingresa datos en la tabla usuapersoemp
            $q5 = "INSERT INTO usuapersoemp (IdPerso, IdEmpPerso)
            VALUES(:id4, :idE)";
            $a5 = [":id4"=>$id, ":idE"=>$id1];

            //ingresa datos en la tabla empresaperso
            $q6 = "INSERT INTO empresaperso (IdEmpPerso, NomEmpPerso, PuestoEmpPerso, CorreoEmpPerso, TelFEmpPerso, ExtenTelFEmpPerso)
            VALUES(:idEmpre, :nombre, :puesto, :correo, :telFEmp, :extTelFEmp)";
            $a6 = [":idEmpre"=>$id1, ":nombre"=>$empresaLab, ":puesto"=>$puestoEmp, ":correo"=>$correoEmp, ":telFEmp"=>$telFEmp, ":extTelFEmp"=>$extTelFEmp];

//---------------------------------------------------------------------------------------------------
            //Ingresa datos en la tabla persoempfun
            $q9 = "INSERT INTO persoempfun (IdEmpPerso, IdFuncion)
            VALUES(:id5, :idFun)";
            $a9 = [":id5"=>$id1, ":idFun"=>$id2];

            //ingresa datos en la tabla empresaperso
            $q10 = "INSERT INTO funciones (IdFuncion, NomFuncion)
            VALUES(:id6, :funcion)";
            $a10 = [":id6"=>$id2, ":funcion"=>$funcionEmp];

            $query=[$q1, $q3, $q4, $q5, $q6, $q7, $q8, $q9, $q10];
            $parametros=[$a1, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10];

            $resultado=$this->insertar_eliminar_actualizar($q1, $a1);
            $resultado1=$this->insertar_eliminar_actualizar($q3, $a3);
            $resultado2=$this->insertar_eliminar_actualizar($q4, $a4);
            $resultado3=$this->insertar_eliminar_actualizar($q5, $a5);
            $resultado4=$this->insertar_eliminar_actualizar($q6, $a6);
            $resultado5=$this->insertar_eliminar_actualizar($q7, $a7);
            $resultado6=$this->insertar_eliminar_actualizar($q8, $a8);
            $resultado7=$this->insertar_eliminar_actualizar($q9, $a9);
            $resultado8=$this->insertar_eliminar_actualizar($q10, $a10);
            $this->cerrar_conexion();

            
        }

        public function buscar_colonias($codigoPostal){
            # esta funcion trae todas las colonias en base al codigo postal
            $this->conexion_bd();
            $sql = "SELECT IdColonia,nomcolonia,nommunicipio,nomestado FROM"
                    ." estados,municipios,colonias WHERE estados.idestado = municipios.idestado AND"
                    ." municipios.idmunicipio =colonias.idmunicipio AND colonias.codpostal = :cod ";
            $resultado = $this->mostrar($sql,[":cod"=>$codigoPostal]);
            $this->cerrar_conexion();
            return $resultado;
        }
    }
    

?>