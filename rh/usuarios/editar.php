<?php

require_once("../../conex.php"); 


$nome = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$senha_cript = md5($senha);
$cargo = $_POST['cargo'];
$id = $_POST['id'];
$email_usuario_rec = $_POST['email_usuario_rec'];

//VERIFICAR SE O USUÁRIO JÁ ESTÁ CADASTRADO SOMENTE SE FOR TROCADO O USUÁRIO
if ($email_usuario_rec != $usuario) {
	//Verificar se o utilizador já está registado somente se for alterado o utilizador

	$res_c = $pdo->query("SELECT * from usuarios where usuario = 'usuario' ");
	$dados_c = $res_c->fetchAll(PDO::FETCH_ASSOC);
	$linhas = count($dados_c);

	if ($linhas != 0) {

		echo "Dados de registro duplicados!";
		exit();
	}
}

$res = $pdo->prepare("UPDATE usuarios set nome = :nome, usuario = :usuario, senha = :senha_cript, senha_original = :senha, cargo = :cargo where id = :id ");

$res->bindValue(":nome", $nome);
$res->bindValue(":usuario", $usuario);
$res->bindValue(":senha", $senha);
$res->bindValue(":senha_cript", $senha_cript);
$res->bindValue(":cargo", $cargo);
$res->bindValue(":id", $id);


$res->execute();

echo "Atualizado com sucesso";

?>
