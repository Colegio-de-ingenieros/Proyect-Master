<?php
include('../../config/Crud_bd.php'); 

class MostrarAplicantes{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    function getAplicantes($id){
        $querry = "SELECT bolsacv.IdBolCv, usuaperso.IdPerso, NomPerso, ApePPerso, ApeMPerso,TelMPerso,NumCedAca, ExpSalCv,Carrera, DesProCv, CallePerso, CorreoPerso, FechaNacPerso
        FROM usuaperso,persobolsacv, bolsacv, bolsaempcv,bolsaempresa, expacacv, expacademica 
        WHERE usuaperso.IdPerso=persobolsacv.IdPerso AND persobolsacv.IdBolCv=bolsacv.IdBolCv
         AND bolsacv.IdBolCv=expacacv.IdBolCv AND expacacv.IdExpAca=expacademica.IdExpAca 
         AND bolsacv.IdBolCv=bolsaempcv.IdBolCv AND bolsaempresa.IdEmpBol=bolsaempcv.IdEmpBol 
         AND bolsaempresa.IdEmpBol=:id";
        $resultados = $this->base->mostrar($querry, [":id" => $id]);

        return $resultados;
    }
    function buscadorAplicante($buscar,$id){
        $querry = "SELECT bolsacv.IdBolCv, usuaperso.IdPerso, NomPerso, ApePPerso, ApeMPerso,TelMPerso,NumCedAca, ExpSalCv,Carrera 
        FROM usuaperso,persobolsacv, bolsacv, bolsaempcv,bolsaempresa, expacacv, expacademica 
        WHERE usuaperso.IdPerso=persobolsacv.IdPerso AND persobolsacv.IdBolCv=bolsacv.IdBolCv
         AND bolsacv.IdBolCv=expacacv.IdBolCv AND expacacv.IdExpAca=expacademica.IdExpAca 
         AND bolsacv.IdBolCv=bolsaempcv.IdBolCv AND bolsaempresa.IdEmpBol=bolsaempcv.IdEmpBol 
         AND bolsaempresa.IdEmpBol=:id AND (NomPerso LIKE :busqueda OR ApePPerso LIKE :busqueda OR ApeMPerso LIKE :busqueda
         OR Carrera LIKE :busqueda)";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$buscar."%",":id" => $id]);

        return $resultados;
    }
    function getAplicante($id){
        $querry = "SELECT bolsacv.IdBolCv, usuaperso.IdPerso, NomPerso, ApePPerso, ApeMPerso,TelMPerso,NumCedAca, ExpSalCv,Carrera 
        FROM usuaperso,persobolsacv, bolsacv, bolsaempcv,bolsaempresa, expacacv, expacademica 
        WHERE usuaperso.IdPerso=persobolsacv.IdPerso AND persobolsacv.IdBolCv=bolsacv.IdBolCv
         AND bolsacv.IdBolCv=expacacv.IdBolCv AND expacacv.IdExpAca=expacademica.IdExpAca 
         AND bolsacv.IdBolCv=bolsaempcv.IdBolCv AND bolsaempresa.IdEmpBol=bolsaempcv.IdEmpBol 
         AND bolsacv.IdBolCv=:id";
        $resultados = $this->base->mostrar($querry, [":id" => $id]);

        return $resultados;
    }
    function mostrarColonia($id){
        $q3 = "SELECT * FROM `colonias`,`usuaperso` ,`municipios`, `estados` ,`persolugares`
        WHERE `persolugares`.`IdColonia`=`colonias`.`IdColonia` 
        AND `colonias`.`idmunicipio`= `municipios`.`idmunicipio` 
        AND `municipios`.`idestado` = `estados`.`idestado` 
        AND `usuaperso`.`IdPerso`=`persolugares`.`IdPerso`
        AND `usuaperso`.`IdPerso`=:id";
        $resultados4 = $this->base->mostrar($q3, [":id" => $id]);
        return $resultados4;
    }
    function mostrarAcademica($id){
        $q3 = "SELECT * FROM `expacacv`,`expacademica`,`bolsacv` 
        WHERE `expacacv`.`IdExpAca`=`expacademica`.`IdExpAca` 
        AND `expacacv`.`IdBolCv`=`bolsacv`.`IdBolCv` 
        AND `bolsacv`.`IdBolCv`=:id";
        $resultados4 = $this->base->mostrar($q3, [":id" => $id]);
        return $resultados4;
    }
    function mostrarLaboral($id){
        $q3 = "SELECT * FROM expprocv,expprofesional
        WHERE expprocv.IdExpP=expprofesional.IdExpP AND IdBolCv= :id";
        $resultados4 = $this->base->mostrar($q3, [":id" => $id]);
        return $resultados4;
    }
    function mostrarCertificaciones($id){
        $q3 = "SELECT * FROM certicv,certificaciones
        WHERE certicv.IdCert=certificaciones.IdCert AND IdBolCv= :id";
        $resultados4 = $this->base->mostrar($q3, [":id" => $id]);
        return $resultados4;
    }

}

$obj = new MostrarAplicantes();
$obj->instancias();
?>