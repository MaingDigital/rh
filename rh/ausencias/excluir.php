<?php 

require_once("../../conex.php");

$id = $_POST['id'];


$res = $pdo->prepare("DELETE from ausencias where id = :id ");

$res->bindValue(":id", $id);

$res->execute();

?>