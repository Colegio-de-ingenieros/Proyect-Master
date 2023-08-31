<?php
    include('../../config/Crud_bd.php');

    class mostrarDatosPersonales extends Crud_bd{

        public function datos_personales($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso, NomPerso, ApePPerso, ApeMPerso, CedulaPerso, TelFPerso, TelMPerso, FechaNacPerso, CallePerso, PasantiaPerso, ceduPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function domicilio($id){
            $this->conexion_bd();
            $consulta = "SELECT persolugares.IdColonia, colonias.codpostal  FROM  persolugares INNER JOIN colonias 
            on persolugares.IdColonia = colonias.IdColonia and IdPerso = :user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function domicilio_completo($codigo_postal){
            $this->conexion_bd();
            $consulta = "SELECT colonias.nomcolonia, municipios.nommunicipio, estados.nomestado  
            FROM colonias, municipios, estados WHERE codpostal=:user 
            and colonias.idmunicipio=municipios.idmunicipio and estados.idestado=municipios.idestado";
            $parametros = [":user"=>$codigo_postal];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function estudios($id){
            $this->conexion_bd();
            $consulta = "SELECT IdGrado FROM persoestudios WHERE IdPerso=:user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function certificaciones($id){
            $this->conexion_bd();
            $consulta = "SELECT certexterna.IdCerExt, certexterna.NomCerExt, certexterna.OrgCerExt, certexterna.IniCerExt, certexterna.FinCerExt 
            FROM certexterna, persocertexterna WHERE persocertexterna.IdCertExt=certexterna.IdCerExt and persocertexterna.IdPerso=:user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function datos_laborales($id){
            $this->conexion_bd();
            $consulta = "SELECT empresaperso.IdEmpPerso, empresaperso.NomEmpPerso, empresaperso.PuestoEmpPerso, empresaperso.CorreoEmpPerso, 
            empresaperso.TelFEmpPerso, empresaperso.ExtenTelFEmpPerso FROM empresaperso, usuapersoemp 
            WHERE empresaperso.IdEmpPerso=usuapersoemp.IdEmpPerso and usuapersoemp.IdPerso=:user";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function funciones($idEmp){
            $this->conexion_bd();
            $consulta ="SELECT funciones.NomFuncion FROM funciones, persoempfun 
            WHERE funciones.IdFuncion=persoempfun.IdFuncion and persoempfun.IdEmpPerso='0001'";
            $parametros = [":user"=>$idEmp];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

    }
?>