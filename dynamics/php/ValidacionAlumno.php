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
$CURP= strtoupper($_POST['CURP']);
$NumCuenta= $_POST['NumCuenta'];
$Nombre= strtoupper($_POST['NombreAl']);
$ApPt= strtoupper($_POST['apPaternoAl']);
$ApMt= strtoupper($_POST['apMaternoAl']);
$Sexo= $_POST['sexo'];
$Nacimiento= $_POST['nacimiento'];
$Mail= $_POST['mail'];
$Status= "No_suspendida";
$Contraseña=$_POST['passAl'];
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
    $IniSexo = $Sexo [0];

    //Declarar las varibles que se van a comparar del RFC que se recibio para compararlos con el nombre y fecha de nacimiento
    $CURP1 = $CURP[0];
    $CURP2 = $CURP[1];
    $CURP3 = $CURP[2];
    $CURP4 = $CURP[3];
    $CURP5 = $CURP[4];
    $CURP6 = $CURP[5];
    $CURP7 = $CURP[6];
    $CURP8 = $CURP[7];
    $CURP9 = $CURP[8];
    $CURP10 = $CURP[9];
    $CURP11 = $CURP[10];
    //Declarar las varibales que tendran los valores de los arrys concatenados
    $Verifica = $LetraAptPat1.$LetraAptPat2.$letraAptMat.$LetraName.$Anio1.$Anio2.$Mes1.$Mes2.$Dia1.$Dia2.$IniSexo;
    $CURPform = $CURP1.$CURP2.$CURP3.$CURP4.$CURP5.$CURP6.$CURP7.$CURP8.$CURP9.$CURP10.$CURP11;
    if($Verifica == $CURPform){
        echo "HOLAA";
        $cons = "SELECT * FROM usuario WHERE Número_de_cuenta_o_trabajador ='$NumCuenta'";
        //Ver si se pudo hacer la consulta con la conexion
        $result = $conexion -> query($cons);
        //Ver si existe un registro en la Base de Datos
        $count= mysqli_num_rows($result);
        //Si existe un registro hara el if
        if($count == 1){
            //si el usuario ya existe se crea cookie existente
            $_COOKIE['Existente'] = 1;
            setcookie("Existente",$_COOKIE['Existente']);
            //Se redireccionara de nuevo al formulario de registro
            header("Location: ../../templates/registrousuario.html");
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
                //Hacer una insercion de los valores que se dijan
                $sql = "INSERT INTO usuario VALUES ('$NumCuenta','$Nombre', '$ApPt', '$ApMt', AES_ENCRYPT('$Mail','password') , '$Sexo', '$Status', AES_ENCRYPT('$CURP','password'), '$Nacimiento', AES_ENCRYPT('$Contraseña','password'), '$Image')";
                //Si se logro la insercion con la conexion hara el if
                if(mysqli_query($conexion, $sql)){
                    //se crea cookie exitoso
                    $_COOKIE['Exitoso'] = 1;
                    setcookie("Exitoso",$_COOKIE['Exitoso']);
                    //Se redireccionara a iniciosesion .html
                    header("Location: ../../templates/iniciosesion.html");
                }
                else{
                    //se crea cookie error
                    $_COOKIE['Error'] = 1;
                    setcookie("Error",$_COOKIE['Error']);
                    //Se redireccionara a registrousuario.html
                    header("Location: ../../templates/registrousuario.html");
                }
            }
            else{
                //se crea cookie errorImg
                $_COOKIE['ErrorImg'] = 1;
                setcookie("ErrorImg",$_COOKIE['ErrorImg']);
                //Se redireccionara a registrousuario.html
                header("Location: ../../templates/registrousuario.html");
                //echo "No se pudo subir la imagen, trate de nuevo, usando los formatos requridos!";
            }
        }
    }else{
        //se crea cookie datosNo
        $_COOKIE['DatosNo'] = 1;
        setcookie("DatosNo",$_COOKIE['DatosNo']);
        //Se redireccionara a registrousuario.html
        header("Location: ../../templates/registrousuario.html");            
        //echo"Tus datos no coinciden, porfavor verificalos<br>";
    }
}         
?>
