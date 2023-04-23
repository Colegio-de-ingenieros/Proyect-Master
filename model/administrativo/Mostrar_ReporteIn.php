<?php
require_once ('../../config/Crud_bd.php');

class Reportes_in extends Crud_bd{

    public function buscarCertificaciones()
    {
        # buscamos Certificaciones
        $this->conexion_bd();
        $sql = "SELECT seguimiento.IdSeg, NomCertInt, segcertint.IdCerInt FROM certinterna,segcertint,seguimiento
                WHERE certinterna.IdCerInt = segcertint.IdCerInt AND
                seguimiento.IdSeg = segcertint.IdSeg";
        $datos = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;

    
    }
    public function buscarCursos()
    {
        # buscamos Cursos
        $this->conexion_bd();
        $sql = "SELECT seguimiento.IdSeg, NomCur, segcursos.ClaveCur FROM cursos,segcursos,seguimiento
                WHERE seguimiento.IdSeg = segcursos.IdSeg AND
                cursos.ClaveCur = segcursos.ClaveCur";
        $datos = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;

    
    }
    public function buscarProyectos()
    {
        # buscamos Proyectos
        $this->conexion_bd();
        $sql = "SELECT seguimiento.IdSeg, NomProyecto, segproyectos.IdPro FROM proyectos, segproyectos, seguimiento
                WHERE seguimiento.IdSeg = segproyectos.IdSeg
                AND	proyectos.IdPro = segproyectos.IdPro";
        $datos = $this->mostrar($sql);
        $this->cerrar_conexion();

        return $datos;

    
    }

}






?>