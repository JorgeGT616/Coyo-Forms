<?php
define("HASH", "sha256");
define("PASSWORD","Secure password, plz make ec¿veryth!ng s3cUr3");
define("METHOD","aes-128-cbc");
function Descifrar($cifradoWIv){
  $cifradoWIv=base64_decode($cifradoWIv);
  $iv_len= openssl_cipher_iv_length(METHOD);
  $iv= substr($cifradoWIv,0,$iv_len);
  $cifrado = substr($cifradoWIv,$iv_len);
  $key= openssl_digest(PASSWORD,HASH);
  $desciff=openssl_decrypt(
    $cifrado, //Mensaje cifrado a descifrar
    METHOD, //El método acordado para cifrar
    $key, //La contraseña hasheada
    OPENSSL_RAW_DATA, //PAra que nos retorne los valores en un código
    $iv //iv para descifar
  );
  return $desciff;
}
      $PIN=$_POST['PIN'];
      $Clave="95sebUZRCPaCBsTndLDbmyu/7fzHOy27YMpjqg3Xaoxci1suEWRHOhJOVypSWt2m";
      $Pase=Descifrar($Clave);
      //Condicion de si $A igual que $U hara el if
      if ($PIN==$Pase){
        /*Imprimira un formulario que sera enviado por metodo post a ValidacionProfesorCafe.php y que el contenido del formulario sera un fieldset que lo contendra y la leyenda Ingresa, te pedira el RFC, Nombre, Apellido Paterno y Materno,
        Te pedira tambien la fecha de nacimeinto y por medio de un select el profesor seleccionara su Colegio, y por ultimo le pedira una contraseña segura*/
        echo"<form method='post' action='ValidacionProfesor.php'>
          <fieldset>
            <legend><h3>Ingresa tus datos</h3></legend>
              <p>RFC: <input type='text' name='RFC' placeholder='Ejemplo: RLH651213' pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$' title='Esto no es un RFC' required></p>
              <p>Numero de Trabajador: <input type='text' name='NumTrab' placeholder='Ejemplo: 562310'pattern='\d{6}' title='Tiene que contener exactamente 6 digitos' required></p>
              <p>Nombre: <input type='text' name='NombreProf' placeholder='Ejemplo: Carlos' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un nombre, o escribelo sin acentos' required></p>
              <p>Apellido Paterno: <input type='text' name='apPaternoProf' placeholder='Ejemplo: Perez' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un apellido, o escribelo sin acentos' required></p>
              <p>Apellido Materno: <input type='text' name='apMaternoProf' placeholder='Ejemplo: Hernandez' pattern='[a-zA-ZÑñ]{3,20}' title='Este no es un apellido, o escribelo sin acentos' required></p>
              <p>Fecha de Nacimiento: <input type='date' name='nacimiento'></p>
              <p>Correo Electronico: <input type='email' name='mail' placeholder='usuario@correo.com' title='Este no es un formato de correo valido' required></p>
              <p>Contraseña:<input type='password' name='passProf' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%?¡!&/=+*-]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos @ # $ % ? ¡ ! & / = + * - ' required></p>
              <input class='send' type='submit' value='Registrarse'>";
        echo"</fieldset>";
      }
      else{
        echo"Esta no es la contraseña, por favor ingresa la contraseña dada por el admin<br>";
        echo"<a href='../../templates/registrousuario.html'>Regresar</a>";
      }
?>
