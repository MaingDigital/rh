<?php 

require_once("../../conex.php");

$cargo = $_REQUEST['cargo'];



$res = $pdo->query("SELECT * from colaboradores where cargo = '$cargo' order by cargo asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

for ($i=0; $i < count($dados); $i++) { 
	foreach ($dados[$i] as $key => $value) {
	}


	$sub_categorias_post[] = array(
		'nif'	=> $dados[$i]['nif'],
		'nome' => utf8_encode($dados[$i]['nome']),
	);

	
	
}


echo(json_encode($sub_categorias_post));

?>


