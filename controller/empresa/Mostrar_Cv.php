<?php
$id=$_GET['id'];
include_once('../../model/empresa/Mostrar_Aplicantes.php');
include_once('../..//view/empresa/Mostrar_Cvindividual.html');
//echo $id;
$base = new MostrarAplicantes();
$base->instancias();
$resultado = $base->getAplicante($id);
if ($resultado == true) {
  $identificador=$resultado[0]["IdPerso"];
  $nombre=$resultado[0]["NomPerso"];
  $apeP=$resultado[0]["ApePPerso"];
  $apeM=$resultado[0]["ApeMPerso"];
  $calle=$resultado[0]["CallePerso"];
  $tel=$resultado[0]["TelMPerso"];
  $fecha=$resultado[0]["FechaNacPerso"];
  $correo=$resultado[0]["CorreoPerso"];
  $desc=$resultado[0]["DesProCv"];
  $salEsp=$resultado[0]["ExpSalCv"];
  $cedula=$resultado[0]["NumCedAca"];
  $carrera=$resultado[0]["Carrera"];
  $cambio=$resultado[0]["ResidenciaCv"];
}
if ($cambio==1) {
  $cambio="Si";
}else{
  $cambio="No";
}
$resultado=$base->mostrarColonia($identificador);
if ($resultado == true) {
  $colonia=$resultado[0]["nomcolonia"];
  $municipio=$resultado[0]["nommunicipio"];
  $estado=$resultado[0]["nomestado"];
}
?>

<script languaje="javascript">
  var parrafo = document.getElementById("nombreAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $nombre; ?>"; // modificamos su contenido

  var parrafo = document.getElementById("appelido_paternoAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeP; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("apellido_maternoAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $apeM; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("fecha_nacimientoAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $fecha; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("correo_electroAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $correo; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("telefonoAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $tel; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("calle_numeroAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $calle; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("coloniaAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $colonia; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("ciudadAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $municipio; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("estadoAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $estado; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("cambio_residenciaAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $cambio; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("expe_salarial_brutaAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $salEsp; ?>";
var parrafo = document.createElement("p");

var parrafo = document.getElementById("descripcion_profeAP"); // obtenemos la referencia al elemento
  parrafo.innerHTML = "<?php echo $desc; ?>";
var parrafo = document.createElement("p");


</script>
        <?php $resultado=$base->mostrarAcademica($id);
        if ($resultado == true) {

          for ($i = 0; $i < count($resultado); $i++) {
            $puesto=$resultado[$i]['Carrera'];
            $ced=$resultado[$i]['NumCedAca'];
          echo '<script>// Obtener el elemento div
          var miDiv = document.getElementById("aca");
          var miLabel = document.createElement("label");
          miLabel.textContent = "Nombre de la carrera:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$puesto.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);

          var br = document.createElement("br");
          miDiv.appendChild(br);
          miDiv.appendChild(br);</script>';
          echo '<br>';
          echo '<script>// Obtener el elemento div
          var miDiv = document.getElementById("aca2");
          var miLabel = document.createElement("label");
          miLabel.textContent = "Número de cédula:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$ced.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);

          var br = document.createElement("br");
          miDiv.appendChild(br);
          miDiv.appendChild(br);</script>';
          echo '<br>';}}
      ?>
        <?php $resultado=$base->mostrarLaboral($id);
        if ($resultado == true) {
          $salida='';
          for ($i = 0; $i < count($resultado); $i++) {
          // IdBolCv 	IdExpP 	EmpExpP 	IniExpP 	FinExpP 	PuestoExpP 	ActExpP 	IdExpP 	
          $puesto=$resultado[$i]['PuestoExpP'];
          $empresa=$resultado[$i]['EmpExpP'];
          $inicio=$resultado[$i]['IniExpP'];
          $fin=$resultado[$i]['FinExpP'];
          $act1=$resultado[$i]['ActExpP'];
          $num=$i+1;
          
          echo '<script>// Obtener el elemento div
          var miDiv = document.getElementById("pro");
          var miLabel = document.createElement("label");
          miLabel.textContent = "Puesto que desempeñaba:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$puesto.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);
          var br = document.createElement("br");
          miDiv.appendChild(br);
          var miLabel = document.createElement("label");
          miLabel.textContent = "Periodo de inicio:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$inicio.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);
          var br = document.createElement("br");
          miDiv.appendChild(br);
          var br = document.createElement("br");
          miDiv.appendChild(br);
          var miLabel = document.createElement("label");
          miLabel.textContent = "Actividades relevantes:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$act1.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);
          miDiv.appendChild(br);</script>';

          //echo '<br>';
          echo '<script>// Obtener el elemento div
          var miDiv = document.getElementById("pro2");
          var miLabel = document.createElement("label");
          miLabel.textContent = "Nombre de la empresa:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$empresa.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);

          var br = document.createElement("br");
          miDiv.appendChild(br);
          var miDiv = document.getElementById("pro2");
          var miLabel = document.createElement("label");
          miLabel.textContent = "Periodo de fin:";
          miLabel.classList.add("label-2");
          miDiv.appendChild(miLabel);
          var mip = document.createElement("p");
          mip.textContent = "'.$fin.'";
          mip.classList.add("label-4");
          miDiv.appendChild(mip);

          var br = document.createElement("br");
          miDiv.appendChild(br);
          var br = document.createElement("br");
          miDiv.appendChild(br);
          var br = document.createElement("br");
          miDiv.appendChild(br);
          var br = document.createElement("br");
          miDiv.appendChild(br);

          ;</script>';
          echo '<br>';
        $salida.='<div class="campo">
          <label for="" class="label-2">Experiencia '.$num.'</label><br><br>
          <label for="" class="label-2">Puesto que desempeñaba</label><br><br>
          <label for="" class="label-4">'.$puesto.'</label> <br> <br>
          <label for="" class="label-2">Nombre de la empresa</label><br><br>
          <label for="" class="label-4">'.$empresa.'</label><br><br>
          <label for="" class="label-2">Fecha de inicio</label><br><br>
          <label for="" class="label-4">'.$inicio.'</label><br><br>
          <label for="" class="label-2">Fecha de fin</label><br><br>
          <label for="" class="label-4">'.$fin.'</label><br><br>
          <label for="" class="label-2">Actividades relevantes</label><br><br>
          <label for="" class="label-4">'.$act1.'</label><br><br> 
        </div>';}};
        echo $salida;
        ?> 
      <!-- Certificaciónes -->
      <div class="divisor">
        <p class="subtitulo-1">Certificaciónes</p>
        <hr>
      </div>

      <div class="formulario-certificaciones">
        <!-- Nombre certificación -->
        <?php $resultado=$base->mostrarCertificaciones($identificador);
        if ($resultado == true) {
          $salida='';
          for ($i = 0; $i < count($resultado); $i++) {
          $nomCert=$resultado[$i]['NomCerExt'];
          $inst=$resultado[$i]['OrgCerExt'];  
         $salida.='<div class="campo">
          <label for="" class="label-2">Nombre de la certificación</label><br><br>
          <label for="" class="label-4">'.$nomCert.'</label><br><br> 
          <label for="" class="label-2">Institución emismora</label><br><br>
          <label for="" class="label-4">'.$inst.'</label><br><br> 
        </div>';}}; 
        echo $salida;
        ?>
      </div>

    </section>
  </main>
</body>
<script src="js/Reg_CV.js"></script>
</html>