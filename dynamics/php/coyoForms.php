<?php
//inicio sesion
session_start();
//si la sesion existe
if(isset($_SESSION['profesor']) || isset($_SESSION['alumno']) || isset($_SESSION['admin'])){
    //se guarda el tipo usuario
    if(isset($_SESSION['profesor'])){
        $tipoUsuario = "Profesor";
    }elseif(isset($_SESSION['alumno'])){
        $tipoUsuario = "Alumno";
    }elseif(isset($_SESSION['admin'])){
        $tipoUsuario = "Admin";
    }
    //y se imprime un nav
    echo "<ul>
                <li><a href='generaencu.html'>Crear encuesta</a></li>
                <li><a href='../dynamics/php/resoluencuesta.php'>Contestar encuesta</a></li>
                <li><a href='miPerfil.html'>Mi perfil</a></li>
                <li><a href='#' id='cerrarSesion'>Cerrar sesión</a></li>
            </ul>";
}else{
    //si no existe se imprime otro nav
    echo "  <ul>
                <li><a href='../dynamics/php/resoluencuesta.php'>Contestar encuesta</a></li>
                <li><a href='registrousuario.html'>Registrate</a></li>
                <li><a href='iniciosesion.html'>Ingresar</a></li>
            </ul>";
}
//si un usuario inicio sesion se imprime su nombre y su numero de trabajador o de cuenta
if(isset($_SESSION['Usuario']) && isset($_SESSION['Numero'])){
    echo "<h1>Bienvenid@ ".$_SESSION['Usuario']." mi numero es ".$_SESSION['Numero']." y soy un ".$tipoUsuario."</h1>";
}
//cerrar sesion
if(isset($_GET['cerrar'])){               
    session_unset();                       
    session_destroy();
}
//Mata cookies innecesarias
if(isset($_COOKIE['Pase'])){
    setcookie("Pase","",-1);
}
if(isset($_COOKIE['Peticion'])){
    setcookie("Peticion","",-1);
}
?>