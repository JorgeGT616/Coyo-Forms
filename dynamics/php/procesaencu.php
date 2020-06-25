<?php
  //Esta variable deberá obtenerse del usuario actual
  $creador = "353535355";//Temporal
  //Inclusión del archivo de coniguración
  include "config.php";
  //Realización de la conexión
  $conexion = connect();
  connectDB1($conexion, $base);
  connectDB2($base);
  //Conexión con el archivo de css
  echo "
  <head>
    <link rel='stylesheet' href='../../statics/css/generaencu.css'>
  </head>";
  //Función de colocación de la imagen en el directorio indicado
  function upload($temporal,$destino,$opcExistImg)
  {
    if(file_exists($destino) != true)
    {
      move_uploaded_file($temporal,$destino);
      //Colocación en pantalla de la imagen, variable según su importancia
      if($opcExistImg === 1)
      {
        echo "<p><img class = 'imgPregBord' src='".$destino."' width='30%'></p>";
        $opcExistImg = 0;
      }
      else
      {
        echo "<p><img src='".$destino."' width='20%'></p>";
      }
    }
    else
    {
      echo "<p>No fue posible agregar la imagen</p>";
    }
  }
  //Función para obtener información de la imagen
  function procesadorImg($docuTemp,$opcExistImg)
  {
    $opcExistImg = $opcExistImg;
    $nombre_arch = $docuTemp['name'];//Este es el nombre original del archivo
    $nom_tmp_arch = $docuTemp['tmp_name'];//Este es el nombre temporal del archivo
    $ext = pathinfo($docuTemp['name'], PATHINFO_EXTENSION);//Este te saca la extensión del archivo
         "<br>Extensión: ".$ext."<br>";
    $carpeta_img = "../../statics/img/encuimg/";//esta es la ubicación a la que será mandado el archivo
    $destino = $carpeta_img.$nombre_arch;//Este es el nombre completo del archivo
    if($ext == ("png"||"jpg"||"jpeg"||"PNG"||"JPG"||"JPEG"))//verifica el formato
    {
      upload($nom_tmp_arch,$destino,$opcExistImg);//trae la función de enviar el archivo
    }
    else
    {
      echo "No es el formato que busco";
    }
  }
  //Función que actualiza el registro principal de la encuesta con la imagen en caso de existir
  function insercionImgEncu($docuTemp,$idEncuTemp,$conexion)
  {
    $imgEncuIns = $docuTemp['name'];
    $inserEncu = "UPDATE encuesta SET Imagen=\"$imgEncuIns\" WHERE ID_Encuesta=\"$idEncuTemp\"";
    $intercambio = mysqli_query($conexion, $inserEncu);
  }
  //Función que actualiza el registro de la pregunta con la imagen en caso de existir
  function insercionImgPreg($docuTemp,$idPregTemp,$conexion)
  {
    $imgPregIns = $docuTemp['name'];
    $inserEncu = "UPDATE pregunta SET Imagen=\"$imgPregIns\" WHERE ID_pregunta=\"$idPregTemp\"";
    $intercambio = mysqli_query($conexion, $inserEncu);
  }
  //Función que actualiza el registro de la opción con la imagen en caso de existir
  function insercionImgOpc($docuTemp,$idOpcTemp,$conexion)
  {
    $imgOpcIns = $docuTemp['name'];
    $inserEncu = "UPDATE opción SET Imagen=\"$imgOpcIns\" WHERE ID_Opción=\"$idOpcTemp\"";
    $intercambio = mysqli_query($conexion, $inserEncu);
  }
  //Obtención de los datos esenciales para la encuesta
  $nombre = (isset($_POST['nombreEnc'])&& $_POST['nombreEnc'])?$_POST['nombreEnc']:false;
  $pregunta = (isset($_POST['preg1'])&& $_POST['preg1'])?$_POST['preg1']:false;
  $descripcion = (isset($_POST['descrEncu'])&& $_POST['descrEncu'])?$_POST['descrEncu']:false;
  //Recepción inicial de las fechas y horas de inicio y vencimiento
  $fechInic = (isset($_POST['encuFechaInic'])&& $_POST['encuFechaInic'])?$_POST['encuFechaInic']:false;
  $horaInic = (isset($_POST['horInic'])&& $_POST['horInic'])?$_POST['horInic']:false;
  $fechVenc = (isset($_POST['encuFechaVenc'])&& $_POST['encuFechaVenc'])?$_POST['encuFechaVenc']:false;
  $horaVenc = (isset($_POST['horVenc'])&& $_POST['horVenc'])?$_POST['horVenc']:false;

  //Variables de tiempo concatenadas para comparación
  $fechInic = explode("-",$fechInic);
  $fechaInicId = ($fechInic[0].$fechInic[1].$fechInic[2].$horaInic)*1;//Se genera un entero como código de la fecha de inicio
  $fechVenc = explode("-",$fechVenc);
  $fechaVencId = ($fechVenc[0].$fechVenc[1].$fechVenc[2].$horaVenc)*1;//Se genera un entero como código de la fecha de vencimiento
  date_default_timezone_set("America/Mexico_City");
  $fechActu = date("Y-m-d");
  $fechActu = explode("-",$fechActu);
  $fechaActuId = ($fechActu[0].$fechActu[1].$fechActu[2].date("H"))*1;//Se genera un entero como código de la fecha actual

  //Se establecen variables para recorrer las opciones e imágenes
  $opcExist = 1;
  $opcExistImg = 0;
  //Presentación del nombre de la encuesta
  echo "<h2>".$nombre;

  //Determinación de vigencia a partir de los códigos de fechas
  if(($fechaInicId <= $fechaActuId)&&($fechaActuId <= $fechaVencId))
  {
    echo " (vigente)</h2>";
    $estado = "abierta";
  }
  else
  {
    echo " (no vigente)</h2>";
    $estado = "cerrada";
  }
  //Esta sección es temporal para agregar categorías a partir del número de categoría
  $categoria = (isset($_POST['encuCategoria'])&& $_POST['encuCategoria'])?$_POST['encuCategoria']:false;
  if($categoria == "1")
  {
    echo "<h3>Académico</h3>";
  }
  else if($categoria == "2")
  {
    echo "<h3>Cultura</h3>";
  }
  else if($categoria == "3")
  {
    echo "<h3>Deportes</h3>";
  }
  else if($categoria == "4")
  {
    echo "<h3>Ciencias</h3>";
  }

  //Detecta si existe una imagen principal para la encuesta
  if(isset($_FILES['encuImg']) && $_FILES['encuImg']['error'] == 0)
  {
    $docuTemp = ($_FILES['encuImg']);
    $opcExistImg = 1;
    procesadorImg($docuTemp,$opcExistImg);
    $opcExistImg = 0;
  }
  //Muestra la descripción
  echo "<div class = 'descripcion'>".$descripcion."</div>";

  //Inserción general en la tabla encuesta
  $inserEncu = "INSERT INTO encuesta () VALUES (\"\",\"$nombre\",\"$creador\",\"$categoria\",\"$descripcion\",\"\",\"$estado\",\"$fechaInicId\",\"$fechaVencId\")";
  $intercambio = mysqli_query($conexion, $inserEncu);
  $consulEncu = "SELECT ID_Encuesta FROM encuesta WHERE (Nombre = \"$nombre\") AND (Fecha_de_final = \"$fechaVencId\")";
  $intercambioConsul = mysqli_query($conexion, $consulEncu);
  $idEncuesta = mysqli_fetch_array($intercambioConsul);
  //$idEncuesta[0];//Este es el Id de la Encuesta
  echo "<h4>Id de encuesta: ".$idEncuesta[0]."</h4>";

  echo "<h3>".$pregunta."</h3>";
  //Inserción a la base de la imagen
  if(isset($_FILES['encuImg']) && $_FILES['encuImg']['error'] == 0)
  {
    $docuTemp = ($_FILES['encuImg']);
    $idEncuTemp = $idEncuesta[0];
    insercionImgEncu($docuTemp,$idEncuTemp,$conexion);
  }

  if(isset($_FILES['preg1Img']) && $_FILES['preg1Img']['error'] == 0)
  {
    $docuTemp = ($_FILES['preg1Img']);
    $opcExistImg = 1;
    procesadorImg($docuTemp,$opcExistImg);
    $opcExistImg = 0;
  }

  //Inserción de la pregunta 1
  $inserEncu = "INSERT INTO pregunta () VALUES (\"\",\"$pregunta\",\"$idEncuesta[0]\",1,\"\")";
  $intercambio = mysqli_query($conexion, $inserEncu);

  $consulEncu = "SELECT ID_pregunta FROM pregunta WHERE (Número_de_pregunta = 1) AND (Encuesta = \"$idEncuesta[0]\")";
  $intercambioConsul = mysqli_query($conexion, $consulEncu);
  $idPreg1 = mysqli_fetch_array($intercambioConsul);

  //Inserción a la base de la imagen de la pregunta 1
  if(isset($_FILES['preg1Img']) && $_FILES['preg1Img']['error'] == 0)
  {
    $docuTemp = ($_FILES['preg1Img']);
    $idPregTemp = $idPreg1[0];
    insercionImgPreg($docuTemp,$idPregTemp,$conexion);
  }


  while(isset($_POST['opc'.$opcExist.'1']))
  {
    if(($_POST['opc'.$opcExist.'1']) !== "")
    {
      if(isset($_FILES['opc'.$opcExist.'1Img']) && $_FILES['opc'.$opcExist.'1Img']['error'] == 0)
      {
        $docuTemp = ($_FILES['opc'.$opcExist.'1Img']);
        procesadorImg($docuTemp,$opcExistImg);
      }
      echo ($_POST['opc'.$opcExist.'1'])."<input type='radio' name='pregunta1' value= '".($_POST['opc'.$opcExist.'1'])."'><br>";
      //Inserción de opciones Pregunta 1
      $opcTemp = ($_POST['opc'.$opcExist.'1']);
      $inserEncu = "INSERT INTO opción () VALUES (\"\",\"$opcTemp\",\"\",\"$idPreg1[0]\",\"$idEncuesta[0]\")";
      $intercambio = mysqli_query($conexion, $inserEncu);

      $consulEncu = "SELECT ID_opción FROM opción WHERE (Pregunta = $idPreg1[0]) AND (Opción = \"$opcTemp\")";
      $intercambioConsul = mysqli_query($conexion, $consulEncu);
      $idOpc1 = mysqli_fetch_array($intercambioConsul);

      //Inserción a la base de la imagen de la opción correspondiente en pregunta 1
      if(isset($_FILES['opc'.$opcExist.'1Img']) && $_FILES['opc'.$opcExist.'1Img']['error'] == 0)
      {
        $docuTemp = ($_FILES['opc'.$opcExist.'1Img']);
        $idOpcTemp = $idOpc1[0];
        insercionImgOpc($docuTemp,$idOpcTemp,$conexion);
      }
    }
    $opcExist = $opcExist + 1;
  }

  $opcExist = 1;
  if((isset($_POST['preg2']))&&(($_POST['preg2'])!==""))
  {
    //Inserción de pregunta 2
    $preguntaTemp = ($_POST['preg2']);
    $inserEncu = "INSERT INTO pregunta () VALUES (\"\",\"$preguntaTemp\",\"$idEncuesta[0]\",2,\"\")";
    $intercambio = mysqli_query($conexion, $inserEncu);

    $consulEncu = "SELECT ID_pregunta FROM pregunta WHERE (Número_de_pregunta = 2) AND (Encuesta = \"$idEncuesta[0]\")";
    $intercambioConsul = mysqli_query($conexion, $consulEncu);
    $idPreg2 = mysqli_fetch_array($intercambioConsul);

    echo "<h3>".($_POST['preg2'])."</h3>";
    if(isset($_FILES['preg2Img']) && $_FILES['preg2Img']['error'] == 0)
    {
      $docuTemp = ($_FILES['preg2Img']);
      $opcExistImg = 1;
      procesadorImg($docuTemp,$opcExistImg);
      $opcExistImg = 0;
    }
    while(isset($_POST['opc'.$opcExist.'2']))
    {
      if(($_POST['opc'.$opcExist.'2']) !== "")
      {
        if(isset($_FILES['opc'.$opcExist.'2Img']) && $_FILES['opc'.$opcExist.'2Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'2Img']);
          procesadorImg($docuTemp,$opcExistImg);
        }
        echo ($_POST['opc'.$opcExist.'2'])."<input type='radio' name='pregunta2' value= '".($_POST['opc'.$opcExist.'2'])."'><br>";
        //Inserción de Opciones pregunta 2
        $opcTemp = ($_POST['opc'.$opcExist.'2']);
        $inserEncu = "INSERT INTO opción () VALUES (\"\",\"$opcTemp\",\"\",\"$idPreg2[0]\",\"$idEncuesta[0]\")";
        $intercambio = mysqli_query($conexion, $inserEncu);

        $consulEncu = "SELECT ID_opción FROM opción WHERE (Pregunta = $idPreg2[0]) AND (Opción = \"$opcTemp\")";
        $intercambioConsul = mysqli_query($conexion, $consulEncu);
        $idOpc2 = mysqli_fetch_array($intercambioConsul);

        //Inserción a la base de la imagen de la opción correspondiente en pregunta 2
        if(isset($_FILES['opc'.$opcExist.'2Img']) && $_FILES['opc'.$opcExist.'2Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'2Img']);
          $idOpcTemp = $idOpc2[0];
          insercionImgOpc($docuTemp,$idOpcTemp,$conexion);
        }
      }
      $opcExist = $opcExist + 1;
    }
  }
  //Inserción a la base de la imagen de la pregunta 2
  if(isset($_FILES['preg2Img']) && $_FILES['preg2Img']['error'] == 0)
  {
    $docuTemp = ($_FILES['preg2Img']);
    $idPregTemp = $idPreg2[0];
    insercionImgPreg($docuTemp,$idPregTemp,$conexion);
  }


  $opcExist = 1;
  if((isset($_POST['preg3']))&&(($_POST['preg3'])!==""))
  {
    //Inserción de pregunta 3
    $preguntaTemp = ($_POST['preg3']);
    $inserEncu = "INSERT INTO pregunta () VALUES (\"\",\"$preguntaTemp\",\"$idEncuesta[0]\",3,\"\")";
    $intercambio = mysqli_query($conexion, $inserEncu);

    $consulEncu = "SELECT ID_pregunta FROM pregunta WHERE (Número_de_pregunta = 3) AND (Encuesta = \"$idEncuesta[0]\")";
    $intercambioConsul = mysqli_query($conexion, $consulEncu);
    $idPreg3 = mysqli_fetch_array($intercambioConsul);

    echo "<h3>".($_POST['preg3'])."</h3>";
    if(isset($_FILES['preg3Img']) && $_FILES['preg3Img']['error'] == 0)
    {
      $docuTemp = ($_FILES['preg3Img']);
      $opcExistImg = 1;
      procesadorImg($docuTemp,$opcExistImg);
      $opcExistImg = 0;
    }
    while(isset($_POST['opc'.$opcExist.'3']))
    {
      if(($_POST['opc'.$opcExist.'3']) !== "")
      {
        if(isset($_FILES['opc'.$opcExist.'3Img']) && $_FILES['opc'.$opcExist.'3Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'3Img']);
          procesadorImg($docuTemp,$opcExistImg);
        }
        //Inserción de Opciones pregunta 3
        echo ($_POST['opc'.$opcExist.'3'])."<input type='radio' name='pregunta3' value= '".($_POST['opc'.$opcExist.'3'])."'><br>";

        $opcTemp = ($_POST['opc'.$opcExist.'3']);
        $inserEncu = "INSERT INTO opción () VALUES (\"\",\"$opcTemp\",\"\",\"$idPreg3[0]\",\"$idEncuesta[0]\")";
        $intercambio = mysqli_query($conexion, $inserEncu);

        $consulEncu = "SELECT ID_opción FROM opción WHERE (Pregunta = $idPreg3[0]) AND (Opción = \"$opcTemp\")";
        $intercambioConsul = mysqli_query($conexion, $consulEncu);
        $idOpc3 = mysqli_fetch_array($intercambioConsul);

        //Inserción a la base de la imagen de la opción correspondiente en pregunta 3
        if(isset($_FILES['opc'.$opcExist.'3Img']) && $_FILES['opc'.$opcExist.'3Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'3Img']);
          $idOpcTemp = $idOpc3[0];
          insercionImgOpc($docuTemp,$idOpcTemp,$conexion);
        }
      }
      $opcExist = $opcExist + 1;
    }
  }
  //Inserción a la base de la imagen de la pregunta 3
  if(isset($_FILES['preg3Img']) && $_FILES['preg3Img']['error'] == 0)
  {
    $docuTemp = ($_FILES['preg3Img']);
    $idPregTemp = $idPreg3[0];
    insercionImgPreg($docuTemp,$idPregTemp,$conexion);
  }


  $opcExist = 1;
  if((isset($_POST['preg4']))&&(($_POST['preg4'])!==""))
  {
    //Inserción de pregunta 4
    $preguntaTemp = ($_POST['preg4']);
    $inserEncu = "INSERT INTO pregunta () VALUES (\"\",\"$preguntaTemp\",\"$idEncuesta[0]\",4,\"\")";
    $intercambio = mysqli_query($conexion, $inserEncu);

    $consulEncu = "SELECT ID_pregunta FROM pregunta WHERE (Número_de_pregunta = 4) AND (Encuesta = \"$idEncuesta[0]\")";
    $intercambioConsul = mysqli_query($conexion, $consulEncu);
    $idPreg4 = mysqli_fetch_array($intercambioConsul);

    echo "<h3>".($_POST['preg4'])."</h3>";
    if(isset($_FILES['preg4Img']) && $_FILES['preg4Img']['error'] == 0)
    {
      $docuTemp = ($_FILES['preg4Img']);
      $opcExistImg = 1;
      procesadorImg($docuTemp,$opcExistImg);
      $opcExistImg = 0;
    }
    while(isset($_POST['opc'.$opcExist.'4']))
    {
      if(($_POST['opc'.$opcExist.'4']) !== "")
      {
        if(isset($_FILES['opc'.$opcExist.'4Img']) && $_FILES['opc'.$opcExist.'4Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'4Img']);
          procesadorImg($docuTemp,$opcExistImg);
        }
        echo ($_POST['opc'.$opcExist.'4'])."<input type='radio' name='pregunta4' value= '".($_POST['opc'.$opcExist.'4'])."'><br>";
        //Inserción de Opciones pregunta 4
        $opcTemp = ($_POST['opc'.$opcExist.'4']);
        $inserEncu = "INSERT INTO opción () VALUES (\"\",\"$opcTemp\",\"\",\"$idPreg4[0]\",\"$idEncuesta[0]\")";
        $intercambio = mysqli_query($conexion, $inserEncu);

        $consulEncu = "SELECT ID_opción FROM opción WHERE (Pregunta = $idPreg4[0]) AND (Opción = \"$opcTemp\")";
        $intercambioConsul = mysqli_query($conexion, $consulEncu);
        $idOpc4 = mysqli_fetch_array($intercambioConsul);

        //Inserción a la base de la imagen de la opción correspondiente en pregunta 4
        if(isset($_FILES['opc'.$opcExist.'4Img']) && $_FILES['opc'.$opcExist.'4Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'4Img']);
          $idOpcTemp = $idOpc4[0];
          insercionImgOpc($docuTemp,$idOpcTemp,$conexion);
        }
      }
      $opcExist = $opcExist + 1;
    }
  }
  //Inserción a la base de la imagen de la pregunta 2
  if(isset($_FILES['preg4Img']) && $_FILES['preg4Img']['error'] == 0)
  {
    $docuTemp = ($_FILES['preg4Img']);
    $idPregTemp = $idPreg4[0];
    insercionImgPreg($docuTemp,$idPregTemp,$conexion);
  }


  $opcExist = 1;
  if((isset($_POST['preg5']))&&(($_POST['preg5'])!==""))
  {
    //Inserción de pregunta 5
    $preguntaTemp = ($_POST['preg5']);
    $inserEncu = "INSERT INTO pregunta () VALUES (\"\",\"$preguntaTemp\",\"$idEncuesta[0]\",5,\"\")";
    $intercambio = mysqli_query($conexion, $inserEncu);

    $consulEncu = "SELECT ID_pregunta FROM pregunta WHERE (Número_de_pregunta = 5) AND (Encuesta = \"$idEncuesta[0]\")";
    $intercambioConsul = mysqli_query($conexion, $consulEncu);
    $idPreg5 = mysqli_fetch_array($intercambioConsul);

    echo "<h3>".($_POST['preg5'])."</h3>";
    if(isset($_FILES['preg5Img']) && $_FILES['preg5Img']['error'] == 0)
    {
      $docuTemp = ($_FILES['preg5Img']);
      $opcExistImg = 1;
      procesadorImg($docuTemp,$opcExistImg);
      $opcExistImg = 0;
    }
    while(isset($_POST['opc'.$opcExist.'5']))
    {
      if(($_POST['opc'.$opcExist.'5']) !== "")
      {
        if(isset($_FILES['opc'.$opcExist.'5Img']) && $_FILES['opc'.$opcExist.'5Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'5Img']);
          procesadorImg($docuTemp,$opcExistImg);
        }
        echo ($_POST['opc'.$opcExist.'5'])."<input type='radio' name='pregunta5' value= '".($_POST['opc'.$opcExist.'5'])."'><br>";
        //Inserción de Opciones pregunta 5
        $opcTemp = ($_POST['opc'.$opcExist.'5']);
        $inserEncu = "INSERT INTO opción () VALUES (\"\",\"$opcTemp\",\"\",\"$idPreg5[0]\",\"$idEncuesta[0]\")";
        $intercambio = mysqli_query($conexion, $inserEncu);

        $consulEncu = "SELECT ID_opción FROM opción WHERE (Pregunta = $idPreg5[0]) AND (Opción = \"$opcTemp\")";
        $intercambioConsul = mysqli_query($conexion, $consulEncu);
        $idOpc5 = mysqli_fetch_array($intercambioConsul);

        //Inserción a la base de la imagen de la opción correspondiente en pregunta 1
        if(isset($_FILES['opc'.$opcExist.'5Img']) && $_FILES['opc'.$opcExist.'5Img']['error'] == 0)
        {
          $docuTemp = ($_FILES['opc'.$opcExist.'5Img']);
          $idOpcTemp = $idOpc5[0];
          insercionImgOpc($docuTemp,$idOpcTemp,$conexion);
        }
      }
      $opcExist = $opcExist + 1;
    }
  }
  //Inserción a la base de la imagen de la pregunta 5
  if(isset($_FILES['preg5Img']) && $_FILES['preg5Img']['error'] == 0)
  {
    $docuTemp = ($_FILES['preg5Img']);
    $idPregTemp = $idPreg5[0];
    insercionImgPreg($docuTemp,$idPregTemp,$conexion);
  }


?>
