<?php 

require_once("conex.php");
@session_start();

if(empty($_POST['usuario']) || empty($_POST['senha'])){
	header("location:index.php");
}

$usuario = $_POST['usuario'];
$senha = md5($_POST['senha']);


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

	if($_SESSION['cargo_usuario'] == 'Administrador'){
		header("location:admin/index.php");
		exit();
	}

	if($_SESSION['cargo_usuario'] == 'Gestor'){
		header("location:rh/index.php");
		exit();
	}

	if($_SESSION['cargo_usuario'] == 'Medico'){
		header("location:md/index.php");
		exit();
	}

	if($_SESSION['cargo_usuario'] == 'Recepcionista'){
		header("location:rc/index.php");
		exit();
	}

	if($_SESSION['cargo_usuario'] == 'Tesoureiro'){
		header("location:ts/index.php");
		exit();
	}

	if($_SESSION['cargo_usuario'] == 'Farmaceutico'){
		header("location:fm/index.php");
		exit();
	}

	if($_SESSION['cargo_usuario'] == 'Tela'){
		header("location:tela.php");
		exit();
	}

	
}else{
	echo "<script language='javascript'>window.alert('Dados Incorretos!!'); </script>";
	echo "<script language='javascript'>window.location='index.php'; </script>";
	
}


 ?>