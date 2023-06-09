<?php
include('../../config/Crud_bd.php'); 

class MostrarSocioAsociado{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }
    function getId($intel){
        $querry = "SELECT IdPerso
        FROM personintel,numinteligentes
        WHERE personintel.IdNIntel = numinteligentes.IdNIntel AND NInteligente = :inteligente";
        $resultados = $this->base->mostrar($querry, [":inteligente" => $intel]);
        return $resultados;
    }

    function buscar_datos($id){
        $consulta = "SELECT * 
        FROM altacursos
        WHERE IdCurPerso = '$id'";
        $resultados = $this->base->mostrar($consulta);
        return $resultados;
    }
    function modificar_curso($id,$comentario,$valor){
        $q1="UPDATE altacursos SET  ComeCurPerso = :comentario, EstatusCurPerso=:valor WHERE IdCurPerso = :id";
        $a1 = [":comentario"=>$comentario, ":valor"=>$valor, ":id"=>$id];
        $querry = [$q1];
        $arre = [$a1];
        $this->base->insertar_eliminar_actualizar($querry, $arre);
    }
    function cursos_disponibles($id){
        $querry = "SELECT persoaltacur.IdCurPerso, NomCurPerso, HraCurPerso, OrgCurPerso, EstatusCurPerso
        From persoaltacur, altacursos
        WHERE persoaltacur.IdPerso = '$id'
        AND persoaltacur.IdCurPerso  = altacursos.IdCurPerso";
        $resultados = $this->base->mostrar($querry);
        return $resultados;
    }
    function cursos_buscar($busqueda,$id){
        $querry = "SELECT persoaltacur.IdCurPerso, NomCurPerso, HraCurPerso, OrgCurPerso, EstatusCurPerso
        From persoaltacur, altacursos
        WHERE persoaltacur.IdPerso = '$id'
        AND persoaltacur.IdCurPerso  = altacursos.IdCurPerso
        AND (NomCurPerso LIKE :busqueda OR OrgCurPerso LIKE :busqueda)";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);
        return $resultados;
    }
}
$obj = new MostrarSocioAsociado();
$obj->instancias();
?>