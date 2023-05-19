<?php
    require_once("../../model/socio-asociado/Aplicar_Vacante.php");
    session_start();
    if (isset ($_SESSION['usuario'])&& isset($_SESSION['tipo_usuario'])){
        $usuario = $_SESSION['usuario'];
        $tipo_usuario = $_SESSION['tipo_usuario'];

        $objeto = new dato();
        $objeto->BD();
        $datos_personales = $objeto->usuario($tipo_usuario,$usuario);

        $id = $datos_personales[0]['IdPerso'];
        /* $id = 'P0014'; */
        
        $datos_de_lugar = $objeto->lugar($id);
        $datos_de_certificaciones = $objeto->certificaciones($id);
        $datos_auxiliar = array_merge($datos_personales);

        /* Verifica si datos_de_certificaciones está vacio, si está vacio, añade un elemento vacio */
        if (empty($datos_de_certificaciones)) {
            $datos_de_certificaciones[] = ['0' => '', '' => ''];
        }
        /* Extrae los demás datos básicos del CV */
        $datosCv = $objeto->datosCV($id);

        if(empty($datosCv)) {
            echo json_encode('sintemario');
        } 
        else {
            $id_Bol_Cv = $datosCv[0]['IdBolCv'];
            /* Verifica si Residencia es un 1 o un 0, si es un 1 es un no y sobreescribe su valor en el arreglo y viceversa*/
            $residencia = $datosCv[0]['ResidenciaCv'];

            if ($residencia == 1) {
                $datosCv[0][2] = 'No';
            } else {
                $datosCv[0][2] = 'Si';
            }

            $ids_Experiencia_Academica = $objeto->idsExperienciaAcademica($id_Bol_Cv);
            $lista_limpia_ids_Experiencia_Academica = [];
            /* Deja una lista con los puros id's */
            foreach ($ids_Experiencia_Academica as $id_Experiencia_Academica) {
                array_push($lista_limpia_ids_Experiencia_Academica, $id_Experiencia_Academica['IdExpAca']);
            }

            $datos_Experiencia_Academica = [];
            for($i = 0; $i < count($lista_limpia_ids_Experiencia_Academica); $i++) {
                $temp = $objeto->ExperienciasAcademicas($lista_limpia_ids_Experiencia_Academica[$i]);
                $datos_Experiencia_Academica[] = $temp;
            }

            $listado_carreras = [];
            /* Imprime los elementos de datos_experiencia_academica y dales un salto de linea */
            foreach ($datos_Experiencia_Academica as $dato_Experiencia_Academica) {
                $carrera = $dato_Experiencia_Academica[0]['Carrera'];
                $cedula = $dato_Experiencia_Academica[0]['NumCedAca'];
                $lista_auxiliar = [];
                array_push($lista_auxiliar, $carrera, $cedula);
                array_push($listado_carreras, $lista_auxiliar);
            }

            $ids_Experiencia_Profesional = $objeto->idsExperienciaProfesional($id_Bol_Cv);
            $lista_limpia_ids_Experiencia_Profesional = [];
            /* Deja una lista con los puros id's */
            foreach ($ids_Experiencia_Profesional as $id_Experiencia_Profesional) {
                array_push($lista_limpia_ids_Experiencia_Profesional, $id_Experiencia_Profesional['IdExpP']);
            }

            $datos_Experiencia_Profesional = [];

            for($i = 0; $i < count($lista_limpia_ids_Experiencia_Profesional); $i++) {
                $temp = $objeto->ExperienciasProfesionales($lista_limpia_ids_Experiencia_Profesional[$i]);
                $datos_Experiencia_Profesional[] = $temp;
            }

            $listado_trabajos = [];
            /* Imprime los elementos de datos_Experiencia_Profesional y dales un salto de linea */
            foreach ($datos_Experiencia_Profesional as $dato_Experiencia_Profesional) {
                $antiguo_empleo = $dato_Experiencia_Profesional[0]['EmpExpP'];
                $fecha_inicio = $dato_Experiencia_Profesional[0]['IniExpP'];
                $fecha_fin = $dato_Experiencia_Profesional[0]['FinExpP'];
                $puesto_desempenado = $dato_Experiencia_Profesional[0]['PuestoExpP'];
                $Actividades_desempenadas = $dato_Experiencia_Profesional[0]['ActExpP'];
                $lista_auxiliar = [];
                array_push($lista_auxiliar, $antiguo_empleo, $fecha_inicio, $fecha_fin, $puesto_desempenado, $Actividades_desempenadas);
                array_push($listado_trabajos, $lista_auxiliar);
            }

            $datos_temporales = [];
            array_push($datos_temporales, $datos_personales, $datos_de_lugar, $datos_de_certificaciones, $datosCv, $listado_carreras, $listado_trabajos);        
            echo json_encode($datos_temporales);
        }
    }
?>