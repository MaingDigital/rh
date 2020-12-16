<?php

require_once("../../conex.php"); 

$colaborador = $_POST['colaborador'];
$titulo = $_POST['titulo'];
$dt_inicio = $_POST['dt_inicio'];
$dt_final = $_POST['dt_final'];
$estado = $_POST['estado'];
$data = $_POST['data'];
$agora = date('Y-m-d');


$res = $pdo->prepare("INSERT into ausencias (colaborador, titulo, dt_inicio, dt_final, estado, data) values (:colaborador, :titulo, :dt_inicio, :dt_final, :estado, :data) ");
$res->bindValue(":colaborador", $colaborador);
$res->bindValue(":titulo", $titulo);
$res->bindValue(":dt_inicio", $dt_inicio);
$res->bindValue(":dt_final", $dt_final);
$res->bindValue(":estado", $estado);
$res->bindValue(":data", $agora);
$res->execute();

		//echo "<script language='javascript'>window.alert('Registrado com sucesso!'); </script>";
	echo "Registrado com sucesso";
	

?>
