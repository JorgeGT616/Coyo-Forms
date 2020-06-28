<?php
  //inicia sesion
  session_start();
  //si se recibe peticion...
  if(isset($_GET['opcion'])){
    ///peticion se guarda en variable
    $Usuario=$_GET['opcion'];
    //su existe sesion
    if((!isset($_SESSION['profesor']))&&(!isset($_SESSION['alumno']))&&(!isset($_SESSION['admin']))){
      //variables para forms
      $Profesor="Profesor";
      $Alumno="Alumno";
      $Otro="Otro";
      $Regresar="Regresar";
      if ($Profesor==$Usuario){//form profe
        echo"<form method='post' action='../dynamics/php/ValidacionSesion.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>Usuario: <input type='text' name='profesor' placeholder='RFC o Correo' pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$|([_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4}))' title='No es un dato valido para inicio de sesion' required></p>
                  <p>Contraseña:<input type='password' name='passProf' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%?¡!&/=+*-]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos @ # $ % ? ¡ ! & / = + * - ' required></p>
                  <input class='send' type='submit' value='Iniciar Sesion'>
              </fieldset>
            </form>";
      }
      if ($Alumno==$Usuario){//form alumno
        echo"<form method='post' action='../dynamics/php/ValidacionSesionAl.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>Usuario: <input type='text' name='alumno' placeholder='N°Cuenta o Correo' pattern='[0-9]{9}|([_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4}))' title='No es un dato valido para inicio de sesion' required></p>
                  <p>Contraseña:<input type='password' name='passAl' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%?¡!&/=+*-]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos @ # $ % ? ¡ ! & / = + * - ' required></p>
                  <input class='send' type='submit' value='Iniciar Sesion'>
              </fieldset>
            </form>";
      }
      if ($Otro==$Usuario){//form pin admin
        echo"<form method='post' action='../dynamics/php/PIN.php'>
              <fieldset>
                <legend><h3>Ingresa el PIN</h3></legend>
                  <p>Codigo: <input type='password' name='PIN' pattern='[cYp01oRE$6@n3&]{20}' title='Inserta el PIN dado por el admin' required></p>
                <input class='send' type='submit' value='Validar'>
              </fieldset>
            </form>";
      }
      if ($Regresar==$Usuario){//if para boton regresar
        echo "";
      }
      if ($Usuario==""){//indica si una sesion no esta abierta
        echo 0;
      }
    }else{
      if ($Usuario==""){//indica si una sesion si esta abierta
        echo 1;
      }
    }
    if(isset($_COOKIE['Invalido'])){//usuario no registrado
      echo 5;
      setcookie("Invalido","",-1);
    }
    if(isset($_COOKIE['Imposible'])){//no fue posible validacion
      echo 6;
      setcookie("Imposible","",-1);
    }
    if(isset($_COOKIE['Exitoso'])){//exito en el registro
      echo 7;
      setcookie("Exitoso","",-1);
    }
  }
?>
