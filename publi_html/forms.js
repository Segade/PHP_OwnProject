
    function formhash(form, password) {
       //Crea una entrada de elemento nuevo, esta estar� fuera del campo de contrase�a con algoritmo hash.
       var p = document.createElement("input");
       //Agrega el elemento nuevo a nuestro formulario.
       form.appendChild(p);
       p.name = "p";
       p.type = "hidden"
       p.value = hex_sha512(password.value);
       //Aseg�rate de que la contrase�a en texto simple no sea enviada.
    password.value = "";
       //Finalmente env�a el formulario.
    form.submit();
    }
