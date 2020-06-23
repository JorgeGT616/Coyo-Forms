<?php
      $Usuario=$_POST['usuario'];
      $Profesor="Profesor";
      $Alumno="Alumno";
      $Otro="Otro";
      if ($Profesor==$Usuario){
        echo"<form method='post' action='ValidacionProfesor.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>RFC: <input type='text' name='RFC' placeholder='Ejemplo: RLH651213' pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$' title='Esto no es un RFC' required></p>
                  <p>Numero de Trabajador: <input type='text' name='NumTrab' placeholder='Ejemplo: 562310'pattern='\d{6}' title='Tiene que contener exactamente 6 digitos' required></p>
                  <p>Nombre: <input type='text' name='NombreProf' placeholder='Ejemplo: Carlos' pattern='[a-zA-ZÁÉÍÓÚÑáéíóúñ]{3,20}' title='Este no es un nombre' required></p>
                  <p>Apellido Paterno: <input type='text' name='apPaternoProf' placeholder='Ejemplo: Perez' pattern='[a-zA-ZÁÉÍÓÚÑáéíóúñ]{3,20}' title='Este no es un apellido' required></p>
                  <p>Apellido Materno: <input type='text' name='apMaternoProf' placeholder='Ejemplo: Hernandez' pattern='[a-zA-ZÁÉÍÓÚÑáéíóúñ]{3,20}' title='Este no es un apellido' required></p>
                  <p>Fecha de Nacimiento: <input type='date' name='nacimiento'></p>
                  <p>Correo Electronico: <input type='email' name='mail' placeholder='usuario@correo.com' title='Este no es un formato de correo valido' required></p>
                  <p>Contraseña:<input type='password' name='passProf' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%?¡!&/=+*-]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos @ # $ % ? ¡ ! & / = + * - ' required></p>
                  <input class='send' type='submit' value='Registrarse'>";
      }
      if ($Alumno==$Usuario){
        echo"<form method='post' action='ValidacionAlumno.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>CURP: <input type='text' name='CURP' placeholder='BADD110313HCMLNS09' pattern='[A-Z]{4}[0-9]{6}[H||M]{1}[A-Z]{5}[A-Z0-9]{1}[0-9]{1}' title='Esto no es una CURP' required></p>
                  <p>Numero de Cuenta: <input type='text' name='NumCuenta' placeholder='Ejemplo: 319141887' pattern='([0-9]{9})' title='Tiene que contener exactamente 9 digitos y con los numeros iniciales validos' required></p>
                  <p>Nombre: <input type='text' name='NombreAl' placeholder='Ejemplo: Carlos' pattern='[a-zA-ZÁÉÍÓÚÑáéíóúñ]{3,20}' title='Este no es un nombre' required></p>
                  <p>Apellido Paterno: <input type='text' name='apPaternoAl' placeholder='Ejemplo: Perez' pattern='[a-zA-ZÁÉÍÓÚÑáéíóúñ]{3,20}' title='Este no es un apellido' required></p>
                  <p>Apellido Materno: <input type='text' name='apMaternoAl' placeholder='Ejemplo: Hernandez' pattern='[a-zA-ZÁÉÍÓÚÑáéíóúñ]{3,20}' title='Este no es un apellido' required></p>
                  <p> Sexo: <input type='radio' name='sexo' value='Mujer'> Mujer <input type='radio' name='sexo' value='Hombre'> Hombre </p>
                  <p>Fecha de Nacimiento: <input type='date' name='nacimiento' required></p>
                  <p>Correo Electronico: <input type='email' name='mail' placeholder='usuario@correo.com' title='Este no es un formato de correo valido' required></p>
                  <p>Contraseña:<input type='password' name='passAl' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos '@', '#', '$' y '%'' required></p>
                  <input class='send' type='submit' value='Registrarse'>";
      }
      if ($Otro==$Usuario){
        echo"<form method='post' action='RegistroAdmin.php'>
              <fieldset>
                <legend><h3>Ingresa el PIN</h3></legend>
                  <p>Codigo: <input type='password' name='PIN' pattern='[cYp01oRE$6@n3&]{20}' title='Inserta el PIN dado por el admin' required></p>
                <input class='send' type='submit' value='Validar'>";
      }
      echo"</fieldset>"
?>
