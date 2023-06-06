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
            $sql = "SELECT seguimiento.IdSeg, NomProyecto
                    FROM seguimiento, proyectos, segproyectos
                    WHERE seguimiento.IdSeg = segproyectos.IdSeg and segproyectos.IdPro = proyectos.IdPro 
                    and (seguimiento.IdSeg like :busqueda or proyectos.NomProyecto like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_socios($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCur 
                    FROM seguimiento, cursos, segcursos
                    WHERE seguimiento.IdSeg= segcursos.IdSeg and segcursos.ClaveCur = cursos.ClaveCur 
                    and (seguimiento.IdSeg like :busqueda or NomCur like :busqueda)";

            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);
            $this->cerrar_conexion();

            return $resultados;
        }

        function consul_intel_empresas($valor){
            $this->conexion_bd();
            $sql = "SELECT seguimiento.IdSeg, NomCertInt 
                    FROM seguimiento, certinterna, segcertint
                    WHERE seguimiento.IdSeg = segcertint.IdSeg and segcertint.IdCerInt = certinterna.IdCerInt 
                    and (seguimiento.IdSeg like :busqueda or NomCertInt like :busqueda )";
            
            $arre = [":busqueda"=>'%'.$valor.'%'];
            $resultados = $this->mostrar($sql, $arre);

            $this->cerrar_conexion();

            return $resultados;
        }

    }

?>