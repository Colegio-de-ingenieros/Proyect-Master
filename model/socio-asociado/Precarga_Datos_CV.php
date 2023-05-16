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
    function bolsacv($id){
        $consulta = "SELECT ComeCv,EstatusCv,DesProCv,ResidenciaCv,ExpSalCv FROM usuaperso,persobolsacv,bolsacv
        WHERE 
        binary(usuaperso.IdPerso) = binary(:id)
        and usuaperso.IdPerso = persobolsacv.IdPerso
        and persobolsacv.IdBolCV = bolsacv.IdBolCV";
        $parametros = [":id"=>$id];
        $datos = $this->bd->mostrar($consulta,$parametros);
        return $datos;
    }
    function experiencia_academica($id){
        $consulta = "SELECT Carrera,NumCedAca FROM usuaperso,persobolsacv,bolsacv,expacacv,expacademica
        WHERE 
        binary(usuaperso.IdPerso) = binary(:id)
        and usuaperso.IdPerso = persobolsacv.IdPerso
        and persobolsacv.IdBolCV = bolsacv.IdBolCV
        and bolsacv.IdBolCV = expacacv.IdBolCV
        and expacacv.IdExpAca = expacademica.IdExpAca";
        $parametros = [":id"=>$id];
        $datos = $this->bd->mostrar($consulta,$parametros);
        return $datos;
    }
    function experiencia_profesional($id){
        $consulta = "SELECT EmpExpP,IniExpP,FinExpP,PuestoExpP,ActExpP FROM usuaperso,persobolsacv,bolsacv,expprocv,expprofesional
        WHERE 
        binary(usuaperso.IdPerso) = binary(:id)
        and usuaperso.IdPerso = persobolsacv.IdPerso
        and persobolsacv.IdBolCV = bolsacv.IdBolCV
        and bolsacv.IdBolCV = expprocv.IdBolCV
        and expprocv.IdExpP = expprofesional.IdExpP";
        $parametros = [":id"=>$id];
        $datos = $this->bd->mostrar($consulta,$parametros);
        return $datos;
    }

}

?>