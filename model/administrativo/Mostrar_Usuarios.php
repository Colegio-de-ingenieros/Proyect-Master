<?php
    include('../../config/Crud_bd.php');

    class Mostrar_Usuarios extends Crud_bd{
        public function buscar_asociados(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, numinteligentes.NInteligente, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.  ApeMPerso) as Nombre
                    FROM usuaperso, persotipousua, tipousua, personintel, numinteligentes
                    WHERE usuaperso.IdPerso = persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.TipoU = 'Asociado' and usuaperso.IdPerso = personintel.IdPerso and personintel.IdNIntel = numinteligentes.IdNIntel";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_socios(){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, numinteligentes.NInteligente, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.  ApeMPerso) as Nombre
                    FROM usuaperso, persotipousua, tipousua, personintel, numinteligentes
                    WHERE usuaperso.IdPerso = persotipousua.IdPerso and persotipousua.IdUsua = tipousua.IdUsua and tipousua.TipoU = 'Socio' and usuaperso.IdPerso = personintel.IdPerso and personintel.IdNIntel = numinteligentes.IdNIntel";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        public function buscar_empresas(){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, numinteligentes.NInteligente, usuaemp.NomUsuaEmp
                    FROM usuaemp, usuaempnintel, numinteligentes
                    WHERE  usuaemp.RFCUsuaEmp = usuaempnintel.RFCUsuaEmp and usuaempnintel.IdNIntel = numinteligentes.IdNIntel";
            $resultado = $this->mostrar($sql);
            $this->cerrar_conexion();
            return $resultado;
        }

        
        function consul_intel_asociados($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, NInteligente, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.  ApeMPerso) as Nombre
                    FROM usuaperso, personintel, numinteligentes, persotipousua
                    WHERE usuaperso.IdPerso = personintel.IdPerso and personintel.IdNIntel = numinteligentes.IdNIntel 
                    and persotipousua.IdPerso=usuaperso.IdPerso and persotipousua.IdUsua='1'
                    and (usuaperso.NomPerso like :busqueda or  numinteligentes.NInteligente like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_socios($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaperso.IdPerso, NInteligente, CONCAT_WS(' ', usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.  ApeMPerso) as Nombre
                FROM usuaperso, personintel, numinteligentes, persotipousua
                WHERE usuaperso.IdPerso = personintel.IdPerso and personintel.IdNIntel = numinteligentes.IdNIntel
                and persotipousua.IdPerso=usuaperso.IdPerso and persotipousua.IdUsua='2'
                and (usuaperso.NomPerso like :busqueda or  numinteligentes.NInteligente like :busqueda)";
                
            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultados;
        }

        function consul_intel_empresas($valor){
            $this->conexion_bd();
            $sql = "SELECT usuaemp.RFCUsuaEmp, NInteligente, NomUsuaEmp
                FROM usuaemp,usuaempnintel, numinteligentes
                WHERE usuaemp.RFCUsuaEmp = usuaempnintel.RFCUsuaEmp and usuaempnintel.IdNIntel = numinteligentes.IdNIntel
                and (usuaemp.NomUsuaEmp like :busqueda or  numinteligentes.NInteligente like :busqueda)";
                
            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();
            return $resultados;
        }

    }

?>