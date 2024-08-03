<?
if (!isset ($_POST['alcume'])){
?>
<h3>Creaci&oacute;n dun novo usuario</h3>

   <form action="<?= $_SERVER['PHP_SELF'] ?>?corpo=novouser" method="post" name="form_user">
<table>
       <tr><td>Nick: </td><td> <input type="text" name="alcume" title="alcume do usuario"/> </td></tr>
       <tr><td>Email: </td><td><input type="text" name="email" title="e-mail"/> </td></tr>
       <tr><td>Password: </td><td><input type="password" name="password" id="password" title="chave"/> </td></tr>
</table>
<div align="right"> <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> </div>
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
    //Agrega tu inserto a la secuencia de comandos de la base de datos aquí.
    //¡Asegúrate de usar comandos preparados!
    if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {        
       $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
       //Ejecuta la consulta preparada.
       $insert_stmt->execute();
    }
echo "<h3>Novo usuario creado</h3>
<p>O novo usuario foi creado corr&eactue;ctamente cos seguintes datos: <br><br>
<b>Nick: </b> $username <br>
<b>Email: </b> $email
";


} // fin do if de isset de form_user.
?> 
