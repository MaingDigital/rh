<?php

require_once("../../conex.php"); 


$entrada = $_POST['entrada'];
$entrada = date('H:i:s', strtotime($entrada));
$saida = $_POST['saida'];
$saida = date('H:i:s', strtotime($saida));


//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO
	$res_c = $pdo->query("SELECT * from turnos where entrada = '$entrada'");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($entrada == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	if ($saida == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	

	if($linhas == 0){

	$res = $pdo->prepare("INSERT into turnos (entrada, saida) values (:entrada, :saida) ");

		$res->bindValue(":entrada", $entrada);
		$res->bindValue(":saida", $saida);
		$res->execute();

		//echo "<script language='javascript'>window.alert('Registrado com sucesso!'); </script>";
	echo "Registrado com sucesso";
	exit();
}else{
	echo "Dados de registro duplicados!";
	
}

?>
