<?php
/* recibir id */
$id = $_GET['id'];
/* echo $id;
echo "hola"; */


include_once('../../model/Ver_Cursos.php');

$respuesta = '';
$bd = new VerCurso();
$bd->BD();
/* mostrar los datos */
$datos = $bd->cursos_disponibles($id);
$datost = $bd->temas($id);
$datoss = $bd->subtemas($id);

    for ($i = 0; $i < count($datos); $i++) {
        //obtiene los valores de la tupla actual de cada uno de los campos y los guarda como variables
        $clave = $datos[$i]["ClaveCur"];
        $nombre = $datos[$i]["NomCur"];
        $duracion = $datos[$i]["DuracionCur"]; 
        $objetivo = $datos[$i]["ObjCur"];   
        $estatus = $datos[$i]["EstatusCur"];  
}

/* echo $clave;
echo $nombre;
echo $duracion;
echo $objetivo;
echo $estatus; */

$respuesta .='
<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f1f1f1;
			color: #333;
			margin: 0;
			padding: 0;
            text-align: center;
		}
		
		header {
			background-color: #273544;
			color: #fff;
			padding: 20px;
			text-align: center;
		}
		
		h1 {
			margin: 0;
		}
		
		main {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			background-color: #fff;
			box-shadow: 0 2px 4px rgba(0,0,0,0.2);
		}
		
		section {
			margin-bottom: 40px;
			border-bottom: 1px solid #ccc;
			padding-bottom: 20px;
		}
		
		h2 {
			font-size: 24px;
			margin: 0 0 10px 0;
		}
		
		p, ul, ol {
			margin: 0 0 10px 0;
			line-height: 1.5;
		}
		
		ul, ol {
			padding-left: 20px;
		}
		
		li {
			margin-left: 10px;
		}
		
		footer {
			background-color: #333;
			color: #fff;
			padding: 20px;
			text-align: center;
		}
		
		footer p {
			margin: 0;
		}
	</style>
<body>
	<header>
		<h1>'. $nombre .'</h1>
        <h1>'. $clave .'</h1>
	</header>
	<main>
		<section>
			<h2>Objetivo</h2>
			<p>'. $objetivo .'</p>
		</section>
		<section>
			<h2>Duración</h2>
            <h1>'. $duracion .' hrs</h1>
		</section>
		<section>
			<h2>Estatus</h2>
            <h1>'. $estatus.'</h1>
		</section>
		<section>
			<h2>Temas</h2>
			<p>';
            if ($datoss){
            for ($i = 0; $i < count($datost); $i++) {
                $tem = $datost[$i]["NomTema"];
                $respuesta .= $tem . '<br>';
            
            }
        }else{
            $respuesta .= 'No hay temas';
        }
            $respuesta .=    '</p>
		</section>
		<section>
			<h2>Subtemas</h2>
			<p>';
            if ($datoss){
            for ($i = 0; $i < count($datoss); $i++) {
                $sub = $datoss[$i]["NomSubT"];
                $respuesta .= $sub . '<br>';
            
            }
        }else{
            $respuesta .= 'No hay subtemas';
        }
            $respuesta .=   '</p>
		</section>
	</main>
	<footer>
		<p>Curso ofrecido por el CISCIG</p>
	</footer>
</body>
';
echo $respuesta;
?>