<?php
require_once('../../config/Crud_bd.php');

class Modificar_Instructor extends Crud_bd{

    public function modificarinstructor($nombre,$apellido_p,$apellido_m,$certificacionesExternas,$especialidades,$certificacionesInternas)
    {

    }
    public function mostrarInstructorParaModificacion($id)
    {
        # me da el codigo del instructor y traego sus datos
        //* Extraemos la información individual del instructor 
        $this->conexion_bd();
        $consulta = "SELECT NomIns, ApePIns, ApeMIns 
        FROM instructor 
        WHERE ClaveIns = :id";
        $parametros = [":id"=>$id];
        $resultados_datos_basicos = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones internas del instructor 
        $consulta = "SELECT certinterna.IdCerInt
        from certinterna, inscertint
        WHERE inscertint.ClaveIns = :id
        and inscertint.IdCerInt = certinterna.IdCerInt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_internas = $this->mostrar($consulta,$parametros);

        //* Extraemos las certificaciones externas del instructor
        $consulta = "SELECT certexterna.IdCerExt, certexterna.NomCerExt, certexterna.OrgCerExt, certexterna.IniCerExt, certexterna.FinCerExt
        from certexterna, inscertext
        WHERE inscertext.ClaveIns = :id
        and inscertext.IdCerExt = certexterna.IdCerExt";
        $parametros = [":id"=>$id];
        $resultados_certificaciones_externas = $this->mostrar($consulta,$parametros);

        //* Extraemos las especialidades del instructor
        $consulta = "SELECT especialidades.IdEspIns, especialidades.NomEspIns 
        FROM especialidades, especialins 
        WHERE especialins.ClaveIns = :id 
        AND especialins.IdEspIns = especialidades.IdEspIns";
        $parametros = [":id"=>$id];
        $resultados_especialidades = $this->mostrar($consulta,$parametros);

        //* Juntamos todas las variables en un solo arreglo
        $resultados = [ $resultados_datos_basicos,
                        $resultados_especialidades,
                        $resultados_certificaciones_internas,
                        $resultados_certificaciones_externas
                    ];

        $this->cerrar_conexion();
        //* Retorna el arreglo con toda la información
        return $resultados;

    }
}



?>