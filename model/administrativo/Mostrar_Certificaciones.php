<?php
include('../../config/Crud_bd.php'); 

class MostrarCertificaciones{
    private $base;

    function instancias(){
        $this->base = new Crud_bd();
        $this->base->conexion_bd();
    }

    //busca el recio con la fecha mas reciente de la certificacion que recibe para los usuarios generales
    function buscarUltimoPrecioG($idc){
        //busca todos los registros de esa certificacion
        $querry = "SELECT * FROM certh, historico WHERE (certh.IdCerInt = :id AND certh.IdH = historico.IdH);";

        $resultados = $this->base->mostrar($querry, [":id"=>$idc]);

        //pone las fechas en un arreglo aparte para buscar la mas reciente
        $fechas = [];
        
        for($i=0; $i<count($resultados);$i++){
            array_push($fechas, $resultados[$i]["FechaH"]);
        }

        sort($fechas, 0);

        $fecha = '';

        if(count($fechas) >= 1){
            $fecha = $fechas[count($fechas)-1];
        }

        //busca el precio de la certificacion en la fehca especificada
        $querry = "SELECT * FROM historico, certh, tipousuahis WHERE (certh.IdCerInt = :id AND 
        certh.IdH = historico.IdH AND FechaH = :fecha AND historico.IdH = tipousuahis.IdH AND tipousuahis.IdUsua = '5')";
        $arre = [":id"=>$idc, ":fecha"=>$fecha];

        $resultados = $this->base->mostrar($querry, $arre);

        //busca el ultimo precio de esa fecha (en caso de que hubieran varias modificaciones el mismo día)
        $precio = 0;

        if(count($resultados) >= 1){
            $precio = strval($resultados[count($resultados)-1]["PrecioH"]);
        }

        return $precio;
      }

    //busca el recio con la fecha mas reciente de la certificacion que recibe para los usuarios generales
    function buscarUltimoPrecioA($idc)
    {
        //busca todos los registros de esa certificacion
        $querry = "SELECT * FROM certh, historico WHERE (certh.IdCerInt = :id AND certh.IdH = historico.IdH) ORDER BY FechaH;";

        $resultados = $this->base->mostrar($querry, [":id" => $idc]);

        //pone las fechas en un arreglo aparte para buscar la mas reciente
        $fechas = [];

        for ($i = 0; $i < count($resultados); $i++) {
            array_push($fechas, $resultados[$i]["FechaH"]);
        }

        sort($fechas, 0);

        $fecha = '';

        if (count($fechas) >= 1) {
            $fecha = $fechas[count($fechas) - 1];
        }

        //busca el precio de la certificacion en la fehca especificada
        $querry = "SELECT * FROM historico, certh, tipousuahis WHERE (certh.IdCerInt = :id AND 
        certh.IdH = historico.IdH AND FechaH = :fecha AND historico.IdH = tipousuahis.IdH AND tipousuahis.IdUsua = '1')";
        $arre = [":id" => $idc, ":fecha" => $fecha];

        $resultados = $this->base->mostrar($querry, $arre);

        //busca el ultimo precio de esa fecha (en caso de que hubieran varias modificaciones el mismo día)
        $precio = 0;

        if (count($resultados) >= 1) {
            $precio = strval($resultados[count($resultados) - 1]["PrecioH"]);
        }

        return $precio;
    }

    function consultaInteligente($valor){
        $querry = "SELECT * FROM certinterna 
        WHERE NomCertInt LIKE :q OR DesCerInt LIKE :q OR EstatusCertInt LIKE :q OR abrevCertInt LIKE :q";

        $arre = [":q"=>'%'.$valor.'%'];

        $resultados = $this->base->mostrar($querry, $arre);

        return $resultados;
    }

    //hace la consulta principal de los datos de las certificaciones
    function getCertificaciones(){
        $querry = "SELECT * FROM certinterna";
        $resultados = $this->base->mostrar($querry);

        return $resultados;
    }

    //hace la consulta principal de los datos de la certificacion con el id que recibe
    function getCertificacionesId($idc)
    {
        $querry = "SELECT * FROM certinterna WHERE IdCerInt = :idc";
        $arre = [":idc"=>$idc];
        $resultados = $this->base->mostrar($querry, $arre);

        return $resultados;
    }
    
}
?>