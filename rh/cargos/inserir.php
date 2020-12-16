<?php

require_once("../../conex.php"); 

$cargo = $_POST['cargo'];


//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO
	$res_c = $pdo->query("SELECT * from cargos where cargo = '$cargo'");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($cargo == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	

	if($linhas == 0){

	$res = $pdo->prepare("INSERT into cargos (cargo) values (:cargo) ");

		$res->bindValue(":cargo", $cargo);

		$res->execute();

		//echo "<script language='javascript'>window.alert('Registrado com sucesso!'); </script>";
	echo "Registrado com sucesso";
	exit();
}else{
	echo "Dados de registro duplicados!";
	
}

?>
