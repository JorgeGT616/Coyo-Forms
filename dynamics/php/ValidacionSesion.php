<?php
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
}
else
{
  $Usuario = $_POST['Usuario'];
  //La contraseña esta tien de clave hash
  $Password = $_POST['passProf'];

  $cons="SELECT * FROM Usuario WHERE AES_DECRYPT(CURP_o_RFC,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para la contraseña
  $result = $conexion -> query($cons);
   //Ver si existe un registro en la Base de Datos
   $count= mysqli_num_rows($result);
   //Si existe un registro hara el if
   if($count == 1){
       //Imprimira que el usuario ya existe
       echo "<h3>Bienvenido</h3><br>";
   }
   //Si el contador fue no fue uno sino 0 hara el elseif
   elseif($count == 0){
     $cons2="SELECT AES_DECRYPT(CURP_o_RFC,'password') FROM Usuario WHERE AES_DECRYPT(Correo_electrónico,'password')= '$Usuario' AND AES_DECRYPT(Contraseña,'password')= '$Password'"; //consulta para la contraseña
     $result2 = $conexion -> query($cons2);
      //Ver si existe un registro en la Base de Datos
      $count2= mysqli_num_rows($result2);
      //Si existe un registro hara el if
      if($count2 == 1){
          //Imprimira que el usuario ya existe
          echo "<h1>Bienvenido</h1><br>";
      }
      elseif($count == 0){
         echo "<h1>Usuario invalido, primero debes registrate</h1>";
         //Lo mandara a la pagina de inicio
         echo "<a href='../../templates/registrousuario.html'>Registrarse</a><br>";
         echo "<a href='../../templates/iniciosesion.html'>Volver a Inicio Sesion</a>";
       }
     }
  else{
    echo"No pudimos validar tu informacion intentalo mas tarde";
    echo "<a href='../../templates/registrousuario.html'>Registrarse</a>";
  }
}
?>
