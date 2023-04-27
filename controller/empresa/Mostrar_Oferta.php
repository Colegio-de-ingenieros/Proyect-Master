<!-- <script src="../../view/login/js/verificar_permiso_empresa.js"></script> -->
<?php
$id=$_GET['id'];
include_once('../../model/empresa/Mostrar_Ofertas.php');
include_once('../..//view/empresa/Mostrar_Ofertaindivi.html');
$base = new MostrarOfertas();
$base->instancias();
$resultado = $base->mostrarOferta($id);
if ($resultado == true) {
  $sid = $resultado[0]["IdEmpBol"];
  $nombre = $resultado[0]["VacEmpBol"];
  $req = $resultado[0]["ReqAcaEmpBol"];
  $reqtec = $resultado[0]["ReqTecEmpBol"];
  $desc = $resultado[0]["DesEmpBol"];
  $bruto = $resultado[0]["SalBrutoEmpBol"];
  $mens = $resultado[0]["SalNetoEmpBol"];
  $hin = $resultado[0]["HrIniEmpBol"];
  $hfin = $resultado[0]["HrFinEmpBol"];
  $calle = $resultado[0]["CalleEmpBol"];
  $exp = $resultado[0]["AñoEmpBol"];
  $tel = $resultado[0]["TelEmpBol"];
  $cor= $resultado[0]["CorreoEmpBol"];
}
$resultado = $base->mostrarJornada($id);
if ($resultado == true) {
  $jor=$resultado[0]["TipoJor"];
}
$resultado = $base->mostrarModalidad($id);
if ($resultado == true) {
  $mod=$resultado[0]["TipoMod"];
}
$resultado = $base->mostrarColonia($id);
if ($resultado == true) {
  $col=$resultado[0]["nomcolonia"];
  $cp=$resultado[0]["codpostal"];
  $mun=$resultado[0]["nommunicipio"];
  $edo=$resultado[0]["nomestado"];
}
$resultado = $base->getDias($id);
if ($resultado == true) {
  $dias="";
  for ($i = 0; $i < count($resultado); $i++) {
  $dias.=" ".$resultado[$i]["Dia"].",";

  }
}
$dias=trim($dias,",");
?>
<script languaje="javascript">
    var parrafo = document.getElementById("nombreOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nombre; ?>"; // modificamos su contenido

  var parrafo = document.getElementById("expOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $exp; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("reqi_academicosOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $req; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("reqi_tecnicosuOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $reqtec; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("descri_puestoOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $desc; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("dias_laboralesOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $dias; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("modalidadOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $mod; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("jornada_labOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $jor; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("horariosOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $hin." - ".$hfin; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("salario_bruto_mensualOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $bruto; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("salario_neto_mensualOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $mens; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("telefonoOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $tel; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("correo_electronicoOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $cor; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("codigo_postalOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $cp; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("calle_numeroOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $calle; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("coloniaOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $col; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("ciudadOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $mun; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("estadoOT"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $edo; ?>";
var parrafo = document.createElement("p");


</script>
