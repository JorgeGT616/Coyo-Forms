<?php
      $Usuario=$_POST['usuario'];
      $Profesor="Profesor";
      $Alumno="Alumno";
      $Otro="Otro";
      if ($Profesor==$Usuario){
        echo"<form method='post' action='ValidacionAlumno.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>Usuario: <input type='text' name='Usuario' placeholder='RFC o Correo' pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$|([_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4}))' title='No es un dato valido para inicio de sesion' required></p>
                  <p>Contraseña:<input type='password' name='passAl' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos '@', '#', '$' y '%'' required></p>
                  <input class='send' type='submit' value='Iniciar Sesion'>";
      }
      if ($Alumno==$Usuario){
        echo"<form method='post' action='ValidacionAlumno.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>Usuario: <input type='text' name='Usuario' placeholder='N°Cuenta o Correo' pattern='[0-9]{9}|([_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4}))' title='No es un dato valido para inicio de sesion' required></p>
                  <p>Contraseña:<input type='password' name='passAl' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos '@', '#', '$' y '%'' required></p>
                  <input class='send' type='submit' value='Iniciar Sesion'>";
      }
      if ($Otro==$Usuario){
        echo"<form method='post' action='InicioAdmin.php'>
              <fieldset>
                <legend><h3>Ingresa el PIN</h3></legend>
                  <p>Codigo: <input type='password' name='PIN' pattern='[cYp01oRE$6@n3&]{20}' title='Inserta el PIN dado por el admin' required></p>
                <input class='send' type='submit' value='Validar'>";
      }
      echo"</fieldset>"
?>
