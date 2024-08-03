
<?php	


	$id=$_POST['rdid'];


mysql_query("DELETE FROM noticias WHERE ID=$id",$enlace);



?>



<h1> Noticia borrada con exito </h1>