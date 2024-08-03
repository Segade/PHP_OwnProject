<?
if (!isset ($_POST['alcume'])){
?>
<h3>Creaci&oacute;n dun novo usuario</h3>

   <form action="<?= $_SERVER['PHP_SELF'] ?>?corpo=novouser" method="post" name="form_user">
<table>
       <tr><td>Nick: </td><td> <input type="text" name="alcume" title="alcume do usuario"/> </td></tr>
       <tr><td>Email: </td><td><input type="text" name="email" title="e-mail"/> </td></tr>
<tr> <td>M&oacute;bil/Tlf.: </td> <td> <input type="text" name="mobil" title="mobil ou telefono"> </td> </tr>
       <tr><td>Password: </td><td><input type="password" name="password" id="password" title="chave"/> </td></tr>
<tr><td> Tipo de usuario: </td> <td>
<select name="tipo" title="seleccione o tipo de usuario">
<option value="3">Usuario</option>
<option value="2">Operador</option>
<option value="1">Administrador</option>
</select> </td> </tr>
</table>
<div align="right"> <input type="button" value="Crear usuario" onclick="formhash(this.form, this.form.password);" /> </div>
    </form>
<?
}else{ // else do if de isset form_user.
    //La contraseña en hash desde la forma
    $password = $_POST['p'];
    //Crea una salt al azar
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    //Crea una contraseña en salt (Cuidado de no pasarte)
    $password = hash('sha512', $password.$random_salt);
    $username = $_POST["alcume"];
    $email = $_POST["email"];
$phone = $_POST['mobil'];
$level = $_POST['tipo'];
if ($level==1) $tipo = "Administrador";
if ($level == 2) $tipo = "Operador";
if ($level==3) $tipo = "Usuario";
    //Agrega tu inserto a la secuencia de comandos de la base de datos aquí.
    //¡Asegúrate de usar comandos preparados!
    if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt, phone, level) VALUES (?, ?, ?, ?, ?, ?)")) {        
       $insert_stmt->bind_param('sssssi', $username, $email, $password, $random_salt, $phone, $level);
       //Ejecuta la consulta preparada.
       $insert_stmt->execute();
    }
echo "<h3>Novo usuario creado</h3>
<p>O novo usuario foi creado corr&eactue;ctamente cos seguintes datos: <br><br>
<b>Nick: </b> $username <br>
<b>Email: </b> $email <br>
<b>M&oacute;bil/Tlf: </b> $phone <br>
<b>Tipo de usuario: </b> $tipo
";


} // fin do if de isset de form_user.
?> 