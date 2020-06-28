<?php

  //Esta variable deberá obtenerse del usuario actual
  $creador = "353535355";//Temporal
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
    $encuExiste = false
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
