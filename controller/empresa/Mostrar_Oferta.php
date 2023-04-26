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
echo $sid;
?>
<script languaje="javascript">
    var parrafo = document.getElementById("nombreOT"); // obtenemos la referencia al elemento
parrafo.innerHTML = "<?php echo $nombre; ?>"; // modificamos su contenido
</script>
