<?php
    include('../../config/Crud_bd.php');

    class Seguimiento extends Crud_bd{
        public function buscar_cursos(){
            $this->conexion_bd();
            $sql = "SELECT claveCur, NomCur
                    FROM cursos ORDER BY NomCur ASC";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_proyectos(){
            $this->conexion_bd();
            $sql = "SELECT idPro, NomProyecto
                    FROM proyectos ORDER BY NomProyecto ASC";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certificaciones(){
            $this->conexion_bd();
            $sql = "SELECT idCerInt, NomCertInt 
                    FROM certinterna ORDER BY NomCertInt ASC";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_instructores(){
            $this->conexion_bd();
            $sql = "SELECT ClaveIns, CONCAT_WS (' ', NomIns, ApePIns, ApeMIns)  FROM instructor ORDER BY NomIns ASC";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_socios(){
            $this->conexion_bd();
            $sql = "SELECT IdPerso, CONCAT_WS(' ', NomPerso, ApePPerso, ApeMPerso) FROM usuaperso ORDER BY NomPerso ASC";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresas(){
            $this->conexion_bd();
            $sql = "SELECT RFCUsuaEmp, NomUsuaEmp FROM usuaemp ORDER BY NomUsuaEmp ASC";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_participantes(){
            $lista=[];
            $instructores=$this->buscar_instructores();
            $socios=$this->buscar_socios();
            $empresas=$this->buscar_empresas();
            $lista[0]=$instructores;
            $lista[1]=$socios;
            $lista[2]=$empresas;
            return $lista;
        }

        public function id_seg(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdSeg, 1) AS INT)) FROM seguimiento";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $idSeg = $this->agregar_ceros($numero, 6);
        
            return $idSeg;
        }

        public function id_parP(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdParP, 2) AS INT)) FROM persoparticipa";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $auxIdP = $this->agregar_ceros($numero, 5);
            $idP = "P".$auxIdP;
            return $idP;

        }

        public function id_parI(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdParI, 2) AS INT)) FROM insparticipa";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $auxIdI = $this->agregar_ceros($numero, 5);
            $idI = "I".$auxIdI;
            return $idI;
            
        }

        public function id_parE(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdParE, 2) AS INT)) FROM empparticipa";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $auxIdE = $this->agregar_ceros($numero, 5);
            $idE = "E".$auxIdE;
            return $idE;
        }

        public function agregar_ceros($numero, $lon){
            $ceros = "";
            $numero_nuevo="";
            for ($i=0; $i < $lon ; $i++) { 
                $numero_nuevo = $ceros . $numero;
                if(strlen($numero_nuevo) == $lon){
                    break;
                }else{
                    $ceros = $ceros . "0";
                }
            }
            return $numero_nuevo;
        }

        public function insert_seg($idSeg){
            $this->conexion_bd();
            $q = "INSERT INTO seguimiento (IdSeg) VALUES(:idSeg)";

            $a = [":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_curso($idSeg, $claveCur){
            $this->conexion_bd();
            $q = "INSERT INTO segcursos (ClaveCur, IdSeg) VALUES(:claveCur, :idSeg)";

            $a = [":claveCur"=>$claveCur, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_proyectos($idSeg, $idPro){
            $this->conexion_bd();
            $q = "INSERT INTO segproyectos (IdPro, IdSeg) VALUES(:idPro, :idSeg)";

            $a = [":idPro"=>$idPro, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_certificaciones($idSeg, $idCer){
            $this->conexion_bd();
            $q = "INSERT INTO segcertint (IdSeg, IdCerInt) VALUES(:idSeg, :idCer)";

            $a = [":idSeg"=>$idSeg, ":idCer"=>$idCer,];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_instructores($idpI,$idSeg, $claveIns){
            $this->conexion_bd();
            $q = "INSERT INTO insparticipa (IdParI, ClaveIns, IdSeg) VALUES(:idP, :claveIns, :idSeg)";

            $a = [":idP"=>$idpI,":claveIns"=>$claveIns, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_socios($idSeg, $idPerso, $idpP){
            $this->conexion_bd();
            $q = "INSERT INTO persoparticipa (IdParP, IdPerso, IdSeg) VALUES(:idP, :idPerso, :idSeg)";

            $a = [":idP"=>$idpP,":idPerso"=>$idPerso, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_empresas($idSeg, $rfc, $idpE){
            $this->conexion_bd();
            $q = "INSERT INTO empparticipa (IdParE, RFCUsuaEmp, IdSeg) VALUES(:idE,:rfc, :idSeg)";

            $a = [":idE"=>$idpE,":rfc"=>$rfc, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }

        function estatus_proyectos($idpro){
            $this->conexion_bd();
            $querry = "UPDATE proyectos SET EstatusPro=:estatus WHERE IdPro=:id";
            $arre = [":estatus"=>0, ":id"=>$idpro ];
            $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
        }

        public function estatus_certifica($idcert){
            $this->conexion_bd();
            $querry = "UPDATE certinterna SET EstatusCertInt=:estatus WHERE IdCerInt=:id";
            $arre = [":estatus"=>0, ":id"=>$idcert ];
            $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
        }

        public function estatus_cursos($idcurso){
            $this->conexion_bd();
            $querry = "UPDATE cursos SET EstatusCur=:estatus WHERE ClaveCur=:id";
            $arre = [":estatus"=>0, ":id"=>$idcurso ];
            $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
        }

        public function estatus_ins($idIns){
            $this->conexion_bd();
            $querry = "UPDATE instructor SET EstatusIns=:estatus WHERE ClaveIns=:id";
            $arre = [":estatus"=>0, ":id"=>$idIns ];
            $this->insertar_eliminar_actualizar($querry, $arre);
            $this->cerrar_conexion();
        }



    }

?>