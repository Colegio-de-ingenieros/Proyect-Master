<?php

require_once('../../config/Crud_bd.php');

class Eliminar_Instructor extends Crud_bd{

    
    public function eliminar_instructor($id){
        $this->conexion_bd();

        //* Seleccionamos el estatus del instructor para saber si está con seguimiento o no
        $consulta = "SELECT EstatusIns FROM instructor WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_estatus = $this->mostrar($consulta,$parametros);

        $lista_estatus = array_column($resultados_estatus,'EstatusIns');

        //* Si el estatus es 1, significa que el instructor está sin seguimiento
        if($lista_estatus[0] == "0"){
            return "con";
        }
        else if($lista_estatus[0] == "1"){            
            //* Eliminamos todos los ids de las certificaciones internas del instructor
            $consulta = "DELETE FROM inscertint WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $this->insertar_eliminar_actualizar($consulta,$parametros);

            //* Seleccionamos todos los ids de las especialidades del instructor
            $consulta = "SELECT IdEspIns FROM especialins WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $resultados_id_especialidades = $this->mostrar($consulta,$parametros);

            //* Eliminamos todas las especialidades del instructor
            if(count($resultados_id_especialidades) > 0){

                //* Eliminamos la relación de las especialidades con el instructor
                $consulta = "DELETE FROM especialins WHERE ClaveIns = :id";
                $parametros = [":id"=>$id];
                $this->insertar_eliminar_actualizar($consulta,$parametros);

                $lista_id_especialidades = array_column($resultados_id_especialidades,'IdEspIns');

                for($i = 0; $i < count($lista_id_especialidades); $i++){
                    $consulta = "DELETE FROM especialidades WHERE IdEspIns = :id";
                    $parametros = [":id"=>$lista_id_especialidades[$i]];
                    $this->insertar_eliminar_actualizar($consulta,$parametros);
                }
            }

            //* Seleccionamos todos los ids de las certificaciones externas del instructor
            $consulta = "SELECT IdCerExt FROM inscertext WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $resultados_id_certificaciones_externas = $this->mostrar($consulta,$parametros);
            
            if(count($resultados_id_certificaciones_externas) > 0){
                //* Eliminamos la relación de las certificaciones externas con el instructor
                $consulta = "DELETE FROM inscertext WHERE ClaveIns = :id";
                $parametros = [":id"=>$id];
                $this->insertar_eliminar_actualizar($consulta,$parametros);

                $lista_id_certificaciones_externas = array_column($resultados_id_certificaciones_externas,'IdCerExt');

                //* Eliminamos todas las certificaciones externas del instructor
                for($i = 0; $i < count($lista_id_certificaciones_externas); $i++){
                    $consulta = "DELETE FROM certexterna WHERE IdCerExt = :id";
                    $parametros = [":id"=>$lista_id_certificaciones_externas[$i]];
                    $this->insertar_eliminar_actualizar($consulta,$parametros);
                }
            }

            //* Eliminamos el instructor
            $consulta = "DELETE FROM instructor WHERE ClaveIns = :id";
            $parametros = [":id"=>$id];
            $this->insertar_eliminar_actualizar($consulta,$parametros);
            return "sin";
        }
        $this->cerrar_conexion();
    }

   

}   
/*
$m = new Instructor_model();
$r = $m->insertarinstructor("juan","jose","",[["12","no hay","2023-04-12","2023-04-24"],["13","no hay","2023-04-12","2023-04-24"],["14","no hay","2023-04-12","2023-04-24"]],["uno1","dos1","tres1","cuatro1"],["000001","000002"]);
echo $r;*/
?>