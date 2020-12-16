<?php 

require_once("conex.php");
@session_start();

if(empty($_POST['senha1'])){
	echo '<script type="text/javascript">alert("'.$senha1.'")</script>';
	echo "<script language='javascript'>window.location='bloquear.php'; </script>";
}

@$usuario1 = $_POST['usuario'];
@$senha1 = md5($_POST['senha']);


$res = $pdo->prepare("SELECT * from usuarios where usuario = :usuario and senha = :senha ");

$res->bindValue(":usuario", $usuario);
$res->bindValue(":senha", $senha);
$res->execute();

$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);



if($linhas > 0){
	$_SESSION['nome_usuario'] = $dados[0]['nome'];
	$_SESSION['email_usuario'] = $dados[0]['usuario'];
	$_SESSION['cargo_usuario'] = $dados[0]['cargo'];

	if($_SESSION['senha_usuario'] == 'senha'){
		header("location:rh/index.php");
		exit();
	}

}else{
	echo "<script language='javascript'>window.alert('Dados Incorretos!!'); </script>";
	echo "<script language='javascript'>window.location='bloquear.php'; </script>";
	
}


 ?>