<?php
    include('../../config/Crud_bd.php');

    class Cursos extends Crud_bd{
        public function agregar_ceros($numero, $lon){
            $ceros = "";
            $numero_nuevo="";
            for ($i=0; $i < $lon ; $i++) { 
                $numero_nuevo = $ceros .$numero;
                if(strlen($numero_nuevo) == $lon){
                    break;
                }else{
                    $ceros = $ceros . "0";
                }
    
            }
            return $numero_nuevo;
        }

        public function id_cursos(){
            $this->conexion_bd();

            $sql = "SELECT Count(IdCurPerso) FROM altacursos";
            $arreglo = $this->mostrar($sql);
            $this->cerrar_conexion();
        
            $numero = "";
            if(is_null($arreglo[0][0]) == 1){
                $numero = 1;
                
            }else{
                $numero = $arreglo[0][0];
                $numero++;
                
            }

            $idCurso = $this->agregar_ceros($numero, 6);
        
            return $idCurso;
        }

        public function usuario($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function insertar_cursos($id_curso, $nombre, $organizacion, $horas, $archivo, $id_perso){
            $this->conexion_bd();

            //consultas para la tabla de usuaperso
            $q1 = "INSERT INTO altacursos (IdCurPerso, NomCurPerso, HraCurPerso, DocCurPerso, OrgCurPerso) 
            VALUES (:idCurso, :nomCurso, :hraCurso, :docCurso, :orgCurso)";

            $a1 = [":idCurso"=>$id_curso, ":nomCurso"=>$nombre, ":hraCurso"=>$horas, ":docCurso"=>$archivo, ":orgCurso"=>$organizacion];

            //consultas para la tabla de usuaperso
            $q2 = "INSERT INTO persoaltacur (IdPerso ,IdCurPerso) 
            VALUES (:idPerso, :idCurso)";

            $a2 = [":idPerso"=>$id_perso, ":idCurso"=>$id_curso];

            $querry = [$q1, $q2];
            $parametros = [$a1, $a2];
            //acomoda todo en arreglos para mandarlos al CRUD

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;
        }

/*
        public function insertar_relacion($id_persona){
            $this->conexion_bd();
            $idcurso=$this->id_curso($id_curso2);

            //consultas para la tabla de usuaperso
            $q1 = "INSERT INTO persoaltacur (IdPerso ,IdCurPerso) 
            VALUES (:idPerso, :idCurso)";

            $a1 = [":idPerso"=>$id_persona, ":idCurso"=>$idcurso];

            $querry = [$q1];
            $parametros = [$a1];
            //acomoda todo en arreglos para mandarlos al CRUD

            $ejecucion = $this->insertar_eliminar_actualizar($querry, $parametros);
            return $ejecucion;
        }*/
    }
    ?>