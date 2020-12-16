<?php 

require_once("../../conex.php");
@session_start();

$id = $_POST['id'];

$email_usuario = $_SESSION['email_usuario'];

//BUSCAR O CPF DO USUÁRIO LOGADO (NESSE CASO UM TESOUREIRO)
$res_excluir = $pdo->query("SELECT * from colaboradores where email = '$email_usuario'");
$dados_excluir = $res_excluir->fetchAll(PDO::FETCH_ASSOC);
$func= $dados_excluir[0]['nif'];


$pdo->query("UPDATE pagamentos set estado = 'Aprovado'  where id = '$id' ");
//BUSCAR O VALOR DA CONSULTA FEITA

$res_valor = $pdo->query("SELECT * from pagamentos where id = '$id'");
$dados_valor  = $res_valor ->fetchAll(PDO::FETCH_ASSOC);
$salario = $dados_valor [0]['salario'];
$id = $dados_valor [0]['id'];

$length = 4;
$str = '1234567890';
  
$teste = substr(str_shuffle($str), 0, $length);


$res = $pdo->prepare("INSERT into movimentacoes (tipo, movimento, valor, tesoureiro, data, id_movimento) values (:tipo, :movimento, :valor, :tesoureiro, curDate(), :id_movimento)");

$res->bindValue(":tipo", 'Saída');
$res->bindValue(":movimento", 'Pagamento Salario');
$res->bindValue(":valor", $salario);
$res->bindValue(":tesoureiro", $func);
$res->bindValue(":id_movimento", $teste);
$res->execute();


echo "Editado com Sucesso!!";

?>