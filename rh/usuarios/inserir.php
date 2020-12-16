<?php

require_once("../../conex.php"); 

$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_cript = md5($senha);

//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO
	$res_c = $pdo->query("SELECT * from usuarios where usuario = '$usuario'");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);
	
	if ($nome == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	if ($usuario == '') {
		echo 'Preencha os dados em falta';
		exit();
	}
	if ($senha == '') {
		echo 'Preencha os dados em falta';
		exit();
	} 

	if($linhas == 0){

	$res = $pdo->prepare("INSERT into usuarios (nome, usuario, senha, senha_original, nivel) values (:nome, :usuario, :senha, :senha_original, :nivel) ");

		$res->bindValue(":nome", $nome);
		$res->bindValue(":usuario", $usuario);
		$res->bindValue(":senha", $senha_cript);
		$res->bindValue(":senha_original", $senha);
		$res->bindValue(":nivel", 'Administrador');

		$res->execute();

		//echo "<script language='javascript'>window.alert('Registrado com sucesso!'); </script>";
	echo "Registrado com sucesso";
}else{
	echo "Dados de registro duplicados!";
	
}

?>
