<h3> Formulario para engadir un resultado a un evento </h3>
<? $id=$_POST['rdid']; ?>
<form name="f1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>?corpo=operaresult" >

<input type="hidden" name="id_evento" value="<?= $evento ?>">
<input type="hidden" name="inscribe">
<table cellspacing="2" cellpadding="2">
<tr> <td align="left"> Competici&oacute;n:	<input type="text" name="competicion[]" title="competicion" autofocus required ></td> </tr>
<tr> <td align="left"> Ligaz&oacute;n: <input type="text" name="ligazon[]" title="ligazon" size="50" required></td> </tr>
<tr> <td colspan="2"> <a href="#" id="mascampos">M&aacute;is campos</a> </td></tr>
<tr> <td align="right" colspan="2"> 	<input type="submit" value="Engadir" name="enviar">
	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	<input type="Reset" value="Borrar datos">
</td> </tr>
</table>
</form>

	<script>
	jQuery.fn.generaNuevosCampos = function(etiqueta, nombreCampo, indice){
		$(this).each(function(){
			elem = $(this);
			elem.data("etiqueta",etiqueta);
			elem.data("nombreCampo",nombreCampo);
			elem.data("indice",indice);
			
			elem.click(function(e){
				e.preventDefault();
				elem = $(this);
				etiqueta = elem.data("etiqueta");
				nombreCampo = elem.data("nombreCampo");
				indice = elem.data("indice");
				texto_insertar = '<tr><td>Competici&oacute;n ' + indice + ': <input type="text" name="competicion[]" title="competicion ' + indice + '" required/></td><td>Ligaz&oacute;n ' + indice +': <input type="text" name="ligazon[]" title="ligazon ' + indice + '" size="50" required/></td></tr>';
				indice ++;
				elem.data("indice",indice);
				nuevo_campo = $(texto_insertar);
				elem.before(nuevo_campo);
			});
		});
		return this;
	}
	$(document).ready(function(){
		$("#mascampos").generaNuevosCampos("Compra", "compra", 2);
	});
	</script>