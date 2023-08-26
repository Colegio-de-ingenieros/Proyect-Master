<!-- <script src="../../view/login/js/verificar_permiso_empresa.js"></script> -->
<?php
$id=$_GET['id'];
include_once('../../model/administrativo/Mostrar_Servicios.php');
include_once('../../view/administrativo/Aprobar_Servicio.html');
$base = new Mostrar_Servicio();
$resultado = $base->buscar_headhunter_individual($id);
if ($resultado == true) {
  $nombres = $resultado[0]["NomPerso"];
  $nombreP = $resultado[0]["ApePPerso"];
  $nombreM = $resultado[0]["ApeMPerso"];
  $nombre = $nombres . ' ' . $nombreP . ' ' . $nombreM;
  $correo = $resultado[0]["CorreoPerso"];
  $fecha = $resultado[0]["FechaSer"];
  $telefono = $resultado[0]["TelMPerso"];
  if ($telefono == "" || $telefono == null){
    $telefono = ' - ';
}
 $estatus = $resultado[0]["EstatusSer"];
 if ($estatus == '0') {
  $estatus1 = "En espera";
} else if ($estatus == '1') {
    $estatus1 = "Aprobado";
    } else if ($estatus == '2') {
    $estatus1 = "Rechazado";
    } else if ($estatus == '3') {
      $estatus1 = "Cancelado";
      }
} 
$resultado = $base->buscar_outplacement_individual($id);
if ($resultado == true) {
  $nombres = $resultado[0]["NomPerso"];
  $nombreP = $resultado[0]["ApePPerso"];
  $nombreM = $resultado[0]["ApeMPerso"];
  $nombre = $nombres . ' ' . $nombreP . ' ' . $nombreM;
  $correo = $resultado[0]["CorreoPerso"];
  $fecha = $resultado[0]["FechaSer"];
  $telefono = $resultado[0]["TelMPerso"];
  if ($telefono == "" || $telefono == null){
    $telefono = ' - ';
}
   $estatus = $resultado[0]["EstatusSer"];
   if ($estatus == '0') {
    $estatus1 = "En espera";
  } else if ($estatus == '1') {
      $estatus1 = "Aprobado";
      } else if ($estatus == '2') {
      $estatus1 = "Rechazado";
      } else if ($estatus == '3') {
        $estatus1 = "Cancelado";
        }
  } 
?>

<script>
</script>

<script>
    var parrafo = document.getElementById("nombreOT"); 
  parrafo.innerHTML = "<?php echo $nombre; ?>"; 
  var parrafo = document.getElementById("descri_puestoOT"); 
  parrafo.innerHTML = "<?php echo $telefono; ?>"; 
  var parrafo = document.getElementById("reqi_academicosOT"); 
  parrafo.innerHTML = "<?php echo $correo; ?>"; 
  var parrafo = document.getElementById("reqi_tecnicosuOT"); 
  parrafo.innerHTML = "<?php echo $fecha; ?>"; 
  var parrafo = document.getElementById("estatus"); 
  parrafo.innerHTML = "<?php echo $estatus1; ?>"; 

  
var parrafo = document.createElement("p");
</script>

<script>
    <?php if ($estatus==1 or $estatus==0) { ?>
        
        var textBox = document.getElementById("descri_puesto");
        document.getElementById("ti_ck1").checked = true;
        
    <?php }else if ($estatus==2){ ?>
        document.getElementById("ti_ck2").checked = true;
        var textBox = document.getElementById("descri_puesto");

      <?php }else if ($estatus==3){ ?>
      document.getElementById("ti_ck3").checked = true;
      var textBox = document.getElementById("descri_puesto");
        
    <?php } ?>
    
</script>
