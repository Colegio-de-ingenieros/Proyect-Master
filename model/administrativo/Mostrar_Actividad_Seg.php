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
            $sql = "SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso
                    EXCEPT
                    SELECT usuaperso.IdPerso, usuaperso.NomPerso
                    FROM usuaperso, persoparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = persoparticipa.IdSeg AND
                        persoparticipa.IdPerso = usuaperso.IdPerso";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_empresas($id){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, CONCAT_WS(' ', usuaemp.NomUsuaEmp) as Nombre
                    FROM usuaemp
                    EXCEPT
                    SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp
                    FROM usuaemp, empparticipa, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = empparticipa.IdSeg AND
                        empparticipa.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_instructores($id){
            $this->conexion_bd();
            $sql = "SELECT instructor.ClaveIns, CONCAT_WS(' ', instructor.NomIns, instructor.ApePIns, instructor.ApeMIns) as Nombre
                    FROM instructor
                    EXCEPT
                    SELECT instructor.ClaveIns, instructor.NomIns
                    FROM instructor, seginstructor, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = seginstructor.IdSeg AND
                        seginstructor.ClaveIns = instructor.ClaveIns";
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
                        persoparticipa.IdPerso = usuaperso.IdPerso";
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
                        empparticipa.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_partic_instructores($id){
            $this->conexion_bd();
            $sql = "SELECT instructor.ClaveIns, instructor.NomIns
                    FROM instructor, seginstructor, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = seginstructor.IdSeg AND
                        seginstructor.ClaveIns = instructor.ClaveIns";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }
        
        public function buscar_tipos_gastos(){
            $this->conexion_bd();
            $sql = "SELECT*
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

        public function insert_gastos($idGas, $monto, $fecha, $doc, $tipoGasto, $idParP){
            $this->conexion_bd();
            $q1 = "INSERT INTO controlGas (IdGas, MontoGas, FechaGas, DocGas) VALUES(:Id, :Monto, :Fecha, :Doc)";

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

        public function insert_ingresos($idIngre, $monto, $fecha, $doc, $idParP){
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



    }

?>