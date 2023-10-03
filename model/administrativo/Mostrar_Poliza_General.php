<?php
    include('../../config/Crud_bd.php'); 

    class ObtenerPolizasGenerales{
        private $bd;    

        function BD(){
            $this->bd = new Crud_bd();
            $this->bd->conexion_bd();
        }

        function ComprobarUsuario($id){
            $consulta = "SELECT persogralpol.IdPolGral
            FROM persogralpol
            WHERE persogralpol.IdPolGral = :id";
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta,$parametros);

            if($response){
                return true;
            }else{
                return false;
            }
        }

        function ComprobarEmpresa($id){
            $consulta = "SELECT empgralpol.IdPolGral
            FROM empgralpol
            WHERE empgralpol.IdPolGral = :id";
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta,$parametros);

            if($response){
                return true;
            }else{
                return false;
            }
        }

        function DatosGeneralesUsuario($id){
            $consulta = "SELECT usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso, polgeneral.CoceptoGral, DATE_FORMAT(polgeneral.FechaPolGral,'%d/%m/%Y') AS FechaPolGral, tipopol.NombrePol
            FROM usuaperso, persogralpol, polgeneral, tipogralpol, tipopol
            WHERE usuaperso.IdPerso = persogralpol.IdPerso 
            AND persogralpol.idPolGral = :id
            AND persogralpol.IdPolGral = polgeneral.IdPolGral
            AND polgeneral.IdPolGral = tipogralpol.IdPolGral
            AND tipogralpol.IdTipoPol = tipopol.IdTipoPol";
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta,$parametros);
            return $response;
        }

        function DatosGeneralesEmpresa($id){
            $consulta = "SELECT usuaemp.NomUsuaEmp, polgeneral.CoceptoGral, DATE_FORMAT(polgeneral.FechaPolGral,'%d/%m/%Y') AS FechaPolGral, tipopol.NombrePol
            FROM usuaemp, empgralpol, polgeneral, tipogralpol, tipopol
            WHERE usuaemp.RFCUsuaEmp = empgralpol.RFCUsuaEmp 
            AND empgralpol.idPolGral = :id
            AND empgralpol.IdPolGral = polgeneral.IdPolGral
            AND polgeneral.IdPolGral = tipogralpol.IdPolGral
            AND tipogralpol.IdTipoPol = tipopol.IdTipoPol";
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta,$parametros);
            return $response;
        }
    }
?>