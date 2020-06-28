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

      //Esta variable deberá obtenerse del usuario actual
      session_start();
      $creador = ($_SESSION['Numero']);//Temporal
      //Inclusión del archivo de coniguración
      include "config.php";
      //Realización de la conexión
      $conexion = connect();
      connectDB1($conexion, $base);
      connectDB2($base);

      //Tras la reintroducción de la información, se realiza el proceso de reestablecimiento
      if(isset($_POST['codEncu']))
      {
        date_default_timezone_set("America/Mexico_City");
        $fechActu = date("Y-m-d");
        $fechActu = explode("-",$fechActu);
        $fechaActuId = ($fechActu[0].$fechActu[1].$fechActu[2].date("H"))*1;//Se genera un entero como código de la fecha actual
        //Se revisa que la encuesta corresponda al usuario presente
        $revisEncu = "SELECT * FROM encuesta WHERE \"$creador\"";
        $sacadaDeInfo = mysqli_query($conexion,$revisEncu);
        $encuExiste = false;
        if($miencuesta = mysqli_fetch_array($sacadaDeInfo))
        {
          //Se ajustan variables para introducción de datos e inserción de info
          $codigoRest = ($_POST['codEncu']);
          $encuReal = false;
          $procesoMens = false;
          //Se revisa que la encuesta seleccionada corresponda al usuario en turno
          $encuAquiOpc = "SELECT * FROM opción WHERE Encuesta = \"$codigoRest\"";
          $datosEncuOpc = mysqli_query($conexion, $encuAquiOpc);
          while($columnaOpc = mysqli_fetch_array($datosEncuOpc))
          {
            //Se encarga que el mensaje solo se despliegue una vez
            if($procesoMens === false)
            {
              $encuExiste = true;
              echo "Su encuesta se ha reestablecido";
              $procesoMens = true;
            }
            $movidas = $columnaOpc[0];
            //Se eliminan los registros
            $eliminacion = "DELETE FROM respuesta WHERE Respuesta = \"$movidas\"";
            $intercambio = mysqli_query($conexion, $eliminacion);
          }
          //Se reestablece la vigencia de la encuesta
          if(($fechaActuId < ($_POST['encuFechaInic']))&&($fechaActuId > ($_POST['encuFechaVenc'])))
          {
            $restFech = "UPDATE encuesta SET Estado=\"abierta\" WHERE ID_Encuesta=\"$codEspe\"";
            $actuali = mysqli_query($conexion, $restFech);
          }
          else
          {
            $restFech = "UPDATE encuesta SET Estado=\"cerrada\" WHERE ID_Encuesta=\"$codigoRest\"";
            $actuali = mysqli_query($conexion, $restFech);
          }
        }
        //Se despliegan los errores
        else
        {
          echo "No fue posible reestablecer la encuesta";
        }
        if($encuExiste == false)
        {
          echo "La encuesta no existe";
        }
      }
      else//Formulario de reutilización
      {
        echo
        "<form action = 'reutiEncu.php' method = 'post'>
          Coloque el código de la encuesta a reutilizar: <input type='text' pattern= '^[0-9]+' name = 'codEncu' maxlength = 6 required><br>
          Nuevo Inicio: <input type='date' name='encuFechaInic' value='' required> Hora: <input type='number' name='horInic' value='' max='23' min='0' required><br>
          Nuevo Vencimiento: <input type='date' name='encuFechaVenc' value='' required> Hora: <input type='number' name='horVenc' value='' max='23' min='0' required><br>
          *Si usted establece de nuevo la fecha de vencimiento de la encuesta, los registros serán reiniciados<br>
          <input type = 'submit' >
        </form>";
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
