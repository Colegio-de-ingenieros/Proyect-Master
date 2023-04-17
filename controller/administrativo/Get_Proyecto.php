<?php
//obtener el id
$idp = $_GET["idp"];

//llamar a los otros archivos que se ocupan
include_once('../../model/Mostrar_Proyectos.php');
include_once('../../view/administrativo/Modi_Proyectos.html');

//instancias la clase para buscar y traer los datos
$base = new MostrarProyectos();
$base->instancias();
$resultado = $base->getProyectosId($idp);
$resultado1 = $base->getIniProId($idp);
$resultado2 = $base->getFinProId($idp);

//guardar los datos en variables
$nombre = $resultado[0]["NomProyecto"];

$inicio = $resultado1[0]["IniPro"];
$fin = $resultado2[0]["FinPro"];
$objetivo = $resultado[0]["ObjPro"];
$monto = $resultado[0]["MontoPro"];


?>


<!-- script para poner los valores en los campos correspondientes -->
<script languaje="javascript">
    var fecha = "2023/01/25";
    var fechaIni= new Date(fecha);
    var mesI=fechaIni.getMonth()+1;
    var diaI=fechaIni.getDate();
    var yearI=fechaIni.getFullYear();
    if(diaI<10)
        diaI='0'+diaI;
    if(mesI<10)
        mesI='0'+mesI;

    var fechaFin= new Date(<?php $fin?>);
    var mesF=fechaFin.getMonth()+1;
    var diaF=fechaFin.getDate();
    var yearF=fechaFin.getFullYear();
    if(diaF<10)
        diaF='0'+diaF;
    if(mesF<10)
        mesF='0'+mesF;
    document.getElementById("idp").value = "<?php echo $idp ?>";
    document.getElementById("nom_proyecto").value = "<?php echo $nombre ?>";
    document.getElementById("ini_proyecto").value =yearI+"-"+mesI+"-"+diaI;
    document.getElementById("fin_proyecto").value = <?php $yearF+"-"+$mesF+"-"+$mesF ?>;
    document.getElementById("obj_proyecto").value = "<?php echo $mes ?>";
    document.getElementById("monto_proyecto").value = "<?php echo $monto ?>";
</script>