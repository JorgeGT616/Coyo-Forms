<?php
//inicia sesion
  session_start();
  //si se recibe la variable opcion...
  if(isset($_GET['opcion'])){
    //se almacena la opcion recibida del fetch
    $Usuario=$_GET['opcion'];
    //si no existe una sesion se imprimen los formularios para que se registre cada tipo de usuario
    if((!isset($_SESSION['profesor']))&&(!isset($_SESSION['alumno']))&&(!isset($_SESSION['PIN']))){
      $Profesor="Profesor";
      $Alumno="Alumno";
      /*$Otro="Otro";*/
      $Regresar="Regresar";
      if ($Profesor==$Usuario){//profe
        echo"<form method='post' action='../dynamics/php/ValidacionProfesor.php' enctype='multipart/form-data'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>RFC:<br><input type='text' name='RFC' placeholder='RLH651213' pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$' title='Esto no es un RFC' required></p>
                  <p>Numero de Trabajador:<br><input type='text' name='NumTrab' placeholder='562310'pattern='\d{6}' title='Tiene que contener exactamente 6 digitos' required></p>
                  <p>Nombre:<br><input type='text' name='NombreProf' placeholder='Carlos' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un nombre' required></p>
                  <p>Apellido Paterno:<br><input type='text' name='apPaternoProf' placeholder='Perez' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un apellido, prueba quitandole los acentos' required></p>
                  <p>Apellido Materno:<br><input type='text' name='apMaternoProf' placeholder='Hernandez' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un apellido, prueba quitandole los acentos' required></p>
                  <p> Sexo:<br><input type='radio' name='sexo' value='M' required> Mujer <input type='radio' name='sexo' value='H'> Hombre </p>
                  <p>Fecha de Nacimiento:<br><input type='date' name='nacimiento'></p>
                  <p>Correo Electronico:<br><input type='email' name='mail' placeholder='usuario@correo.com' title='Este no es un formato de correo valido' required></p>
                  <p>Inserta tu foto de perfil:<br><input class='imagenEspecial' type='file' name='imagenperfil' accept='image/png, .jpeg, .jpg' required><br></p>
                  <p>Contraseña:<br><input type='password' name='passProf' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%?¡!&/=+*-]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos @ # $ % ? ¡ ! & / = + * - ' required></p>
                  <input class='send enviar' type='submit' value='Registrarse'>
              </fieldset>
            </form>";
      }
      if ($Alumno==$Usuario){//alumno
        echo"<form method='post' action='../dynamics/php/ValidacionAlumno.php' enctype='multipart/form-data'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>CURP:<br><input type='text' name='CURP' placeholder='BADD110313HCMLNS09' pattern='[A-Z]{4}[0-9]{6}[H||M]{1}[A-Z]{5}[A-Z0-9]{1}[0-9]{1}' title='Esto no es una CURP' required></p>
                  <p>Numero de Cuenta:<br><input type='text' name='NumCuenta' placeholder='319141887' pattern='([0-9]{9})' title='Tiene que contener exactamente 9 digitos y con los numeros iniciales validos' required></p>
                  <p>Nombre:<br><input type='text' name='NombreAl' placeholder='Carlos' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un nombre' required></p>
                  <p>Apellido Paterno:<br><input type='text' name='apPaternoAl' placeholder='Perez' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un apellido, prueba quitandole los acentos' required></p>
                  <p>Apellido Materno:<br><input type='text' name='apMaternoAl' placeholder='Hernandez' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un apellido, prueba quitandole los acentos' required></p>
                  <p> Sexo:<br><input type='radio' name='sexo' value='Mujer'> Mujer <input type='radio' name='sexo' value='Hombre'> Hombre </p>
                  <p>Fecha de Nacimiento:<br><input type='date' name='nacimiento' required></p>
                  <p>Correo Electronico:<br><input type='email' name='mail' placeholder='usuario@correo.com' title='Este no es un formato de correo valido' required></p>
                  <p>Inserta tu foto de perfil:<br><input type='file' name='imagenperfil'accept='image/png, .jpeg, .jpg' required></p>
                  <p>Contraseña:<br><input type='password' name='passAl' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos @ # $ % ? ¡ ! & / = + * - ' required></p>
                  <input class='send enviar' type='submit' value='Registrarse'>
              </fieldset>
            </form>";
      }
      if ($Regresar==$Usuario){//if para el botón regresar
        echo "";
      }
      if ($Usuario==""){//indica que no existe una sesion
        echo 0;
      }
    }else{
      if ($Usuario==""){//indica que sí existe una sesion
        echo 1;
      }
    }

    if(isset($_COOKIE['Error'])){//error en insercion a base
      echo 2;
      setcookie("Error","",-1);
    }
    if(isset($_COOKIE['ErrorImg'])){//error en guardar foto perfil en carpeta
      echo 3;
      setcookie("ErrorImg","",-1);    
    }
    if(isset($_COOKIE['DatosNo'])){//error en coincidencia con curp o rfc
      echo 4;
      setcookie("DatosNo","",-1);
    }
  }    
?>
