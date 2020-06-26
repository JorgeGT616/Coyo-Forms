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
        echo"<form method='post' action='ValidacionSesion.php'>
              <fieldset>
                <legend><h3>Ingresa tus datos</h3></legend>
                  <p>Usuario: <input type='text' name='Usuario' placeholder='RFC o Correo' pattern='^([A-ZÑ\x26]{4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$|([_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4}))' title='No es un dato valido para inicio de sesion' required></p>
                  <p>Contraseña:<input type='password' name='passAl' placeholder='Minimo 10 caracteres' pattern='[A-Za-z0-9@#$%]{10,25}' title='Una contraseña segura tiene uns longitud entre 10 y 25 caracteres, tiene almenos una letra mayúscula o minúscula, un dígito, o los símbolos '@', '#', '$' y '%'' required></p>
                  <input class='send' type='submit' value='Iniciar Sesion'>";
      }
      else{
        echo"Esta no es la contraseña, por favor inserte la contraseña dada por el admin";
        echo"<a href='../templates/registrousuario.html'>Regresar</a>";
      }
?>
