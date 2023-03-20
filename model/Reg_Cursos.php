<?php
    include('../../config/Crud_bd.php');

    class NuevoCurso{
        private $base;

        function conexion(){
            $this->base = new Crud_bd();
            $this->base->conexion_bd();
        }

        function insertar($arreglo){
            $q1 = "INSERT INTO cursos (ClaveCur,NomCur,ObjCur,DuracionCur) 
            VALUES(:ClaveCur, :NomCur, :ObjCur, :DuracionCur)";
            $a1= [":ClaveCur"=>$arreglo[0], ":NomCur"=>$arreglo[1], ":ObjCur"=>$arreglo[2], ":DuracionCur"=>$arreglo[3]];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

         function insertarTema($arreglo,$lista1,$conta){
            $q1 = "INSERT INTO temas (IdTema,NomTema)
            VALUES(:IdTema, :NomTema)";
            $a1= [":IdTema"=>$arreglo[0], ":NomTema"=>$lista1[$conta]];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }

        function insertarSub($arreglo,$lista2,$conta1){
            $q1 = "INSERT INTO subtemas (IdSubT,NomSubT)
            VALUES(:IdSubT, :NomSubT)";
            $a1= [":IdSubT"=>$arreglo[0], ":NomSubT"=>$lista2[$conta1]];
            $querry = [$q1];
            $parametros = [$a1];

            $this->base->insertar_eliminar_actualizar($querry, $parametros);
        }
    }
?>