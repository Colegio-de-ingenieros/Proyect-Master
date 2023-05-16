<?php
    include('../../config/Crud_bd.php');

    class Actividad_Seguimiento extends Crud_bd{
        public function buscar_datos($tipo, $id){
            $lista=[];
            $nombre=$this->buscar_nombre($tipo, $id);
            $socios=$this->buscar_no_socios($id);
            $empresas=$this->buscar_no_empresas($id);
            $instructores=$this->buscar_no_instructores($id);
            $particSocios=$this->buscar_partic_socios($id);
            $particEmp=$this->buscar_partic_empresas($id);
            $particIns=$this->buscar_partic_instructores($id);
            $gastos=$this->buscar_tipos_gastos();
            $resUno = array_merge($particSocios, $particEmp);
            $resDos = array_merge($resUno, $particIns);
            $lista[0]=$nombre;
            $lista[1]=$socios;
            $lista[2]=$empresas;
            $lista[3]=$instructores;
            $lista[4]=$resDos;
            $lista[5]=$gastos;
            $lista[6]=$resDos;
            return $lista;
        }

        public function buscar_nombre($tipo, $id){
            $this->conexion_bd();
            if ($tipo=="Curso"){
                $sql = "SELECT NomCur 
                        FROM seguimiento, cursos, segcursos
                        WHERE seguimiento.IdSeg= segcursos.IdSeg and 
                                segcursos.ClaveCur = cursos.ClaveCur and seguimiento.IdSeg=:id";
            }else if($tipo=="Proyecto"){
                $sql = "SELECT NomProyecto
                        FROM seguimiento, proyectos, segproyectos
                        WHERE seguimiento.IdSeg = segproyectos.IdSeg and 
                            segproyectos.IdPro = proyectos.IdPro and seguimiento.IdSeg=:id";
            }else{
                $sql = "SELECT NomCertInt 
                        FROM seguimiento, certinterna, segcertint
                        WHERE seguimiento.IdSeg = segcertint.IdSeg and 
                            segcertint.IdCerInt = certinterna.IdCerInt and seguimiento.IdSeg=:id";
            }
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_socios($id){
            $this->conexion_bd();
            $sqlB = "SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso
                    EXCEPT
                    SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso, persoparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = persoparticipa.IdSeg AND
                        persoparticipa.IdPerso = usuaperso.IdPerso ";
            $sql = "SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
            FROM usuaperso";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_empresas($id){
            $this->conexion_bd();
            $sqlB = "SELECT usuaemp.RFCUsuaEmp, CONCAT_WS(' ', usuaemp.NomUsuaEmp) as Nombre
                    FROM usuaemp
                    EXCEPT
                    SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp
                    FROM usuaemp, empparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = empparticipa.IdSeg AND
                        empparticipa.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
            $sql = "SELECT usuaemp.RFCUsuaEmp, CONCAT_WS(' ', usuaemp.NomUsuaEmp) as Nombre
            FROM usuaemp";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_instructores($id){
            $this->conexion_bd();
            $sqlB = "SELECT instructor.ClaveIns, CONCAT_WS(' ', instructor.NomIns, instructor.ApePIns, instructor.ApeMIns) as Nombre
                    FROM instructor
                    EXCEPT
                    SELECT instructor.ClaveIns, CONCAT_WS(' ', instructor.NomIns, instructor.ApePIns, instructor.ApeMIns) as Nombre
                    FROM instructor, insparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = insparticipa.IdSeg AND
                    insparticipa.ClaveIns = instructor.ClaveIns";
            $sql = "SELECT instructor.ClaveIns, CONCAT_WS(' ', instructor.NomIns, instructor.ApePIns, instructor.ApeMIns) as Nombre
            FROM instructor";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

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
        
        public function buscar_tipos_gastos(){
            $this->conexion_bd();
            $sql = "SELECT *
                    FROM tipogastos";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function id_gastos(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdGas, 1) AS INT)) FROM controlgas";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $idGastos = $this->agregar_ceros($numero, 6);
        
            return $idGastos;
        }

        public function id_ingre(){
            $this->conexion_bd();
            $sql = "SELECT MAX(CAST(SUBSTRING(IdIngre, 1) AS INT)) FROM controlingre";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();

            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;  
            }else{
                $numero = $arreglo[0][0];
                $numero++;  
            }

            $idIngre = $this->agregar_ceros($numero, 6);
        
            return $idIngre;
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

        public function insert_gastos_perso($idGas, $monto, $fecha, $doc, $tipoGasto, $idParP){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlgas (IdGas, MontoGas, FechaGas, DocGas) VALUES(:Id, :Monto, :Fecha, :Doc)";

            $a1 = [":Id"=>$idGas, ":Monto"=>$monto, ":Fecha"=>$fecha, ":Doc"=>$doc];

            $q2 = "INSERT INTO contipogas (IdGasto, IdGas) VALUES(:IdTipo, :Id)";

            $a2 = [":IdTipo"=>$tipoGasto, ":Id"=>$idGas];

            $q3 = "INSERT INTO persogastos (IdParP, IdGas) VALUES(:IdPar, :Id)";

            $a3 = [":IdPar"=>$idParP, ":Id"=>$idGas];

            $querry = [$q1, $q2, $q3];
            $parametros = [$a1, $a2, $a3];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);

            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_gastos_empresa($idGas, $monto, $fecha, $doc, $tipoGasto, $idParE){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlgas (IdGas, MontoGas, FechaGas, DocGas) VALUES(:Id, :Monto, :Fecha, :Doc)";

            $a1 = [":Id"=>$idGas, ":Monto"=>$monto, ":Fecha"=>$fecha, ":Doc"=>$doc];

            $q2 = "INSERT INTO contipogas (IdGasto, IdGas) VALUES(:IdTipo, :Id)";

            $a2 = [":IdTipo"=>$tipoGasto, ":Id"=>$idGas];

            $q3 = "INSERT INTO empgastos (IdParE, IdGas) VALUES(:IdPar, :Id)";

            $a3 = [":IdPar"=>$idParE, ":Id"=>$idGas];

            $querry = [$q1, $q2, $q3];
            $parametros = [$a1, $a2, $a3];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);

            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_gastos_instr($idGas, $monto, $fecha, $doc, $tipoGasto, $idParI){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlgas (IdGas, MontoGas, FechaGas, DocGas) VALUES(:Id, :Monto, :Fecha, :Doc)";

            $a1 = [":Id"=>$idGas, ":Monto"=>$monto, ":Fecha"=>$fecha, ":Doc"=>$doc];

            $q2 = "INSERT INTO contipogas (IdGasto, IdGas) VALUES(:IdTipo, :Id)";

            $a2 = [":IdTipo"=>$tipoGasto, ":Id"=>$idGas];

            $q3 = "INSERT INTO insgastos (IdParI, IdGas) VALUES(:IdPar, :Id)";

            $a3 = [":IdPar"=>$idParI, ":Id"=>$idGas];

            $querry = [$q1, $q2, $q3];
            $parametros = [$a1, $a2, $a3];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);

            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_ingresos_perso($idIngre, $monto, $fecha, $doc, $idParP){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlingre (IdIngre, MontoIngre, FechaIngre, DocIngre) VALUES(:Id, :Monto, :Fecha, :Doc)";

            $a1 = [":Id"=>$idIngre, ":Monto"=>$monto, ":Fecha"=>$fecha, ":Doc"=>$doc];

            $q2 = "INSERT INTO persoingresos (IdIngre, IdParP) VALUES(:IdIngre, :IdPar)";

            $a2 = [":IdIngre"=>$idIngre, ":IdPar"=>$idParP];

            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);

            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_ingresos_empresa($idIngre, $monto, $fecha, $doc, $idParE){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlingre (IdIngre, MontoIngre, FechaIngre, DocIngre) VALUES(:Id, :Monto, :Fecha, :Doc)";

            $a1 = [":Id"=>$idIngre, ":Monto"=>$monto, ":Fecha"=>$fecha, ":Doc"=>$doc];

            $q2 = "INSERT INTO empingresos (IdIngre, IdParE) VALUES(:IdIngre, :IdPar)";

            $a2 = [":IdIngre"=>$idIngre, ":IdPar"=>$idParE];

            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);

            $this->cerrar_conexion();

            return $ejecucion;
        }

        public function insert_ingresos_instr($idIngre, $monto, $fecha, $doc, $idParI){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlingre (IdIngre, MontoIngre, FechaIngre, DocIngre) VALUES(:Id, :Monto, :Fecha, :Doc)";

            $a1 = [":Id"=>$idIngre, ":Monto"=>$monto, ":Fecha"=>$fecha, ":Doc"=>$doc];

            $q2 = "INSERT INTO insingresos (IdIngre, IdParI) VALUES(:IdIngre, :IdPar)";

            $a2 = [":IdIngre"=>$idIngre, ":IdPar"=>$idParI];

            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);

            $this->cerrar_conexion();

            return $ejecucion;
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
    }

?>