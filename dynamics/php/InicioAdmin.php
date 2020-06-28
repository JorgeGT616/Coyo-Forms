<?php
//cookie creada al ingresar pin correcto
    if(!isset($_COOKIE['Peticion'])){
        $_COOKIE['Peticion'] = 0;
        setcookie("Peticion",$_COOKIE['Peticion']);
    }
    //cookie pase tambien indica que si es un admin
    if (isset($_COOKIE['Pase'])){
        $_COOKIE['Peticion']++;
        setcookie("Peticion",$_COOKIE['Peticion']);
        $paseAdmin = $_COOKIE['Pase'];
        if($_COOKIE['Peticion'] == 1){
            if($paseAdmin == 1){
                //si la cookie existente es igual a 1 se imprime form
                echo"<form method='post' action='../dynamics/php/ValidacionSesion.php'>
                        <fieldset>
                        <legend><h3>Ingresa tus datos</h3></legend>
                            <p>Usuario: <input type='text' name='admin' placeholder='RFC o Correo'S pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$|([_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4}))' title='No es un dato valido para inicio de sesion' required></p>
                            <p>Contraseña:<input type='password' name='passProf' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos '@', '#', '$' y '%'' required></p>
                            <input class='send' type='submit' value='Iniciar Sesion'>
                        </fieldset>
                    </form>";
            }elseif($paseAdmin == 0){
                //si no se imprime el siguiente mensaje
                echo"Esta no es la contraseña, por favor inserte la contraseña dada por el admin";
            }
        }else{
            //se matan las cookies pase y peticion
            setcookie("Pase","",-1);
            setcookie("Peticion","",-1);
        }
    }else{
        echo null;
    }
?>