<?php
    include('../../config/Crud_bd.php'); 

    class ObtenerPolizasGenerales{
        private $base;

        function instancias(){
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

        function TipoServicio($id){
            $consulta = "SELECT serviciospol.IdSerPol, serviciospol.SerPol
            FROM polgeneral, serviciospol, sergralpol
            WHERE polgeneral.IdPolGral = :id
            AND polgeneral.IdPolGral = sergralpol.IdPolGral
            AND sergralpol.IdSerPol = serviciospol.IdSerPol";
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta, $parametros);
            return $response;
        }

        function TituloServicio($tipo, $id){
            if($tipo == 'Curso'){
                $consulta = "SELECT cursos.NomCur as Nombre_servicio
                FROM cursos, cursoserpol, polgeneral
                WHERE polgeneral.IdPolGral = :id
                AND polgeneral.IdPolGral = cursoserpol.IdPolGral
                AND cursoserpol.ClaveCur = cursos.ClaveCur";
                $parametros = [":id"=>$id];
                $response = $this->bd->mostrar($consulta, $parametros);
                return $response;
            }
            else if($tipo == 'Certificación'){
                $consulta = "SELECT certinterna.NomCertInt as Nombre_servicio
                FROM certinterna, cerserpol, polgeneral
                WHERE polgeneral.IdPolGral = :id
                AND polgeneral.IdPolGral = cerserpol.IdPolGral
                AND cerserpol.IdCerInt = certinterna.IdCerInt";
                $parametros = [":id"=>$id];
                $response = $this->bd->mostrar($consulta, $parametros);
                return $response;
            } 
            else if($tipo == "Headhunter"){
                return [["Nombre_servicio"=>"Headhunter"]];
            }
            else if($tipo == "Membresía"){
                return [["Nombre_servicio"=>"Membresía"]];
            }
            else if($tipo == "Consultoría"){
                return [["Nombre_servicio"=>"Consultoría"]];
            }
        }

        function DatosElaborador($id){
            $consulta = 'SELECT polgeneral.NomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol
            FROM polgeneral
            WHERE polgeneral.IdPolGral = :id';
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta,$parametros);
            return $response;
        }

        function DatosGeneralesUsuario($id){
            $consulta = "SELECT  CONCAT_WS(' ',usuaperso.NomPerso, usuaperso.ApePPerso, usuaperso.ApeMPerso) as Nombre, polgeneral.CoceptoGral, DATE_FORMAT(polgeneral.FechaPolGral,'%d/%m/%Y') AS FechaPolGral, tipopol.NombrePol,tipousua.TipoU
            FROM usuaperso, persogralpol, polgeneral, tipogralpol, tipopol,tipousua,persotipousua
            WHERE usuaperso.IdPerso = persogralpol.IdPerso 
            AND persogralpol.idPolGral = :id
            AND persogralpol.IdPolGral = polgeneral.IdPolGral
            AND polgeneral.IdPolGral = tipogralpol.IdPolGral
            AND tipogralpol.IdTipoPol = tipopol.IdTipoPol
            AND usuaperso.IdPerso=persotipousua.IdPerso 
            AND persotipousua.IdUsua=tipousua.IdUsua";
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

        function DatosIndividuales($id){
            $consulta = "SELECT indgralpol.IdPolInd, polindividual.DesPolInd, polindividual.Monto, polindividual.DesDocInd, tipopolacc.IdPolAcc
            FROM polgeneral, indgralpol, polindividual, indpolacc, tipopolacc
            WHERE polgeneral.IdPolGral = :id
            AND polgeneral.IdPolGral = indgralpol.IdPolGral
            AND indgralpol.IdPolInd = polindividual.IdPolInd
            AND polindividual.IdPolInd = indpolacc.IdPolInd
            AND indpolacc.IdPolAcc = tipopolacc.IdPolAcc";
            $parametros = [":id"=>$id];
            $response = $this->bd->mostrar($consulta,$parametros);
            return $response;
        }


        function DatosGenerales($idc){
            $querry = "SELECT CONCAT_WS(' ', polgeneral.NomElaPol, polgeneral.ApePElaPol, polgeneral.ApeMElaPol) as Nombre, polgeneral.CoceptoGral, DATE_FORMAT(polgeneral.FechaPolGral,'%d/%m/%Y') AS FechaPolGral, tipopol.NombrePol,tipopol.IdTipoPol
            FROM polgeneral, tipogralpol, tipopol
            WHERE polgeneral.IdPolGral = :id and polgeneral.IdPolGral=tipogralpol.IdPolGral and tipogralpol.IdTipoPol=tipopol.IdTipoPol";
            $arre = [":id"=>$idc];
            $resultados = $this->bd->mostrar($querry, $arre);
    
            return $resultados;
        }
    }
?>