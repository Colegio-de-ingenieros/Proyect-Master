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

    function cuotas_disponibles($id){
        $consulta = "SELECT vigenciacuotas.IdVigCuo,MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota, EstatusVigCuo
        FROM usuaperso,persovigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaperso.IdPerso  = '$id'
        and usuaperso.IdPerso  = persovigcuota.IdPerso 
        and persovigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota";
        $resultados = $this->base->mostrar($consulta);
        return $resultados;
    }
    function buscar($busqueda,$id){
        $querry = "SELECT  vigenciacuotas.IdVigCuo,MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota, EstatusVigCuo
        FROM usuaperso,persovigcuota,vigenciacuotas,tipovigcuota,tipocuota
        WHERE usuaperso.IdPerso  = '$id'
        and usuaperso.IdPerso  = persovigcuota.IdPerso 
        and persovigcuota.IdVigCuo = vigenciacuotas.IdVigCuo
        and vigenciacuotas.IdVigCuo = tipovigcuota.IdVigCuo
        and tipovigcuota.IdCuota = tipocuota.IdCuota
        and (MontoVigCuo LIKE :busqueda OR TipoCuota LIKE :busqueda)";
        $resultados = $this->base->mostrar($querry, [":busqueda" => "%".$busqueda."%"]);
        return $resultados;
    }
    function buscar_datos($id){
        $consulta = "SELECT tipovigcuota.IdCuota, MontoVigCuo, DATE_FORMAT(IniVigCuo, '%d/%m/%Y') IniVigCuo, DATE_FORMAT(FinVigCuo, '%d/%m/%Y') FinVigCuo,TipoCuota, EstatusVigCuo, ComeVigCuo 
        FROM vigenciacuotas, tipovigcuota, tipocuota 
        WHERE vigenciacuotas.IdVigCuo='$id' and vigenciacuotas.IdVigCuo=tipovigcuota.IdVigCuo and tipovigcuota.IdCuota = tipocuota.IdCuota";
        $resultados = $this->base->mostrar($consulta);
        return $resultados;
    }
    function modificar_cuota($id,$comentario,$valor){
        $q1="UPDATE vigenciacuotas SET  ComeVigCuo = :comentario, EstatusVigCuo=:valor WHERE IdVigCuo = :id";
        $a1 = [":comentario"=>$comentario, ":valor"=>$valor, ":id"=>$id];
        $querry = [$q1];
        $arre = [$a1];
        $this->base->insertar_eliminar_actualizar($querry, $arre);
    }
}
$obj = new MostrarSocioAsociado();
$obj->instancias();
?>