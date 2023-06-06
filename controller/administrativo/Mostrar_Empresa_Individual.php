<?php
$id=$_GET['id'];
include_once('../../model/empresa/Mostrar_Empresa.php');
include_once('../../view/administrativo/Mostrar_Empresaindividual.html');
$base = new MostrarEmpresa();
$base->instancias();