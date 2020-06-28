<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel='stylesheet' href='../../statics/css/generaencu.css'>
    <link rel='stylesheet' href='../../statics/css/resuelveEncuesta.css'>
    <title>Responder Encuesta |  Coyo-Forms</title>
  </head>
  <body>
  <header>
      <nav> <!-- Barra de navegación  -->
        <div class="unirseEncuesta">
          <p>Unirse a una Encuesta</p>
        </div>
        <div class="iS">
          <a href="../../templates/iniciosesion.html">
          <div class="iniciarSesion">
            <p>Iniciar Sesión</p>
          </div>
          </a>
        </div>
      </nav>
    </header>
    <?php
     /* echo "
      <head>
        <link rel='stylesheet' href='../../statics/css/generaencu.css'>
      </head>";*/
      //Inclusión del archivo de coniguración
      include "config.php";
      //Realización de la conexión
      $conexion = connect();
      connectDB1($conexion, $base);
      connectDB2($base);
      session_start();
      if(isset($_SESSION['Numero'])){
        $usuarioTemp = ($_SESSION['Numero']);
        //Verifica que exista un código de encuesta
        if(isset($_POST['codEncu']))
        {
          $existeEncu = false;
          //Al tener el código de la encuesta, se realiza la consulta a la base de datos
          $codEspe = ($_POST['codEncu']);
          $encuAqui = "SELECT * FROM encuesta WHERE ID_Encuesta = \"$codEspe\"";
          $datosEncu = mysqli_query($conexion, $encuAqui);
          //Esto únicamente ocurre si la encuesta está abierta
          while($columna = mysqli_fetch_array($datosEncu))
          {
            date_default_timezone_set("America/Mexico_City");
            $fechActu = date("Y-m-d");
            $fechActu = explode("-",$fechActu);
            $fechaActuId = ($fechActu[0].$fechActu[1].$fechActu[2].date("H"))*1;//Se genera un entero como código de la fecha actual
            //Mientras existan elementos en el arreglo obtenido se despliegan
            if((($fechaActuId < $columna[8]))&&($fechaActuId > $columna[7]))
            {
              $restFech = "UPDATE encuesta SET Estado=\"abierta\" WHERE ID_Encuesta=\"$codEspe\"";
              $actuali = mysqli_query($conexion, $restFech);
            }
            $existeEncu = true;
            if(($columna[6] == "abierta")&&($fechaActuId < $columna[8]))
            {
              echo
              "<form action = 'resoluencuesta.php' method = 'post'>";
                //Impresión de datos iniciales de la encuesta
                echo "Encuesta: ".$columna['ID_Encuesta']."<br>";
                echo "<h1>".$columna[1]."</h1>";
                $codUsuario = $columna[2];
                $nomCreador = "SELECT Nombre FROM usuario WHERE Número_de_cuenta_o_trabajador = \"$codUsuario\"";
                $autorEncu = mysqli_query($conexion, $nomCreador);
                $creadorProp = mysqli_fetch_array($autorEncu);
                echo "<h3>Autor: ".$creadorProp[0]."<br>";
                echo "Categoría: ";
                //Se selecciona la categoría de las registradas (Temporal)
                if($columna[3] === "1")
                {
                  echo "Académico </h3>";
                }
                else if($columna[3] === "2")
                {
                  echo "Cultura </h3>";
                }
                else if($columna[3] === "3")
                {
                  echo "Deportes </h3>";
                }
                else if($columna[3] === "4")
                {
                  echo "Ciencias </h3>";
                }
                //Arreglos para convertir el ID de fecha en información legible
                $numsUni = ["1","2","3","4","5","6","7","8","9","0"];
                $numsSep = ["1,","2,","3,","4,","5,","6,","7,","8,","9,","0,"];
                $fechaVenc = str_replace($numsUni,$numsSep,$columna[8]);
                $fechaVencArr = explode(",",$fechaVenc);
                //Concatenación de la fecha de vencimiento
                echo "<h4>Vigente hasta: ".$fechaVencArr[6].$fechaVencArr[7]."-".$fechaVencArr[4].$fechaVencArr[5]."-".$fechaVencArr[0].$fechaVencArr[1].$fechaVencArr[2].$fechaVencArr[3]." Hora: ".$fechaVencArr[8].$fechaVencArr[9]."</h4>";
                //Sí existe una imagen, se pondrá en la encuesta
                if($columna[5] !== "")
                {
                  echo "<img class = 'imgImpor' src='../../statics/img/encuimg/".$columna[5]."'><br>";
                }
                echo "<br><span class = 'recuadrotexto'>".$columna[4]."</span><br>";
                //Colocación de las preguntas mediante consulta
                $contadorPreg = 1;
                $encuAqui = "SELECT * FROM pregunta WHERE Encuesta = \"$codEspe\"";
                $datosEncu = mysqli_query($conexion, $encuAqui);
                while($columna = mysqli_fetch_array($datosEncu))
                {
                  //Se van imprimiendo las preguntas y en caso de existir una imagen, también es colocada
                  echo "<h3>".$contadorPreg.".".$columna[1]."</h3>";
                  if($columna[4] !== "")
                  {
                    echo "<img class = 'imgImpor' src='../../statics/img/encuimg/".$columna[4]."'><br>";
                  }
                  //Colocación de opciones
                  $numTempOpc = 1;
                  $pregTemp = $columna['ID_pregunta'];
                  $encuAquiOpc = "SELECT * FROM opción WHERE Pregunta = \"$pregTemp\"";
                  $datosEncuOpc = mysqli_query($conexion, $encuAquiOpc);
                  while($columnaOpc = mysqli_fetch_array($datosEncuOpc))
                  {
                    //En caso de que la opción tenga una imagen también es agregada
                    if($columna[4] !== "")
                    {
                      echo "<img class = 'imgNoImpor' src='../../statics/img/encuimg/".$columnaOpc[2]."'><br>";
                    }
                    echo "<input type = 'radio' name = 'opcPreg".$contadorPreg."' value = '".$columnaOpc['ID_Opción']."' required>".$columnaOpc['Opción']."<br>";
                    $numTempOpc++;
                  }
                  $numTempOpc = 0;
                  $contadorPreg++;
                }
              echo "<br>
              <input type = 'submit' value = 'Enviar'>
              </form>";
            }
            else if($fechaActuId >= $columna[8])
            {
              //En caso de detectar que se ha acabado el tiempo de la encuesta, se cambia el estado a cerrada
              echo "La encuesta ya no está vigente";
              $inserEncu = "UPDATE encuesta SET Estado=\"cerrada\" WHERE ID_Encuesta=\"$codEspe\"";
              $intercambio = mysqli_query($conexion, $inserEncu);
            }
            else
            {
              echo "Ya no está vigente";
            }
          }
          if($existeEncu === false)
          {
            echo "No se encontró encuesta";
          }
        }
        else
        {
          if(isset($_POST['opcPreg1']))
          {
            echo "<h2>Respuesta procesada.</h2>";
            $repasoSelec = 1;
            while(isset($_POST['opcPreg'.$repasoSelec]))
            {
              $selecTemp = ($_POST['opcPreg'.$repasoSelec]);
              $inserSelec = "INSERT INTO respuesta () VALUES (\"\",\"$usuarioTemp\",$selecTemp)";
              $intercambio = mysqli_query($conexion, $inserSelec);
              $repasoSelec++;
            }
          }
          else
          {
            echo
            "<form action='resoluencuesta.php' method= 'post' >
              Coloque su código de encuesta a realizar: <input type='text' pattern= '^[0-9]+' name = 'codEncu' maxlength = 6>
              <br><input type='submit' value='Enviar'>
            </form>";
          }
        }
      }
      else{
        echo "Favor de iniciar sesión<br>
        <a href='../../templates/iniciosesion.html'>Inicio Sesión</a>";
      }
    ?>
    <footer>
        <div class="logo">
          <img src="../statics/media/img/CoyoFormsLogo.jpg" alt="">
        </div>
        <div class="contacto">
          <div class="redes">
            <p>Datos de Contacto</p>
            <a href="https://twitter.com/prepa6_unam?lang=es"><img src="https://seeklogo.com/images/T/twitter-square-black-and-white-logo-962E683117-seeklogo.com.png" alt="Twiter P6"></a>
            <a href="https://www.facebook.com/prepa6/"><img src="https://cdn3.iconfinder.com/data/icons/rcons-social/32/facebook_fb_social_social_media-512.png" alt="Facebook P6"></a>
            <a href="https://www.instagram.com/explore/tags/prepa6/?hl=es"><img src="https://image.flaticon.com/icons/png/512/87/87390.png" alt="Instagram P6"></a>
          <div class="direccion">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d941.0990510362046!2d-99.15662289143005!3d19.35198983024694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf8b434a6ebcd6c83!2sEscuela%20Nacional%20Preparatoria%20N%C2%B0%206%20%22Antonio%20Caso%22%20UNAM!5e0!3m2!1ses-419!2smx!4v1593312628926!5m2!1ses-419!2smx" width="250" height="150" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
        </div>
          
        </div>
        <div class="info">
          <p>Copyright (c) 2020 Copyright Holder All Rights Reserved.</p>
          <p>Información</p>
          <p>Hipervínculo a la página de Créditos</p>
          <p>Demás Cosas</p>
        </div>
      </footer>
  </body>
</html>