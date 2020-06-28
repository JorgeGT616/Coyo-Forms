function modal (opcion) {/*funcion para modales*/
    fetch(`../dynamics/php/modal.php?opcion=${opcion}`)
    .then((response) => {
        return response.text();
    })
    .then((data) => {
        divModal.innerHTML = data;
        console.log(data);
        /*obteniendo elementos de los modales y aplicandoles eventos*/
        if(document.getElementsByTagName("span") && document.getElementById("afuera")){
            let x = document.getElementsByTagName("span");
            let afuera = document.getElementById("afuera");
            let modal = document.getElementById("modal");
            console.log(x[0]);
            
            /*click en tache para cerrar modal o reidrigir a pagina principal*/
            x[0].addEventListener("click", () => {                
                if(opcion == 1){
                    window.location = "coyoForms.html";
                }else{
                    modal.classList.add("desaparecido");
                    console.log(modal);
                }
            });
            /*click en espacio libre para cerrar modal o reidrigir a pagina principal*/
            window.addEventListener("click",(e) => {
                if(e.target == afuera){
                    if(opcion == 1){
                        window.location = "coyoForms.html";
                    }else{
                        modal.classList.add("desaparecido");
                    }
                }
            });
        }
    });
}
/*funcion para imprimir formularios*/
function inicioSesion (opcion) {
    fetch(`../dynamics/php/sesionusuario.php?opcion=${opcion}`)
    .then((response) => {
        return response.text();
    })
    .then((data) => {
        divInicial.innerHTML = data;
        /*if para detectar uso de modales*/
        if(divInicial.innerHTML == 1){/*sesion iniciada*/
            modal(data);
        }
        else if(divInicial.innerHTML == 5){/*usuario invalido*/
            modal(data);
        }
        else if(divInicial.innerHTML == 6){/*imposible evaluacion*/
            modal(data);
        }
        else if(divInicial.innerHTML == 7){/*registro exitososssss*/
            modal(data);
        }
    });
}

/*Obteniendo elementos del html*/
let laPagina = document.getElementsByTagName("body");
let divModal = document.getElementById("mensaje");
let divInicial = document.getElementById("inicial");
let fTipo = document.getElementById("tipo");
let bProfe = document.getElementById("profesor");
let bAlumno = document.getElementById("alumno");
let bOtro = document.getElementById("otro");
let aRegresar = document.getElementById("regresar");

/*obtener estado de la página inicio de sesion*/
inicioSesion("");

/*fetch para imprimir el form del administrador*/
fetch("../dynamics/php/inicioAdmin.php")
.then((response) => {
    return response.text();
})
.then((data) => {
    if(data != ""){
        divInicial.innerHTML = data;
        divInicial.classList.remove("desaparecido");
        fTipo.classList.add("desaparecido");
        aRegresar.classList.remove("desaparecido");
    }
});

/*Botón tipo profesor*/
bProfe.addEventListener("click", function () {
    inicioSesion(bProfe.innerText);
    divInicial.classList.remove("desaparecido");
    fTipo.classList.add("desaparecido");
    aRegresar.classList.remove("desaparecido");
});
/*Botón tipo alumno*/
bAlumno.addEventListener("click", function () {
    inicioSesion(bAlumno.innerText);
    divInicial.classList.remove("desaparecido");
    fTipo.classList.add("desaparecido");
    aRegresar.classList.remove("desaparecido");
});
/*Botón tipo administrador*/
bOtro.addEventListener("click", function () {
    inicioSesion(bOtro.innerText);
    divInicial.classList.remove("desaparecido");
    fTipo.classList.add("desaparecido");
    aRegresar.classList.remove("desaparecido");
});
/*Botón para regresar al inicio sesión dirigir*/
aRegresar.addEventListener("click", function () {
    inicioSesion(aRegresar.innerText);
    divInicial.classList.add("desaparecido");
    fTipo.classList.remove("desaparecido");
    aRegresar.classList.add("desaparecido");
});
