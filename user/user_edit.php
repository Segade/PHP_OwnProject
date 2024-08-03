<h3>Datos do usuario</h3>
<?
if(isset($_POST["rdid"])) 	$id = $_POST["rdid"];
else $id = $_SESSION['user_id'];

if(!isset($_POST["alcume"])) {
// non se premeu o boton modificar, polo que entro por 1º vez, amoso o formulario.
$sql = "SELECT * FROM members WHERE id=$id";
$res=mysql_query($sql,$enlace);
$rexistro=mysql_fetch_array($res)
?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=edituser" >
<input type="hidden" name="rdid" value="<?=$id?>">
<table>
<tr> <td> Nome do usuario*: </td><td> <input type="text" name="alcume" title="nome do usuario" value="<?= $rexistro['username']?>" required> </td> </tr>
<tr> <td> E-mail*: </td> <td> <input type="email" name="email" title="email do usuario" value="<?= $rexistro['email']?>" pattern="^([a-zA-Z0-9_-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([a-zA-Z0-9-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$" required> </td> </tr>
<tr> <td> M&oacute;bil/Tlf*: </td> <td><input type="tel" name="mobil" value="<?= $rexistro['phone']?>" title="mobil ou telefono" pattern="^[9|8|7|6]\d{8}$" required> </td> </tr>
<?  
if ($permisos['level']==1){
// so o admin pode modifica-lo tipo de usuario, so amoso o combo co nivel 1.
?>
<tr> <td> Tipo de usuario: </td> <td>
<select name="tipo" title="seleccione o tipo de usuario">
<option value="3" <?if ($rexistro['level']==3) echo "selected";?>>Usuario</option>
<option value="2" <? if ($rexistro['level']==2) echo "selected";?>>Operador</option>
<option value="1" <? if ($rexistro['level']==1) echo "selected";?>>Administrador</option>
</select> </td> </tr>
<? }else{ // else do if de permisos 
	$level = $rexistro['level'];
	echo "<input type=\"hidden\" name=\"tipo\" value=\"$level\">";
} // fin do if de permisos 
?>
</table>
<p>Se non quere troca-la contrasinal, deixe os campos valdeiros.</p>
<table>
<tr> <td> Nova contrasinal: </td> <td> <input type="password" name="password" title="escriba o novo contrasinal"> </td> </tr>
<tr> <td>Repita a contrasinal: </td> <td> <input type="password" name="p2" title="repita a contrasinal"> </td> </tr>
</table>
<div align="right"> <input type="button" value="Modificar" name="modificar" onclick="form_edituser(this.form, this.form.password);"> </div>
</form>
<? 
}else{ // else do if de isset de modificar.
// premeuse o boton modificar, polo que procedo a executa-lo update.
    $username = $_POST["alcume"];
    $email = $_POST["email"];
$phone= $_POST['mobil'];
$level = $_POST['tipo'];
if ($level==1) $tipo = "Administrador";
if ($level == 2) $tipo = "Operador";
if ($level==3) $tipo = "Usuario";

if ($_POST['p']=="") {
// o password esta valdeiro, polo que non modifico o password.

    //Agrega tu inserto a la secuencia de comandos de la base de datos aquí.
    //¡Asegúrate de usar comandos preparados!
    if ($insert_stmt = $mysqli->prepare("UPDATE members SET username=?, email=?, phone=?, level=? WHERE id=?")) {        
       $insert_stmt->bind_param('sssii', $username, $email, $phone, $level, $id);
       //Ejecuta la consulta preparada.
       $insert_stmt->execute();
    }
echo "<h3>Usuario modificado</h3>
<p>O usuario foi modificado corr&eactue;ctamente cos seguintes datos: <br><br>
<b>Nick: </b> $username <br>
<b>Email: </b> $email <br>
<b>M&oacute;bil/Tlf.: </b> $phone <br>
<b>Tipo de usuario: </b> $tipo <br>
<b>Contrasinal: </b> Non modificada
";
}else{ // else do if de password = " " 
// o password ten contido, polo que modifico todo.
    //La contraseña en hash desde la forma
    $password = $_POST['p'];
    //Crea una salt al azar
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    //Crea una contraseña en salt (Cuidado de no pasarte)
    $password = hash('sha512', $password.$random_salt);
    //Agrega tu inserto a la secuencia de comandos de la base de datos aquí.
    //¡Asegúrate de usar comandos preparados!
    if ($insert_stmt = $mysqli->prepare("UPDATE members SET username=?, email=?, password=?, salt=?, phone=?, level=? WHERE id=?")) {        
       $insert_stmt->bind_param('sssssii', $username, $email, $password, $random_salt, $phone, $level, $id);
       //Ejecuta la consulta preparada.
       $insert_stmt->execute();
    }
echo "<h3>Usuario e contrasinal modificados</h3>
<p>Usuario e contrasinal foron modificados corr&eactue;ctamente cos seguintes datos: <br><br>
<b>Nick: </b> $username <br>
<b>Email: </b> $email <br>
<b>M&oacute;bil/Tlf.: </b> $phone <br>
<b>Contrasinal: </b> modificada
";
login($username, $_POST['p'], $mysqli);
} // fin do if de password = " " 



} //fin do if de isset de modificar.
?>