<?php
//obtener el id
include_once('../../model/administrativo/Mostrar_Proyectos.php');

    function fecPro($idp){
        $base = new MostrarProyectos();
        $base->instancias();
        $resultado1 = $base->getIniProId($idp);
        $resultado2 = $base->getFinProId($idp);
        $resultado = $base->getProyectosId($idp);
        $nombre = $resultado[0]["NomProyecto"];
        $objetivo = $resultado[0]["ObjPro"];
        $monto = $resultado[0]["MontoPro"];

        $inicio = $resultado1[0]["IniPro"];
        $fin = $resultado2[0]["FinPro"];

        return [$nombre, $objetivo, $monto,$inicio, $fin] ;
    }
    //hace la consulta principal de los datos de los proyectos
    /*function datosPro($idp){
        $base = new MostrarProyectos();
        $base->instancias();
        
        
        
    }}

?>
<script languaje="javascript">
    
    document.getElementById("idp").value = "<?php echo $idp ?>";
    document.getElementById("nom_proyecto").value = "<?php echo $nombre ?>";
    document.getElementById("obj_proyecto").value = "<?php echo $objetivo ?>";
    document.getElementById("monto_proyecto").value = "<?php echo $monto ?>";
</script>
<!--<script type='text/javascript'>

    var fechaI = ''
    var fechaIni= new Date(fechaI);
    var mesI=fechaIni.getMonth()+1;
    var diaI=fechaIni.getDate()+1;
 
    var yearI=fechaIni.getFullYear();
    if(diaI<10)
        diaI='0'+diaI;
    if(mesI<10)
        mesI='0'+mesI;
    
    document.getElementById("ini_proyecto").value =yearI+"-"+mesI+"-"+diaI;

</script>
<script type='text/javascript'>

    var fechaF = '
    var fechaFin= new Date(fechaF);
    console.log('Date in mexico1: ' + fechaFin);
    let formatter = new Intl.DateTimeFormat('en-MEX', { timeZone: "America/Mexico_City" });   
    let usDate = formatter.format(fechaFin);
    console.log('Date in mexico: ' + usDate);

    var diaF=fechaFin.getDate();
    var mesF=fechaFin.getMonth()+1;

    var yearF=fechaFin.getFullYear();
    if(diaF<10)
        diaF='0'+diaF;
   
    if(mesF<10)
        mesF='0'+mesF;
    
    document.getElementById("fin_proyecto").value =yearF+"-"+mesF+"-"+diaF;

</script>-->



<!-- script para poner los valores en los campos correspondientes -->*/

