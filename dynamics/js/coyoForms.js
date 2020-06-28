nav = document.getElementsByTagName("nav");//obteniendo nav
fetch("../dynamics/php/coyoForms.php")//peticion
    .then((response) => {
        return response.text();
    })
    .then((text) => {
        console.log(text);
        nav[0].innerHTML = text;//lo que se obtenga se imprime en nav
        if(document.getElementById("cerrarSesion") != undefined){
            let cerrarSesion = document.getElementById("cerrarSesion");
            console.log(cerrarSesion);
            cerrarSesion.addEventListener("click", () => {//agregando eventos a un elemento obtenido por peticion
                fetch("../dynamics/php/coyoForms.php?cerrar=1");
                window.location = "coyoForms.html";
            });
        }
    })
    .catch((error) => {
        console.log(error.message);
    });