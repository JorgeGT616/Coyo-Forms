<?php
//inicia sesion
session_start();
//Incluir la base de datos
include("config.php");
//Declarar la base de datos en la que seguardaran los datos ingresados
$conexion = connectDB2("p6_opina");
//Si no se encuentra la conexion
if(!$conexion) {
    //Marcara los errores que hay en la conexion
    echo mysqli_connect_error()."<br>";
    echo mysqli_connect_errno()."<br>";
    //Para salir
    exit();
}else{
    if(isset($_POST['profesor'])){
        $Usuario = $_POST['profesor'];
    }else if(isset($_POST['admin'])){
        $Usuario = $_POST['admin'];
    }
    //La contraseña esta tien de clave hash
    $Password = $_POST['passProf'];
    //se valida que sí exista el profesor

    $cons="SELECT * FROM Usuario WHERE AES_DECRYPT(CURP_o_RFC,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para la contraseña
    $result = $conexion -> query($cons);
    //Ver si existe un registro en la Base de Datos
    $count= mysqli_num_rows($result);
    //Si existe un registro hara el if
    if($count == 1){
        //consulta del nombre usuario
        $consN="SELECT Nombre FROM Usuario WHERE AES_DECRYPT(CURP_o_RFC,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para nombre
        $resultN = $conexion -> query($consN);
        $countN = mysqli_num_rows($resultN);
        if($countN == 1){
            $Nombre= mysqli_fetch_array($resultN);    
            $_SESSION['Usuario'] = $Nombre[0];
        }
        //consulta del numero de trabajador
        $consC="SELECT Número_de_cuenta_o_trabajador FROM Usuario WHERE AES_DECRYPT(CURP_o_RFC,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para nombre
        $resultC = $conexion -> query($consC);
        $countC = mysqli_num_rows($resultC);
        if($countC == 1){
            $NoTrabajdor= mysqli_fetch_array($resultC);    
            $_SESSION['Numero'] = $NoTrabajdor[0];
        }
        //variable del tipo de usuario que está iniciando sesion 
        if(!isset($_POST['admin'])){
            $_SESSION['profesor'] = (isset($_POST['profesor']) && $_POST['profesor'] != null)? $_POST['profesor'] : false;
        }else{
            $_SESSION['admin'] = (isset($_POST['profesor']) && $_POST['profesor'] != null)? $_POST['profesor'] : false;
        }
        header("Location: ../../templates/coyoForms.html");
    }
    //Si el contador fue no fue uno sino 0 hara el elseif
    elseif($count == 0){
        $cons2="SELECT AES_DECRYPT(CURP_o_RFC,'password') FROM Usuario WHERE AES_DECRYPT(Correo_electrónico,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para la contraseña
        $result2 = $conexion -> query($cons2);
        //Ver si existe un registro en la Base de Datos
        $count2= mysqli_num_rows($result2);
        //Si existe un registro hara el if
        if($count2 == 1){
            //consulta del nombre usuario
            $consN="SELECT Nombre FROM Usuario WHERE AES_DECRYPT(Correo_electrónico,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para nombre
            $resultN = $conexion -> query($consN);
            $countN = mysqli_num_rows($resultN);
            if($countN == 1){
                $Nombre= mysqli_fetch_array($resultN);    
                $_SESSION['Usuario'] = $Nombre[0];
            } 
            //consulta del numero de trabajador 
            $consC="SELECT Número_de_cuenta_o_trabajador FROM Usuario WHERE AES_DECRYPT(Correo_electrónico,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para nombre
            $resultC = $conexion -> query($consC);
            $countC = mysqli_num_rows($resultC);
            if($countC == 1){
                $NoTrabajdor= mysqli_fetch_array($resultC);    
                $_SESSION['Numero'] = $NoTrabajdor[0];
            }        
            //variable del tipo de usuario que está iniciando sesion 
            if(!isset($_POST['admin'])){
                $_SESSION['profesor'] = (isset($_POST['profesor']) && $_POST['profesor'] != null)? $_POST['profesor'] : false;
            }else{
                $_SESSION['admin'] = (isset($_POST['profesor']) && $_POST['profesor'] != null)? $_POST['profesor'] : false;
            }
            header("Location: ../../templates/coyoForms.html");
        }elseif($count == 0){
            //si el usuario no existe se crea cookie inválido y se redirige a la página principal
            $_COOKIE['Invalido'] = 1;
            setcookie("Invalido",$_COOKIE['Invalido']);
            header("Location: ../../templates/iniciosesion.html");
        }
    }else{
        //si no fue posible validacion se crea cookie y se redirige a la página principal
        $_COOKIE['Imposible'] = 1;
        setcookie("Imposible",$_COOKIE['Imposible']);
        header("Location: ../../templates/iniciosesion.html");
    }
}
?>