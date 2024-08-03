function form_edituser(){
	if (f1.password.value=="" && f1.p2.value==""){
		var p = document.createElement("input");
		f1.appendChild(p);
		p.name = "p";
		p.type = "hidden";
		p.value ="";
		f1.submit();
	}else{ // else do if de password valdeiro
		if (f1.password.value != f1.p2.value){
			alert ("Debe introduci-lo mesmo contrasinal nos 2 cadros de edicion.");
		}else{ // else da repeticion dos contrasinais.
			var p = document.createElement("input");
			f1.appendChild(p);
			p.name = "p";
			p.type = "hidden";
			p.value = hex_sha512(password.value);
			password.value = "";
			f1.submit();
		} // fin do if da repeticion dos contrasinais 
	} // fin do if de password valdeiro

} // fin da funcion form_edituser 