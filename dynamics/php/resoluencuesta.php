<?php

  echo "
  <head>
    <link rel='stylesheet' href='../../statics/css/generaencu.css'>
  </head>";

  //Inclusión del archivo de coniguración
  include "config.php";
  //Realización de la conexión
  $conexion = connect();
  connectDB1($conexion, $base);
  connectDB2($base);

  $usuarioTemp = "353535355";//Temporal

  //Verifica que exista un código de encuesta
  if(isset($_POST['codEncu']))
  {
    $existeEncu = false;
    //Al tener el código de la encuesta, se realiza la consulta a la base de datos
    $codEspe = ($_POST['codEncu']);
    $encuAqui = "SELECT * FROM encuesta WHERE ID_Encuesta = \"$codEspe\"";
    $datosEncu = mysqli_query($conexion, $encuAqui);
    //Mientras existan elementos en el arreglo obtenido se despliegan
    while($columna = mysqli_fetch_array($datosEncu))
    {
      $existeEncu = true;
      //Esto únicamente ocurre si la encuesta está abierta
      date_default_timezone_set("America/Mexico_City");
      $fechActu = date("Y-m-d");
      $fechActu = explode("-",$fechActu);
      $fechaActuId = ($fechActu[0].$fechActu[1].$fechActu[2].date("H"))*1;//Se genera un entero como código de la fecha actual
      if(($fechaActuId < $columna[8]))&&($fechaActuId > $columna[7])))
      {
        $restFech = "UPDATE encuesta SET Estado=\"abierta\" WHERE ID_Encuesta=\"$codEspe\"";
        $actuali = mysqli_query($conexion, $restFech);
      }
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

?>
