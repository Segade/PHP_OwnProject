
<?php	


	$id=$_POST['rdid'];


mysql_query("DELETE FROM resultados WHERE ID=$id",$enlace);



?>



<h1> Resultado borrado con exito </h1>