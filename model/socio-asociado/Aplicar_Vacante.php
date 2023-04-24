<?php
    include('../../config/Crud_bd.php'); 

    class dato{
        private $bd;

        function BD(){
            $this->bd = new Crud_bd();
            $this->bd->conexion_bd();
        }

        function usuario($tipo,$correo){
            if ($tipo == 'socio'){
                $consulta = "SELECT IdPerso,NomPerso,ApePPerso,ApeMPerso,FechaNacPerso,CorreoPerso,TelFPerso,TelMPerso,CallePerso
                FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
                $parametros = [":user"=>$correo];
                $datos = $this->bd->mostrar($consulta,$parametros);
                return $datos;
            }
        }

        function lugar($id){
            $consulta = "SELECT nomcolonia,nommunicipio,nomestado 
            FROM usuaperso,persolugares,colonias,municipios,estados
            WHERE
            binary(usuaperso.IdPerso) = binary(:id) 
            and usuaperso.IdPerso = persolugares.IdPerso
            and persolugares.IdColonia = colonias.IdColonia
            and colonias.idmunicipio = municipios.idmunicipio
            and municipios.idestado = estados.idestado";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;

        }

        function certificaciones($id){
            $consulta = "SELECT NomCerExt,OrgCerExt FROM usuaperso,persocertexterna,certexterna
            WHERE 
            binary(usuaperso.IdPerso) = binary(:id)
            and usuaperso.IdPerso = persocertexterna.IdPerso
            and persocertexterna.IdCertExt = certexterna.IdCerExt";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;
        }
        
        function datosCV($id){
            $consulta = "SELECT bolsacv.* 
            FROM persobolsacv, bolsacv 
            WHERE persobolsacv.IdPerso = :id 
            and persobolsacv.IdBolCv = bolsacv.IdBolCv;";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;
        }

        function idsExperienciaAcademica($id){
            $consulta = "SELECT expacacv.IdExpAca 
            FROM expacacv, bolsacv 
            WHERE bolsacv.IdBolCv = :id 
            and bolsacv.IdBolCv = expacacv.IdBolCv";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;
        }

        function ExperienciasAcademicas($id){
            $consulta = "SELECT expacademica.Carrera, expacademica.NumCedAca 
            FROM expacademica, expacacv 
            WHERE expacacv.IdExpAca = :id 
            and expacacv.IdExpAca = expacademica.IdExpAca";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;  
        }

        function idsExperienciaProfesional($id){
            $consulta = "SELECT expprocv.IdExpP 
            FROM expprocv, bolsacv 
            WHERE bolsacv.IdBolCv = :id 
            and bolsacv.IdBolCv = expprocv.IdBolCv";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;
        }

        function ExperienciasProfesionales($id){
            $consulta = "SELECT expprofesional.EmpExpP, expprofesional.IniExpP, expprofesional.FinExpP, expprofesional.PuestoExpP, expprofesional.ActExpP 
            FROM expprofesional, expprocv 
            WHERE expprocv.IdExpP = :id 
            AND expprocv.IdExpP = expprofesional.IdExpP";
            $parametros = [":id"=>$id];
            $datos = $this->bd->mostrar($consulta,$parametros);
            return $datos;
        }
    }
?>