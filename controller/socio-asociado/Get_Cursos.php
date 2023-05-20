<?php
session_start();
if (isset ($_SESSION['usuario']  )&& isset($_SESSION['tipo_usuario'])){
    $usuario = $_SESSION['usuario'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    //obtener el id
    $idc = $_GET["idc"];

    //llamar a los otros archivos que se ocupan
    include_once('../../model/socio-asociado/Mostrar_Cursos.php');
    include_once('../../view/socio-asociado/Modi_Cursos.html');

    //instancias la clase para buscar y traer los datos
    $base = new mostrarCursos();
    $resultado=$base->getCursosId($idc);
    $id_perso=$base->usuario($usuario);
    $idperso=$id_perso[0]['IdPerso'];
    $id_final=$idperso;

    //guardar los datos en variables
    $nombre = $resultado[0]["NomCurPerso"];
    $hra = $resultado[0]["HraCurPerso"];
    $org = $resultado[0]["OrgCurPerso"];
}
    ?>


    <!-- script para poner los valores en los campos correspondientes -->
    <script languaje="javascript">
        document.getElementById("idc").value = "<?php echo $idc ?>";
        document.getElementById("nombre").value = "<?php echo $nombre ?>";
        document.getElementById("organizacion").value = "<?php echo $org ?>";
        document.getElementById("totalhoras").value = "<?php echo $hra ?>";
        document.getElementById("archivo").setAttribute('href', ('../../controller/Comprobantes/<?php echo $id_final ?>'));
    </script>
