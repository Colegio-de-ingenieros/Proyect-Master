<?php
    require_once("../../model/socio-asociado/Aplicar_Vacante.php");
    session_start();
    if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];

        $objeto = new dato();
        $objeto->BD();
        $datos_personales = $objeto->usuario($tipo_usuario,$usuario);

        $id = $datos_personales[0]['IdPerso'];
        
        $datos_de_lugar = $objeto->lugar($id);
        $datos_de_certificaciones = $objeto->certificaciones($id);
        $datos_auxiliar = array_merge($datos_personales,$datos_de_lugar);

        /* Extrae los demás datos básicos del CV */
        $datosCv = $objeto->datosCV($id);
        $id_Bol_Cv = $datosCv[0]['IdBolCv'];

        /* Verifica si Residencia es un 1 o un 0, si es un 1 es un no y sobreescribe su valor en el arreglo y viceversa*/
        $residencia = $datosCv[0]['ResidenciaCv'];

        if ($residencia == 1) {
            $datosCv[0][2] = 'No';
        } else {
            $datosCv[0][2] = 'Si';
        }

        $ids_Experiencia_Academcica = $objeto->idsExperienciaAcademica($id_Bol_Cv);
        $datos_Experiencia_Academica = [];

        foreach ($ids_Experiencia_Academcica as $id_Experiencia_Academica) {
            $id_Experiencia_Academica = $id_Experiencia_Academica['IdExpAca'];
            $datos_Experiencia_Academica[] = $objeto->ExperienciasAcademicas($id_Experiencia_Academica);
        }

        $ids_Experiencia_Profesional = $objeto->idsExperienciaProfesional($id_Bol_Cv);
        $datos_Experiencia_Profesional = [];

        foreach ($ids_Experiencia_Profesional as $id_Experiencia_Profesional) {
            $id_Experiencia_Profesional = $id_Experiencia_Profesional['IdExpP'];
            $datos_Experiencia_Profesional[] = $objeto->ExperienciasProfesionales($id_Experiencia_Profesional);
        }

        /* Almacena todos los datos en una sola matriz */
        $datos = array_merge($datos_auxiliar, $datos_de_certificaciones, $datosCv, $datos_Experiencia_Academica, $datos_Experiencia_Profesional);

        header("Content-Type: application/json");
        echo json_encode($datos);
    }
?>