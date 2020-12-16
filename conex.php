<?php 

require_once("definicoes.php");

$hora_tempo = 'Europe/Lisbon';
	date_default_timezone_set($hora_tempo);

try {
	$pdo = new PDO("mysql:dbname=$banco;host=$host", "$usuario", "$senha");

	//conexao mysql para o backyp
	$conn = mysqli_connect($host, $usuario, $senha, $banco);
} catch (Exception $e) {
	echo "Erro ao conectar com o banco de dados! ".$e;
}


 ?>