<?php
      //La variable que sera recibida del formulario de RegistroCafe.html
      $PIN=$_POST['PIN'];
      //Variables de tipo cadena que seran definidas
      $Pase='c0Y0op1n10nE$pR3p@6&';
      //Condicion de si $A igual que $U hara el if
      if ($PIN==$Pase){
        /*Imprimira un formulario que sera enviado por metodo post a ValidacionProfesorCafe.php y que el contenido del formulario sera un fieldset que lo contendra y la leyenda Ingresa, te pedira el RFC, Nombre, Apellido Paterno y Materno,
        Te pedira tambien la fecha de nacimeinto y por medio de un select el profesor seleccionara su Colegio, y por ultimo le pedira una contraseña segura*/
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
      else{
        echo"Esta no es la contraseña, por favor inserte la contraseña dada por el admin";
        echo"<a href='../templates/registrousuario.html'>Regresar</a>";
      }
?>
