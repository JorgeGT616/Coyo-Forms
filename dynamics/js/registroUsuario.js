function modal (opcion) {//funcion para modales
    fetch(`../dynamics/php/modal.php?opcion=${opcion}`)
    .then((response) => {
        return response.text();
    })
    .then((data) => {
        divModal.innerHTML = data;
        console.log(data);
        //obteniendo elementos de los modales y aplicandoles eventos
        if(document.getElementsByTagName("span") && document.getElementById("afuera")){
            let x = document.getElementsByTagName("span");
            let afuera = document.getElementById("afuera");
            let modal = document.getElementById("modal");
            console.log(x[0]);
            //click en tache para cerrar modal o reidrigir a pagina principal
            x[0].addEventListener("click", () => {
                if(opcion == 1){
                    window.location = "coyoForms.html";
                }else{
                    modal.classList.add("desaparecido");
                }
            });
            //click en espacio libre para cerrar modal o reidrigir a pagina principal
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
//funcion para imprimir formularios
function registroUsuarios (opcion) {
    fetch(`../dynamics/php/formulariousuario.php?opcion=${opcion}`)
    .then((response) => {
        return response.text();
    })
    .then((data) => {
        divInicial.innerHTML = data;
        //if para detectar uso de modales
        if(divInicial.innerHTML == 1){//sesion iniciada
            modal(data);
        }
        if(divInicial.innerHTML == 2){//usuario con datos similares
            modal(data);
        }
        if(divInicial.innerHTML == 3){//no se guarda imagen perfil
            modal(data);
        }
        if(divInicial.innerHTML == 4){//coincidencia erronea de datos
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

//obtener estado de la página registro de usuarios
registroUsuarios("");

/*Botón tipo profesor*/
bProfe.addEventListener("click", function () {
    registroUsuarios(bProfe.innerText);
    divInicial.classList.remove("desaparecido");
    fTipo.classList.add("desaparecido");
    aRegresar.classList.remove("desaparecido");
});
/*Botón tipo alumno*/
bAlumno.addEventListener("click", function () {
    registroUsuarios(bAlumno.innerText);
    divInicial.classList.remove("desaparecido");
    fTipo.classList.add("desaparecido");
    aRegresar.classList.remove("desaparecido");
});
/*Botón para regresar al inicio sesión dirigir*/
aRegresar.addEventListener("click", function () {
    registroUsuarios(aRegresar.innerText);
    divInicial.classList.add("desaparecido");
    fTipo.classList.remove("desaparecido");
    aRegresar.classList.add("desaparecido");
});

/*
function surgeMenu(){
    document.getElementById(Menu).style.display="block";
}
function meteteMenu(){
    document.getElementById(Menu).style.display="none";
}       */