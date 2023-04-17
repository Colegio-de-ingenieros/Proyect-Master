<?php
include('../../config/Crud_bd.php');

class EliminarCert{
    private $base;

    function instanciar(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //cambia el estatus de lacertificacion a 0
    function cambiarEtatus($idc){
        $querry = "UPDATE certinterna SET EstatusCertInt = :s WHERE IdCerInt = :idc";
        $array = [":s"=> 0, ":idc"=>$idc];

        $this->base->insertar_eliminar_actualizar($querry, $array);
    }

    //elimina la certificacion y todos sus precios historicos
    function eliminar($idc){
        //obtener los id historicos
        $querry_idh = "SELECT IdH FROM certh WHERE IdCerInt = :idc";
        $arreidh = [":idc"=>$idc];

        $resultados = $this->base->mostrar($querry_idh, $arreidh);

        $consultas = [];
        $parametros = [];

        //eliminar todos los registros de los precios 
        for ($i=0; $i < count($resultados); $i++){
            $qTipoUsua = "DELETE FROM tipousuahis WHERE IdH = :idh";
            $arre = [":idh"=> $resultados[$i]["IdH"]];

            $qCerth = "DELETE FROM certh WHERE IdH = :idh";

            $qhistorico = "DELETE FROM tipousuahis WHERE IdH = :idh";

            //agregarr las consultas para eliminar por id historico
            array_push($consultas, $qTipoUsua);
            array_push($consultas, $qCerth);
            array_push($consultas, $qhistorico);

            //agregar los parametros para cada consulta
            array_push($parametros, $arre);
            array_push($parametros, $arre);
            array_push($parametros, $arre);
        }

        $querryCert = "DELETE FROM certinterna WHERE IdCerInt = :idc";
        $arreCert = [":idc"=>$idc];

        array_push($consultas, $querryCert);
        array_push($parametros, $arreCert);

        $this->base->insertar_eliminar_actualizar($consultas, $parametros);
    }

    //busca si hay seguimientos de la certificacion y retorna true si encuentra alguno
    function buscarSeg($idc){
        $querry = "SELECT * FROM certinterna WHERE IdCerInt = :id";
        $arre = [":id"=>$idc];

        $resultados = $this->base->mostrar($querry, $arre);

        echo '<script>alert("'. $resultados[0]["EstatusCertInt"]. '")</script>';
        if($resultados[0]["EstatusCertInt"] == 0){
            return true;
        }

        else{
            return false;
        }
    }
}
?>