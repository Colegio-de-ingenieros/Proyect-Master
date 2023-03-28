<?php
	include_once('../../model/Reg_Cursos.php');
	// Leemos el arreglo enviado desde JavaScript
	$arreglo = json_decode($_POST["arrayin"]);

	// Leemos la lista 1 enviada desde JavaScript
	$lista1 = json_decode($_POST["lista"]);

	$obj = new NuevoCurso();
	$obj->conexion();

	$identificador=$arreglo[0];

	$existe=$obj->esta($identificador);

	if($existe){
		echo "La clave existe actualmente en la base de datos";
	}
	else{
		$obj->insertar($arreglo);
		$longi=[];

		for ($i=0;$i<count($lista1);$i++){
			array_push($longi,$lista1[$i]);
		}

		$incres=$obj->idsub();
		$incres=$incres[0][0];
		$incres++;
		
		/* echo $incres; */

		$incre=$obj->idtema();
		$incre=$incre[0][0];
		$incre = $incre+$incres;
		$incre++;
		/* echo $incre; */
		$tema = [];

		for($i=0;$i<count($lista1);$i++){
			$obj->insertarTema($incre,$lista1[$i][0]);
			array_push($tema,$incre);
			$incre++;
		}

		/* echo "Datos insertados correctamente"; */
		
		for($i=0;$i<count($tema);$i++){
			$obj->curtem($arreglo[0],$tema[$i]);
		}

		/* echo "Datos insertados correctamente"; */

		for($i=0;$i<count($lista1);$i++){
			if ($longi[$i] > 1){
				for($j=1;$j<count($lista1[$i]);$j++){
					$obj->insertarSub($incres,$lista1[$i][$j]);
					$obj->temsub($tema[$i],$incres);
					$incres = $incres+1;
				}
			}
		}
		/* echo "Datos insertados correctamente"; */

		/* echo "Datos insertados correctamente"; */

		/* manda alerta de que el registro se completo */

		echo "Registro completado";

	}


?>