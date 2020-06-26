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
//Si encontro la conexion
else {
  //Definir con variables los datos que se reciben del formulario
  $RFC= strtoupper($_POST['RFC']);
  $NumTrab= $_POST['NumTrab'];
  $Nombre= strtoupper($_POST['NombreProf']);
  $ApPt= strtoupper($_POST['apPaternoProf']);
  $ApMt= strtoupper($_POST['apMaternoProf']);
  $Sexo= $_POST['sexo'];
  $Nacimiento= $_POST['nacimiento'];
  $Mail= $_POST['mail'];
  $Status= "No_suspendida";
  $Contraseña=$_POST['passProf'];
  //Declarar en una variable la letra del arreglo que se necesite para poder validar el RFC
  $LetraName= $Nombre[0];
  $LetraAptPat1= $ApPt[0];
  $LetraAptPat2= $ApPt[1];
  $letraAptMat= $ApMt[0];
  $Anio1 = $Nacimiento [2];
  $Anio2 = $Nacimiento [3];
  $Mes1 = $Nacimiento [5];
  $Mes2 = $Nacimiento [6];
  $Dia1 = $Nacimiento [8];
  $Dia2 = $Nacimiento [9];
  //Declarar las varibles que se van a comparar del RFC que se recibio para compararlos con el nombre y fecha de nacimiento
  $RFC1 = $RFC[0];
  $RFC2 = $RFC[1];
  $RFC3 = $RFC[2];
  $RFC4 = $RFC[3];
  $RFC5 = $RFC[4];
  $RFC6 = $RFC[5];
  $RFC7 = $RFC[6];
  $RFC8 = $RFC[7];
  $RFC9 = $RFC[8];
  $RFC10 = $RFC[9];
  //Declarar las varibales que tendran los valores de los arrys concatenados
  $Verifica = $LetraAptPat1.$LetraAptPat2.$letraAptMat.$LetraName.$Anio1.$Anio2.$Mes1.$Mes2.$Dia1.$Dia2;
  $RFCform = $RFC1.$RFC2.$RFC3.$RFC4.$RFC5.$RFC6.$RFC7.$RFC8.$RFC9.$RFC10;
  if($Verifica == $RFCform){
    //La consulta que se realizara para ver si el usuario existe
    $cons = "SELECT * FROM usuario WHERE Número_de_cuenta_o_trabajador='$NumTrab'";
    //Ver si se pudo hacer la consulta con la conexion
    $result = $conexion -> query($cons);
    //Ver si existe un registro en la Base de Datos
    $count= mysqli_num_rows($result);
    //Si existe un registro hara el if
    if($count == 1){
      //Imprimira que el usuario ya existe
      echo "<h1>Registro existente</h1>";
      echo "<h4>NOTA: Si no te has registrado intenta registrando otro correo</h4>";
      //Imprimira un link que te direccionara de nuevo al formulario de registro
      echo"<a href='../../templates/registrousuario.html'>Volver al formulario</a>";
    }
    //Si el contador fue no fue uno sino 0 hara el elseif
    elseif($count == 0){
      $ruta = "../../statics/img/";
      $target_path = $ruta . basename( $_FILES['imagenperfil']['name']);
      if(move_uploaded_file($_FILES['imagenperfil']['tmp_name'], $target_path)) {
          echo "El archivo ".  basename( $_FILES['imagenperfil']['name']).
          " ha sido subido";
          //Variable para guardar el nombre de la imagen
          $Image= basename( $_FILES['imagenperfil']['name']);
      //Hacer una insercion de los valores que se den
      $sql = "INSERT INTO usuario VALUES ('$NumTrab','$Nombre', '$ApPt', '$ApMt', AES_ENCRYPT('$Mail','password') , '$Sexo', '$Status', AES_ENCRYPT('$RFC','password'), '$Nacimiento', AES_ENCRYPT('$Contraseña','password'), '$Image')";
      //Si se logro la insercion con la conexion hara el if
      if(mysqli_query($conexion, $sql)){
        //Imprimira un mensaje de que se registro
        echo "<h1>Registro exitoso</h1>";
        //Lo mandara a la pagina de inicio
        echo "<a href='../../iniciosesion.html'></a>";
      }
     else{
       //Imprimira que hay un error
       echo "<h1>Hubo un problema inentelo mas tarde :(</h1>";
       echo"<a href='../../templates/registrousuario.html'>Volver al formulario</a>";
     }
   }
   else{
     echo "No se pudo subir la imagen, trate de nuevo, usando los formatos requridos!";
   }
  }
  else{
    echo"Tus datos no coinciden, porfavor verificalos<br>";
    echo"<a href='../../templates/registrousuario.html'>Volver al formulario</a>";
  }
  }
}
?>
