<?php
    include('../../config/Crud_bd.php');

    class modificarDatosPerfilPersonal extends Crud_bd{

        public function id($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function datosPerso($idperso, $nombre, $apeP, $apeM, $correo, $cedula, $telF, $telM, $fechaNac, $ceduperso){
            $this->conexion_bd();
            
            $consulta = "UPDATE usuaperso SET NomPerso=:nombre, ApePPerso=:paterno, ApeMPerso=:materno, CorreoPerso=:correo, CedulaPerso=:cedula, TelFPerso=:fijo, TelMPerso=:movil, 
            FechaNacPerso=:fecha, ceduPerso=:ceduPerso WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":nombre"=>$nombre, ":paterno"=>$apeP, ":materno"=>$apeM, ":correo"=>$correo, ":cedula"=>$cedula, ":fijo"=>$telF, ":movil"=>$telM, 
            ":fecha"=>$fechaNac, ":ceduPerso"=>$ceduperso];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function obtener_contraseña($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT ContraPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function nueva_contraseña($idperso, $password){
            $this->conexion_bd();
            
            $consulta = "UPDATE usuaperso SET ContraPerso=:contra WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":contra"=>$password];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function obtener_colonia($codigo_postal){
            $this->conexion_bd();
            
            $consulta = "SELECT IdColonia FROM colonias WHERE codpostal=:codigo";
            $parametros = [":codigo"=>$codigo_postal];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function nueva_colonia($idperso, $colonia){
            $this->conexion_bd();
            
            $consulta = "UPDATE persolugares SET IdColonia=:colonia WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":colonia"=>$colonia];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function nueva_calle($idperso, $calle){
            $this->conexion_bd();
            
            $consulta = "UPDATE usuaperso SET CallePerso=:calle WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":calle"=>$calle];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function pasantia($idperso, $pasantia){
            $this->conexion_bd();
            
            $consulta = "UPDATE usuaperso SET PasantiaPerso=:pasan WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":pasan"=>$pasantia];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function grado_estudios($idperso, $grado){
            $this->conexion_bd();
            
            $consulta = "UPDATE persoestudios SET IdGrado=:grado WHERE IdPerso=:idperso";
            $parametros = [":idperso"=>$idperso, ":grado"=>$grado];
            $datos = $this->insertar_eliminar_actualizar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function agregar_ceros($numero, $lon){
            $ceros = "";
            $numero_nuevo="";
            for ($i=0; $i < $lon ; $i++) { 
                $numero_nuevo = $ceros .$numero;
                if(strlen($numero_nuevo) == $lon){
                    break;
                }else{
                    $ceros = $ceros . "0";
                }
    
            }
            return $numero_nuevo;
        }

        public function id_certificaciones(){
            $this->conexion_bd();

            $sql = "SELECT MAX(CAST(IdCerExt AS INT)) FROM certexterna";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $idCert = $this->agregar_ceros($numero, 6);
        
            return $idCert;
        }

        public function certificaciones($idperso, $idcert, $nomCert, $orgCert, $iniCert, $finCert){
            $this->conexion_bd();
            
            $q1 = "INSERT INTO persocertexterna (IdPerso, IdCertExt) 
            VALUES (:idPerso, :idCert)";

            $a1 = [":idPerso"=>$idperso, ":idCert"=>$idcert];

            //consultas para la tabla de usuaperso
            $q2 = "INSERT INTO certexterna (IdCerExt, NomCerExt, OrgCerExt, IniCerExt, FinCerExt) 
            VALUES (:idCert, :nomCert, :orgCert, :iniCert, :finCert)";

            $a2 = [":idCert"=>$idcert, ":nomCert"=>$nomCert, ":orgCert"=>$orgCert, ":iniCert"=>$iniCert, ":finCert"=>$finCert];

            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];
            //acomoda todo en arreglos para mandarlos al CRUD

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;
        }

        public function obtener_empresa($idPerso){
            $this->conexion_bd();
            
            $consulta = "SELECT IdEmpPerso FROM usuapersoemp WHERE IdPerso=:user";
            $parametros = [":user"=>$idPerso];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function id_funcion(){
            $this->conexion_bd();

            $sql = "SELECT MAX(CAST(IdFuncion AS INT)) FROM persoempfun";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $idCert = $this->agregar_ceros($numero, 6);
        
            return $idCert;
        }

        public function datos_laborales($idEmp, $nomEmp, $puestoEmp, $correoEmp, $telFEmp, $extTelEmp){
            $this->conexion_bd();

            $q0 = "UPDATE empresaperso SET NomEmpPerso=:nombre, PuestoEmpPerso=:puesto, CorreoEmpPerso=:correo, 
            TelFEmpPerso=:telf, ExtenTelFEmpPerso=:exten WHERE IdEmpPerso=:idEmpPerso";

            $a0 = [":idEmpPerso"=>$idEmp, ":nombre"=>$nomEmp, ":puesto"=>$puestoEmp, ":correo"=>$correoEmp, ":telf"=>$telFEmp, ":exten"=>$extTelEmp];
            $querry = [$q0];
            $parametros = [$a0];
            //acomoda todo en arreglos para mandarlos al CRUD

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;
        }

        public function funciones($idEmp, $idFunc, $nomFunc){
            $this->conexion_bd();
            $q1 = "INSERT INTO persoempfun (IdEmpPerso, IdFuncion) 
            VALUES (:idEmp, :idFunc)";

            $a1 = [":idEmp"=>$idEmp, ":idFunc"=>$idFunc];

            //consultas para la tabla de usuaperso
            $q2 = "INSERT INTO funciones (IdFuncion, NomFuncion) 
            VALUES (:idFunc, :nomFunc)";

            $a2 = [":idFunc"=>$idFunc, ":nomFunc"=>$nomFunc];

            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];
            //acomoda todo en arreglos para mandarlos al CRUD

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;
        }

        public function eliminar($idc){
            $this->conexion_bd();
            $consulta1 = "DELETE FROM persocertexterna WHERE IdCertExt=:idc";
            $parametros1 = [":idc"=>$idc];
    
            $consulta = "DELETE FROM certexterna WHERE IdCerExt=:idc";
            $parametros = [":idc"=>$idc];
    
            $consul=[$consulta1, $consulta];
            $para=[$parametros1, $parametros];
    
            $datos = $this->insertar_eliminar_actualizar($consul,$para);
            $this->cerrar_conexion();
            return $datos;
        }

        public function eliminar_func($idc){
            $this->conexion_bd();
            $consulta1 = "DELETE FROM persoempfun WHERE IdFuncion=:idc";
            $parametros1 = [":idc"=>$idc];
    
            $consulta = "DELETE FROM funciones WHERE IdFuncion=:idc";
            $parametros = [":idc"=>$idc];
    
            $consul=[$consulta1, $consulta];
            $para=[$parametros1, $parametros];
    
            $datos = $this->insertar_eliminar_actualizar($consul,$para);
            $this->cerrar_conexion();
            return $datos;
        }


    }
?>