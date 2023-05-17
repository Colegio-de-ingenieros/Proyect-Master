<?php
    include('../../config/Crud_bd.php');
    
    class NuevaCertificacion{
        private $base;

        //crea un objeto del CRUD para hacer las consultas
        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        //busca el ultimo id de la tabla certificaciones internas
        function buscarUltimoIdHist()
        {
            $querry = "SELECT * FROM historico";

            $resultados = $this->base->mostrar($querry);

            //guarda los valores como flotantes para ordenarlos bien
            $aux = [];

            for ($i = 0; $i < count($resultados); $i++) {
                array_push($aux, floatval($resultados[$i]["IdH"]));
            }

            sort($aux, 0);

            $id = 0;
            if (count($resultados) >= 1) {
                $id = $aux[count($aux) - 1];
            }


            return $id;
        }

        //actualiza la certificacion sin el logo
        function actualizarSinLogo($idc, $desc, $nombre, $abre){
            $querry = "UPDATE certinterna SET NomCertInt = :nombre, DesCerInt = :descripcion, abrevCertInt = :abre WHERE IdCerInt = :idc";

            $arre = [":nombre"=>$nombre, ":descripcion"=>$desc, ":abre"=>$abre, ":idc"=>$idc];

            $this->base->insertar_eliminar_actualizar($querry, $arre);

        }

        //actualiza la certificacion sin el logo
        function actualizarConLogo($idc, $logo, $desc, $nombre, $abre){
            $querry = "UPDATE certinterna SET NomCertInt = :nombre, DesCerInt = :descripcion, abrevCertInt = :abre, LogoCerInt = :logo WHERE IdCerInt = :idc";

            $arre = [":nombre" => $nombre, ":descripcion" => $desc, ":abre" => $abre, ":idc" => $idc, ":logo"=>$logo];
        
            $this->base->insertar_eliminar_actualizar($querry, $arre);
        }

        function addHistorial($idc, $idh, $tipo, $fecha, $precio){

            //consultas para la tabla de historicos
            $qhist = "INSERT INTO historico (Idh, FechaH, PrecioH)
                VALUES(:id, :fecha, :precio)";

            $ahist = [":id" => $idh, ":fecha" => $fecha, ":precio" => $precio];

            //consultas para insertar en la tabla de relacion certh
            $qcert = "INSERT INTO certh (IdCerInt, IdH)
                VALUES(:idc, :idh)";

            $acert = [":idc" => $idc, ":idh" => $idh];

            //consultas para insertar registros en la relacion tipousuahis
            $qusua = "INSERT INTO tipousuahis (IdUsua, IdH) 
                VALUES(:idu, :idh)";

            $ausua = [":idu" => $tipo, ":idh" => $idh];

            $querry = [$qhist, $qcert, $qusua];
            $arre = [$ahist, $acert, $ausua];

            $this->base->insertar_eliminar_actualizar($querry, $arre);
        }

    //busca el recio con la fecha mas reciente de la certificacion que recibe para los usuarios generales
    function buscarUltimoPrecioG($idc){
        //busca todos los registros de esa certificacion
        $querry = "SELECT * FROM certh, historico WHERE (certh.IdCerInt = :id AND certh.IdH = historico.IdH);";

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
        certh.IdH = historico.IdH AND FechaH = :fecha AND historico.IdH = tipousuahis.IdH AND tipousuahis.IdUsua = '5')";
        $arre = [":id" => $idc, ":fecha" => $fecha];

        $resultados = $this->base->mostrar($querry, $arre);

        //busca el ultimo precio de esa fecha (en caso de que hubieran varias modificaciones el mismo día)
        $precio = 0;

        if (count($resultados) >= 1) {
            $precio = strval($resultados[count($resultados) - 1]["PrecioH"]);
        }

        return $precio;
    }

    //busca el recio con la fecha mas reciente de la certificacion que recibe para los usuarios generales
    function buscarUltimoPrecioA($idc){
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
    }

    