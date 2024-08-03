<h3> Formulario de inscrici&oacute;n </h3>
<? $id=$_POST['rdid']; ?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operainscri" >

<input type="hidden" name="id_evento" value="<? echo "$evento" ?>">
<input type="hidden" name="inscribe">
<table cellspacing="2" cellpadding="2">
<tr> <td align="left"> Nome:</td> <td align="left">
	<input type="text" name="nome" title="nome" autofocus >
</td> </tr>
<tr> <td align="left"> Apelidos:</td> <td align="left">
	<input type="text" name="apelidos" title="apelidos" size="50" >
</td> </tr>
<tr> <td align="left"> DNI/NIE :</td> <td align="left">
	<input type="text" namE="dni" title="DNI-NIE" size="15" >
</td> </tr>
<tr> <td align="left"> Sexo:</td> <td align="left">
<select name="sexo" title="seleccione o seu sexo">
<option value="0">---</option>
<option value="Home">Home</option>
<option value="Muller">Muller</option>
</select>
</td> </tr>
<tr> <td align="left"> Data de Nacemento::</td> <td align="left">
<select name="dia" title="data de nacemento dia"> 		<option value="Dia">Dia</option>
<? for($x=1;$x<32;$x++){
if ($x < 10) $x = "0" . $x ;
 echo"<option value=$x>$x</option>"; 
}?>
</select>
 &nbsp; / &nbsp;
<select name="mes" title="mes"> 
<option value="Mes">Mes</option>
<option value="01">Xaneiro</option>
<option value="02">Febreiro</option>
<option value="03">Marzo</option>
<option value="04">Abril</option>
<option value="05">Maio</option>
<option value="06">Xu&ntilde;o</option>
<option value="07">Xullo</option>
<option value="08">Agosto</option>
<option value="09">Setembro</option>
<option value="10">Outubro</option>
<option value="11">Novembro</option>
<option value="12">Decembro</option>
</select>
 &nbsp; / &nbsp;
<select name="ano" title="ano" onchange="seleccateg()"> <option value="Ano">Ano</option>
 <? for($x=2016;$x>1929;$x--) 
echo"<option value=$x>$x</option>"; ?>
</select>
</td> </tr>
<tr> <td align="left"> E-mail:</td> <td align="left">
	<input type="email" name="correo" title="e-mail" size="35" >
</td> </tr>
<tr> <td align="left"> M&oacute;bil:</td> <td align="left">
	<input type="tel" name="mobil" title="mobil" size="15" pattern="[0-9]{9}" >
</td> </tr>
<tr> <td align="left"> Enderezo:</td> <td align="left">
	<input type="text" name="enderezo" title="enderezo" size="50" >
<tr> <td align="left"> C&oacute;digo postal:</td> <td align="left">
	<input type="tel" name="postal" title="codigo postal" size="8" pattern="[0-9]{5}" >
</td> </tr>
</td> </tr>
<tr> <td align="left"> Provincia:</td> <td align="left">

	<input type="text" name="provincia" title="provincia" size="30" >

</td> </tr>
<tr> <td align="left"> Localidade:</td> <td align="left">
	<input type="text" name="localidade" title="localidade" size="30" >
</td> </tr>
<tr> <td align="left"> Licencia:</td> <td align="left">
	<input type="text" name="licencia" title="licencia" size="15" >
</td> </tr>
<tr> <td align="left"> Club:</td> <td align="left">
	<input type="text" name="club" title="club" size="25" >
</td> </tr>
<tr> <td colspan="2" align="left"> <br> <br> <br> 
<input type ="checkbox" name="acepto" value="si" title="Aceptacion do regulamento" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Acepto o regulamento.
</td></tr>
<tr> <td> &nbsp; </td> <td> &nbsp; </td> </tr>
<tr> <td> &nbsp; </td> <td align="right">
	<input type="submit" value="Inscribirse" name="enviar">
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	<input type="Reset" value="Borrar datos">
</td> </tr>
</table>
</form>