<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Pol_Gral extends Crud_bd{
        public function buscar_datos($id){
            $lista=[];
            $poliza=$this->buscar_poliza_asoc($id);
            $usuarios=$this->buscar_asocios();
            if ($poliza==Null){
                $poliza=$this->buscar_poliza_soc($id);
                $usuarios=$this->buscar_socios();
                if ($poliza==Null){
                    $poliza=$this->buscar_poliza_emp($id);
                    $usuarios=$this->buscar_empresa();
                }
            }
            
            $serPol=$this->buscar_cursoPol($id);
            $servicios=$this->buscar_curso();
            if ($serPol==Null){
                $serPol=$this->buscar_certPol($id);
                $servicios=$this->buscar_certificaciones();
                if ($serPol==Null){
                    $serPol=$this->buscar_curso();
                    $servicios=$this->buscar_otro_servicio($id);
                    
                }
            }
            $tiposUsua=$this->buscar_usuarios();
            $tipoSer=$this->buscar_servicios();
            $tipoPol=$this->buscar_tipo_pol();
            $lista[0]=$poliza;
            $lista[1]=$tiposUsua;
            $lista[2]=$tipoSer;
            $lista[3]=$tipoPol;
            $lista[4]=$usuarios;
            $lista[5]=$serPol;
            $lista[6]=$servicios;

            
            return $lista;
        }

        public function buscar_poliza_asoc($id){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.nomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol, polgeneral.CoceptoGral, serviciospol.IdSerPol, tipopol.IdTipoPol, usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre, tipousua.IdUsua
            FROM polgeneral, sergralpol, serviciospol, tipogralpol, tipopol , persogralpol, persotipousua, tipousua, usuaperso
            WHERE polgeneral.IdPolGral = :id and polgeneral.IdPolGral=sergralpol.IdPolGral and sergralpol.IdSerPol = serviciospol.IdSerPol and polgeneral.IdPolGral = tipogralpol.IdPolGral and tipogralpol.IdTipoPol=tipopol.IdTipoPol and polgeneral.IdPolGral=persogralpol.IdPolGral and persogralpol.IdPerso=usuaperso.IdPerso and usuaperso.IdPerso=persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.IdUsua = :idUs";
            $arre = [":id"=>$id, ":idUs"=>"1"];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_poliza_soc($id){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.nomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol, polgeneral.CoceptoGral, serviciospol.IdSerPol, tipopol.IdTipoPol, usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre, tipousua.IdUsua
            FROM polgeneral, sergralpol, serviciospol, tipogralpol, tipopol , persogralpol, persotipousua, tipousua, usuaperso
            WHERE polgeneral.IdPolGral = :id and polgeneral.IdPolGral=sergralpol.IdPolGral and sergralpol.IdSerPol = serviciospol.IdSerPol and polgeneral.IdPolGral = tipogralpol.IdPolGral and tipogralpol.IdTipoPol=tipopol.IdTipoPol and polgeneral.IdPolGral=persogralpol.IdPolGral and persogralpol.IdPerso=usuaperso.IdPerso and usuaperso.IdPerso=persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.IdUsua = :idUs";
            $arre = [":id"=>$id, ":idUs"=>"2"];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_poliza_emp($id){
            $this->conexion_bd();
            $sql = "SELECT polgeneral.nomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol, polgeneral.CoceptoGral, serviciospol.IdSerPol, tipopol.IdTipoPol,usuaemp.RFCUsuaEmp, usuaemp.NomUsuaEmp as Nombre, tipousua.IdUsua
            FROM polgeneral, sergralpol, serviciospol, tipogralpol, tipopol , usuaemp, empgralpol, emptipousua, tipousua
            WHERE polgeneral.IdPolGral = >id and polgeneral.IdPolGral=sergralpol.IdPolGral and sergralpol.IdSerPol = serviciospol.IdSerPol and polgeneral.IdPolGral = tipogralpol.IdPolGral and tipogralpol.IdTipoPol=tipopol.IdTipoPol and polgeneral.IdPolGral=empgralpol.IdPolGral and empgralpol.RFCUsuaEmp = usuaemp.RFCUsuaEmp and usuaemp.RFCUsuaEmp=emptipousua.RFCUsuaEmp and emptipousua.IdUsua = tipousua.IdUsua and tipousua.IdUsua = :idUs";
            $arre = [":id"=>$id, ":idUs"=>"3"];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_tipo_pol(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM tipopol";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_usuarios(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM tipousua";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_servicios(){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM serviciospol";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_asocios(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso, persotipousua, tipousua
                    WHERE usuaperso.IdPerso = persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.IdUsua = :id";
            $arre = [":id"=>"1"];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_socios(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre
                    FROM usuaperso, persotipousua, tipousua
                    WHERE usuaperso.IdPerso = persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.IdUsua = :id";
            $arre = [":id"=>"2"];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresa(){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, CONCAT_WS(' ', usuaemp.NomUsuaEmp) as Nombre
                    FROM usuaemp";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_curso(){
            $this->conexion_bd();
            $sql = "SELECT cursos.ClaveCur, cursos.NomCur
                    FROM cursos";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certificaciones(){
            $this->conexion_bd();
            $sql = "SELECT certinterna.IdCerInt, certinterna.NomCertInt
                    FROM certinterna";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_otro_servicio($id){
            $this->conexion_bd();
            $sql = "SELECT*
                    FROM serviciospol
                    WHERE serviciospol.IdSerPol = :id";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_cursoPol($id){
            $this->conexion_bd();
            $sql = "SELECT cursos.ClaveCur
                FROM cursos, cursoserpol, polgeneral
                WHERE polgeneral.IdPolGral=cursoserpol.IdPolGral and cursoserpol.ClaveCur = cursos.ClaveCur and polgeneral.IdPolGral= :id";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_certPol($id){
            $this->conexion_bd();
            $sql = "SELECT certinterna.IdCerInt
                FROM certinterna, cerserpol, polgeneral
                WHERE polgeneral.IdPolGral=cerserpol.IdPolGral and cerserpol.IdCerInt = certinterna.IdCerInt and polgeneral.IdPolGral= :id";
            $arre = [":id"=>$id];
            $resultado = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultado;
        }
    }
?>