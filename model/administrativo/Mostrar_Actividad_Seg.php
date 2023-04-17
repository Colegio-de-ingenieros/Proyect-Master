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
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso
                    FROM usuaperso
                    EXCEPT
                    SELECT usuaperso.IdPerso, usuaperso.NomPerso
                    FROM usuaperso, segperso, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = segperso.IdSeg AND
                        segperso.IdPerso = usuaperso.IdPerso";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_empresas($id){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp
                    FROM usuaemp
                    EXCEPT
                    SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp
                    FROM usuaemp, segusuaemp, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = segusuaemp.IdSeg AND
                        segusuaemp.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_no_instructores($id){
            $this->conexion_bd();
            $sql = "SELECT instructor.ClaveIns, instructor.NomIns
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
            $sql = "SELECT usuaperso.IdPerso, usuaperso.NomPerso
                    FROM usuaperso, segperso, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = segperso.IdSeg AND
                        segperso.IdPerso = usuaperso.IdPerso";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_partic_empresas($id){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp
                    FROM usuaemp, segusuaemp, seguimiento
                    WHERE seguimiento.IdSeg = :id AND seguimiento.IdSeg = segusuaemp.IdSeg AND
                        segusuaemp.RFCUsuaEmp = usuaemp.RFCUsuaEmp";
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


/*         public function insert_gastos(){
            $this->conexion_bd();
            $q = "INSERT INTO seginstructor (ClaveIns, IdSeg) VALUES(:claveIns, :idSeg)";

            $a = [":claveIns"=>$claveIns, ":idSeg"=>$idSeg];

            $querry = [$q];
            $parametros = [$a];

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            $this->cerrar_conexion();

            return $ejecucion;
        }
 */


    }

?>