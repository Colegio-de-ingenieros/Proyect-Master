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
        $consulta = "SELECT nomcolonia,nommunicipio,codpostal 
        FROM usuaperso,persolugares,colonias,municipios
        WHERE
        binary(usuaperso.IdPerso) = binary(:id) 
        and usuaperso.IdPerso = persolugares.IdPerso
        and persolugares.IdColonia = colonias.IdColonia
        and colonias.idmunicipio = municipios.idmunicipio";
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

}

?>