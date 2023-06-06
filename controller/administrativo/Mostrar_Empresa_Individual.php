<?php
$id=$_GET['id'];
include_once('../../model/administrativo/Mostrar_Empresa.php');
include_once('../../view/administrativo/Mostrar_Empresaindividual.html');
$base = new MostrarEmpresa();
$base->instancias();
$rfc_Num = $base->getRFC($id);
$rfc=$rfc_Num[0]["RFCUsuaEmp"];
$resultado = $base->mostrarEmpresa($rfc);
if ($resultado == true) {
    $rfc = $resultado[0]["RFCUsuaEmp"];
    $nom = $resultado[0]["NomUsuaEmp"];
    $calle = $resultado[0]["CalleUsuaEmp"];
    $horaInicio = $resultado[0]["HrIniUsuaEmp"];
    $horaFin = $resultado[0]["HrFinUsuaEmp"];
    $razon = $resultado[0]["RazonUsuaEmp"];
    $correo = $resultado[0]["CorreoUsuaEmp"];
    $acuerdo = $resultado[0]["acuerdoEmp"];
}
if ($acuerdo == 1) {
    $acuerdo = "Si, existe acuerdo.";
} else {
    $acuerdo = "No existe acuerdo.";
}
$resultado = $base->mostrarColonia($rfc);
if ($resultado == true) {
  $col=$resultado[0]["nomcolonia"];
  $cp=$resultado[0]["codpostal"];
  $mun=$resultado[0]["nommunicipio"];
  $edo=$resultado[0]["nomestado"];
}
$resultado = $base->getDias($rfc);
if ($resultado == true) {
  $dias="";
  for ($i = 0; $i < count($resultado); $i++) {
  $dias.=" ".$resultado[$i]["Dia"].",";
  }
}
$dias=trim($dias,",");
$resultado = $base->mostrarAreasRH($rfc);
if ($resultado == true) {
    $nomRH=$resultado[0]["NomEncArea"];
    $apeRH=$resultado[0]["ApePEncArea"];
    $apeMRH=$resultado[0]["ApeMEncArea"];
    $correoRH=$resultado[0]["CorreoEncArea"];
    $telRH=$resultado[0]["TelFEncArea"];
    $extRH=$resultado[0]["ExtenTelFEncArea"];
}else{
    $nomRH = "No registrado";
    $apeRH = "No registrado";
    $apeMRH = "No registrado";
    $correoRH = "No registrado";
    $telRH = "No registrado";
    $extRH = "No registrado";
}
$resultado = $base->mostrarAreasTI($rfc);
if ($resultado == true) {
    $nomTI = $resultado[0]["NomEncArea"];
    $apeTI = $resultado[0]["ApePEncArea"];
    $apeMTI = $resultado[0]["ApeMEncArea"];
    $correoTI = $resultado[0]["CorreoEncArea"];
    $telTI = $resultado[0]["TelFEncArea"];
    $extTI = $resultado[0]["ExtenTelFEncArea"];
}
else{
    $nomTI = "No registrado";
    $apeTI = "No registrado";
    $apeMTI = "No registrado";
    $correoTI = "No registrado";
    $telTI = "No registrado";
    $extTI = "No registrado";
}
$resultado=$base->mostrarAreasCap($rfc);
if ($resultado == true) {
    $nomCap = $resultado[0]["NomEncArea"];
    $apeCap = $resultado[0]["ApePEncArea"];
    $apeMCap = $resultado[0]["ApeMEncArea"];
    $correoCap = $resultado[0]["CorreoEncArea"];
    $telCap = $resultado[0]["TelFEncArea"];
    $extCap = $resultado[0]["ExtenTelFEncArea"];
}
else{
    $nomCap = "No registrado";
    $apeCap = "No registrado";
    $apeMCap = "No registrado";
    $correoCap = "No registrado";
    $telCap = "No registrado";
    $extCap = "No registrado";
}
?>

<script>
</script>
<script>
    var parrafo = document.getElementById("rfcempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $rfc; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("nombrecomercialempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nom; ?>";
  var parrafo = document.getElementById("correoempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $correo; ?>";
  var parrafo = document.getElementById("razonsocialempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $razon; ?>";
  var parrafo = document.getElementById("acuerdoempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $acuerdo; ?>";
</script>
<script>
    var parrafo = document.getElementById("codigopostalempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $cp; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("callenumeroempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $calle; ?>";
  var parrafo = document.getElementById("coloniaempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $col; ?>";
  var parrafo = document.getElementById("ciudadempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $mun; ?>";
  var parrafo = document.getElementById("estadoempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $edo; ?>";
</script>
<script>
    var parrafo = document.getElementById("diaslaboralesempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $dias; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("horainicioempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $horaInicio; ?>";
  var parrafo = document.getElementById("horafinalempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $horaFin; ?>";
</script>
<script>
  var parrafo = document.getElementById("nombrerecursoshumanosempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nomRH; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("apellidoparecursoshumanosempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeRH; ?>";
  var parrafo = document.getElementById("apellidomarecusroshumanosempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeMRH; ?>";
  var parrafo = document.getElementById("telefonorecursoshumanosempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $telRH; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("extensionrecursoshumanosempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $extRH; ?>";
  var parrafo = document.getElementById("correorecursoshumanosempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $correoRH; ?>";
</script>
<script>
  var parrafo = document.getElementById("nomencargadoareatiempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nomTI; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("apellidopaareatiempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeTI; ?>";
  var parrafo = document.getElementById("apellidomaareatiempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeMTI; ?>";
  var parrafo = document.getElementById("numerotelaeratiempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $telTI; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("exyensionareatiempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $extTI; ?>";
  var parrafo = document.getElementById("correoareatiempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $correoTI; ?>";
</script>
<script>
  var parrafo = document.getElementById("nomencragadocapacitacionempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nomCap; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("apellidopacapacitacionempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeCap; ?>";
  var parrafo = document.getElementById("apellidomacapacitacionempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeMCap; ?>";
  var parrafo = document.getElementById("numerotelcapacitacionempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $telCap; ?>"; // modificamos su contenido
  var parrafo = document.getElementById("extencioncapacitacionempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $extCap; ?>";
  var parrafo = document.getElementById("correocapacitacionempresa"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $correoCap; ?>";
</script>