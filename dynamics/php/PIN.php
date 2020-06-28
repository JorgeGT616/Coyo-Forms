<?php
//constantes para desencriptar
define("HASH", "sha256");
define("PASSWORD","Secure password, plz make ec¿veryth!ng s3cUr3");
define("METHOD","aes-128-cbc");

//funcion para decifrar
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

  $PIN=$_POST['PIN'];//se recibe el pin ingresado
  $Clave="95sebUZRCPaCBsTndLDbmyu/7fzHOy27YMpjqg3Xaoxci1suEWRHOhJOVypSWt2m";//pin encriptado
  //c0Y0op1n10nE$pR3p@6&  <= PIN!!
  $Pase=Descifrar($Clave);//pin desencriptado
  if ($PIN==$Pase){
    //si coincide se crea cookie con valor 1
    $_COOKIE['Pase'] = 1;
    setcookie("Pase",$_COOKIE['Pase']);
  }else{
    //si no se crea cookie con valor 0
    $_COOKIE['Pase'] = 0;
    setcookie("Pase",$_COOKIE['Pase']);
  }
  header("Location: ../../templates/iniciosesion.html");
?>
