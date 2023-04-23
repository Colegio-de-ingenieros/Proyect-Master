<?php
    include('../../config/Crud_bd.php');

    class mostrarCursos extends Crud_bd{

        public function usuario($correo){
            $this->conexion_bd();
            
            $consulta = "SELECT IdPerso FROM usuaperso WHERE binary(CorreoPerso) =  binary(:user)";
            $parametros = [":user"=>$correo];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function usuario_id($id){
            $this->conexion_bd();
            
            $consulta = "SELECT IdCurPerso FROM persoaltacur WHERE binary(IdPerso) =  binary(:user)";
            $parametros = [":user"=>$id];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function tabla_completa($id_curso){
            $this->conexion_bd();
            
            $consulta = "SELECT altacursos.IdCurPerso, NomCurPerso, HraCurPerso,DocCurPerso, OrgCurPerso FROM altacursos, persoaltacur WHERE persoaltacur.IdCurPerso=altacursos.IdCurPerso and persoaltacur.IdPerso = :user";
            $parametros = [":user"=>$id_curso];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }

        public function inteligente($id_curso, $busqueda){
            $this->conexion_bd();
            
            $consulta = "SELECT altacursos.IdCurPerso, NomCurPerso, HraCurPerso, DocCurPerso, OrgCurPerso FROM altacursos, persoaltacur WHERE persoaltacur.IdCurPerso=altacursos.IdCurPerso and persoaltacur.IdPerso = :user and 
            (NomCurPerso LIKE :busqueda or HraCurPerso LIKE :busqueda or OrgCurPerso LIKE :busqueda)";
            $parametros = [":user"=>$id_curso, ":busqueda"=>$busqueda];
            $datos = $this->mostrar($consulta,$parametros);
            $this->cerrar_conexion();
            return $datos;
        }
    }
?>