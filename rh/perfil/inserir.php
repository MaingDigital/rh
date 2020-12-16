<?php

require_once("../../conex.php");


if(isset($_POST['upload'])){
		$nif = $_POST['nif'];
		$filename = $_FILES['foto']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['foto']['tmp_name'], '../img/'.$filename);	
		}
		
		$sql = "UPDATE employees SET foto = '$filename' WHERE nif = '$nif'";
		
	?>
