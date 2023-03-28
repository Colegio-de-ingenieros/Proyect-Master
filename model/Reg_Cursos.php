<?php
    include('../../config/Crud_bd.php');

    class NuevoCurso{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function verificar_existencia($clave_curso){
            $query = "SELECT ClaveCur FROM cursos WHERE ClaveCur = '$clave_curso'";
            $resultado = $this->base->mostrar($query);
            return $resultado;
        }

        function insertar($arreglo){
            $q1 = "INSERT INTO cursos (ClaveCur,NomCur,ObjCur,DuracionCur) 
            VALUES(:ClaveCur, :NomCur, :ObjCur, :DuracionCur)";
            $a1= [":ClaveCur"=>$arreglo[0], ":NomCur"=>$arreglo[1], ":ObjCur"=>$arreglo[2], ":DuracionCur"=>$arreglo[3]];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertarTema($arreglo,$lista1){
            $q1 = "INSERT INTO temas (IdTema,NomTema)
            VALUES(:IdTema, :NomTema)";
            $a1= [":IdTema"=>$arreglo, ":NomTema"=>$lista1];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertarSub($arreglo,$lista2){
            $q1 = "INSERT INTO subtemas (IdSubT,NomSubT)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo, ":NomSubT"=>$lista2];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function curtem($arreglo,$lista2){
            $q1 = "INSERT INTO cursotema (ClaveCur,IdTema)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo, ":NomSubT"=>$lista2];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function temsub($arreglo,$lista2){
            $q1 = "INSERT INTO temassub (IdTema,IdSubT)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo, ":NomSubT"=>$lista2];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
        function idtema(){
            $querry = "SELECT Max(CAST(IdTema as int)) FROM temas ";
            $resultados = $this->base->mostrar($querry);
    
            return $resultados;
        }


        function idsub(){
            $querry = "SELECT Max(CAST(IdSubT as int)) FROM subtemas";
            $resultados = $this->base->mostrar($querry);
    
            return $resultados;
        }     
        function esta($identificador){
            $querry ="SELECT ClaveCur FROM cursos where ClaveCur = $identificador";
            $resultados = $this->base->mostrar($querry);
    
            return $resultados;
        }           
        }
?>