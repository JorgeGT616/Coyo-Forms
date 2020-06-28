//Conjunto de eventos para agregar opciones
//Agregar Opción en pregunta 1
var numOpc = 2;
function agregarOpc1()
{
  //Se verifica que la cantidad de opciones sea menor a 10
  if(numOpc < 10)
  {
    //Se crea un elemento para contener el campo de la nueva opción
    let encuOpc = document.createElement("div");
    numOpc = numOpc + 1;
    //Esta obtiene como atributo un código de dos dígitos como id para futuros procesos
    encuOpc.setAttribute("id","opc" + numOpc + "1");
    encuOpc.innerHTML = "Opción " + numOpc + ": <input type = 'text' name = 'opc" +
    numOpc + "1' value = '' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc" + numOpc + "1Img' value=''>";
    let lista = document.getElementById("listaOpc");
    //Se inserta la opción
    lista.appendChild(encuOpc);
    if(numOpc == 3)
    {
      //En caso de que sea la primer opción agregada, también se incluye un botón para que sea borrada
      let borraOpc = document.createElement("div");
      borraOpc.innerHTML = "<button id = 'elimOpc' onclick='elimOpc1()'>Eliminar Opción</button>";
      borraOpc.setAttribute("id","botRmv1")
      //Se elimina el botón
      let botoConten = document.getElementById("botonRem1");
      botoConten.appendChild(borraOpc);
    }
  }
}
//Se repite el evento anterior para insertar opciones en la pregunta 2
var numOpc2 = 2;
function agregarOpc2()
{
  if(numOpc2 < 10)
  {
    let encuOpc = document.createElement("div");
    numOpc2++;
    encuOpc.setAttribute("id","opc" + numOpc2 + "2");
    encuOpc.innerHTML = "Opción " + numOpc2 + ": <input type = 'text' name = 'opc" +
    numOpc2 + "2' value = '' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc" + numOpc2 + "2Img' value=''>";
    let lista = document.getElementById("listaOpc2");
    lista.appendChild(encuOpc);
    if(numOpc2 == 3)
    {
      let borraOpc = document.createElement("div");
      borraOpc.innerHTML = "<button id = 'elimOpc' onclick='elimOpc2()'>Eliminar Opción</button>";
      borraOpc.setAttribute("id","botRmv2")
      let botoConten = document.getElementById("botonRem2");
      botoConten.appendChild(borraOpc);
    }
  }
}
//Inserción de opciones en la pregunta 3
var numOpc3 = 2;
function agregarOpc3()
{
  if(numOpc3 < 10)
  {
    let encuOpc = document.createElement("div");
    numOpc3 = numOpc3 + 1;
    encuOpc.setAttribute("id","opc" + numOpc3 + "3");
    encuOpc.innerHTML = "Opción " + numOpc3 + ": <input type = 'text' name = 'opc" +
    numOpc3 + "3' value = '' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc" + numOpc3 + "3Img' value=''>";
    let lista = document.getElementById("listaOpc3");
    lista.appendChild(encuOpc);
    if(numOpc3 == 3)
    {
      let borraOpc = document.createElement("div");
      borraOpc.innerHTML = "<button id = 'elimOpc' onclick='elimOpc3()'>Eliminar Opción</button>";
      borraOpc.setAttribute("id","botRmv3");
      let botoConten = document.getElementById("botonRem3");
      botoConten.appendChild(borraOpc);
    }
  }
}
//Inserción de opciones en la pregunta 4
var numOpc4 = 2;
function agregarOpc4()
{
  if(numOpc4 < 10)
  {
    let encuOpc = document.createElement("div");
    numOpc4 = numOpc4 + 1;
    encuOpc.setAttribute("id","opc" + numOpc4 + "4");
    encuOpc.innerHTML = "Opción " + numOpc4 + ": <input type = 'text' name = 'opc" +
    numOpc4 + "4' value = '' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc" + numOpc4 + "4Img' value=''>";
    let lista = document.getElementById("listaOpc4");
    lista.appendChild(encuOpc);
    if(numOpc4 == 3)
    {
      let borraOpc = document.createElement("div");
      borraOpc.innerHTML = "<button id = 'elimOpc' onclick='elimOpc4()'>Eliminar Opción</button>";
      borraOpc.setAttribute("id","botRmv4");
      let botoConten = document.getElementById("botonRem4");
      botoConten.appendChild(borraOpc);
    }
  }
}
//Insefción de opciones en la pregunta 5
var numOpc5 = 2;
function agregarOpc5()
{
  if(numOpc5 < 10)
  {
    let encuOpc = document.createElement("div");
    numOpc5 = numOpc5 + 1;
    encuOpc.setAttribute("id","opc" + numOpc5 + "5");
    encuOpc.innerHTML = "Opción " + numOpc5 + ": <input type = 'text' name = 'opc" +
    numOpc5 + "5' value = '' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc" + numOpc5 + "5Img' value=''>";
    let lista = document.getElementById("listaOpc5")
    lista.appendChild(encuOpc);
    if(numOpc5 == 3)
    {
      let borraOpc = document.createElement("div");
      borraOpc.innerHTML = "<button id = 'elimOpc' onclick='elimOpc5()'>Eliminar Opción</button>";
      borraOpc.setAttribute("id","botRmv5");
      let botoConten = document.getElementById("botonRem5");
      botoConten.appendChild(borraOpc);
    }
  }
}

//Evento para agregar una pregunta
var numPreg = 1;
function agregarPreg()
{
  //Se verifica que no sean más de cinco preguntas
  if(numPreg < 5)
  {
    //Contenedor para guardar la pregunta
    let encuPreg = document.createElement("div");
    numPreg = numPreg + 1;
    //Se incluye un id único para la pregunta en el formulario
    encuPreg.setAttribute("id","preguntilla" + numPreg);
    //Se agrega un campo de texto para la pregunta, dos para las opciones y los archivos
    encuPreg.innerHTML = "<h3>Pregunta: <input type = 'text' name = 'preg"
     + numPreg +
    "' value = '' maxlength='30' title='Revise sus caracteres especiales' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' required><br><input type='file' name='preg" +
    numPreg + "Img' value=''></h3><div id='preg"
     + numPreg +
    "'>Opción 1: <input type='text' name='opc1" + numPreg + "' value='' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc1" +
    numPreg + "Img' value=''><br>Opción 2: <input type='text' name='opc2" +
    numPreg + "' value='' maxlength='30' pattern='[A-Za-zÁÉÍÓÚáéíóú0-9¿?.,\ ]+' title='Revise sus caracteres especiales' required><input type='file' name='opc2" +
    numPreg + "Img' value=''></div><div id='listaOpc" + numPreg + "'></div>";
    let lista = document.getElementById("neopreg")
    lista.appendChild(encuPreg);
    let neoBoton = document.createElement("div");
    neoBoton.setAttribute("id","agregBot" + numPreg)
    neoBoton.innerHTML = "<br><button id = 'agregarOpc' onclick='agregarOpc" + numPreg + "()'>Agregar Opción</button><span id = 'botonRem" + numPreg + "'></span>";
    let guardBot = document.getElementById("botCont");
    guardBot.appendChild(neoBoton);
    //Al igual que las opciones, al tener dos preguntas se agrega un botón para eliminar preguntas
    if(numPreg == 2)
    {
      let borraPreg = document.createElement("div");
      borraPreg.innerHTML = "<button id = 'elimPreg' onclick='elimPreg1()'>Eliminar Pregunta</button>";
      borraPreg.setAttribute("id","botRmvPreg")
      let botoPreg = document.getElementById("botonRemPreg1");
      botoPreg.appendChild(borraPreg);
    }
    if(numPreg == 5)
    {
      var botAgregPregElim = document.getElementById('agregarPreg');
      botAgregPregElim.remove();
    }
  }
}
//Serie de eventos para eliminar opciones
//Borrado de opciones en la pregunta 1
function elimOpc1()
{
  //Obtiene la opción más reciente y la elimina
  opcBorr = document.getElementById("opc" + numOpc + "1");
  opcBorr.remove();
  //Al llegar al número mínimo de opciones, borra el botón para borrar opciones
  if(numOpc == 3)
  {
    botBorr1 = document.getElementById("botRmv1");
    botBorr1.remove();
  }
  //Controla la cantidad de opciones
  numOpc = numOpc - 1;
}
//Mismo evento que el anterior para opciones en la pregunta 2
function elimOpc2()
{
  opcBorr = document.getElementById("opc" + numOpc2 + "2");
  opcBorr.remove();
  if(numOpc2 == 3)
  {
    botBorr2 = document.getElementById("botRmv2");
    botBorr2.remove();
  }
  numOpc2 = numOpc2 - 1;
}
//Borrado de opciones en la pregunta 3
function elimOpc3()
{
  opcBorr = document.getElementById("opc" + numOpc3 + "3");
  opcBorr.remove();
  if(numOpc3 == 3)
  {
    botBorr3 = document.getElementById("botRmv3");
    botBorr3.remove();
  }
  numOpc3 = numOpc3 - 1;
}
//Borrado de opciones en la pregunta 4
function elimOpc4()
{
  opcBorr = document.getElementById("opc" + numOpc4 + "4");
  opcBorr.remove();
  if(numOpc4 == 3)
  {
    botBorr4 = document.getElementById("botRmv4");
    botBorr4.remove();
  }
  numOpc4 = numOpc4 - 1;
}
//Borrado de opciones en la pregunta 5
function elimOpc5()
{
  opcBorr = document.getElementById("opc" + numOpc5 + "5");
  opcBorr.remove();
  if(numOpc5 == 3)
  {
    botBorr5 = document.getElementById("botRmv5");
    botBorr5.remove();
  }
  numOpc5 = numOpc5 - 1;
}
//Eliminación de preguntas
function elimPreg1()
{
  //Toma el contenedor de la pregunta y lo elimina
  pregBorrA = document.getElementById("preguntilla" + numPreg);
  pregBorrA.remove();
  //Elimina los botones correspondientes a esa pregunta
  botBorr = document.getElementById("agregBot" + numPreg);
  botBorr.remove();
  if(numPreg == 2)
  {
    //Al llegar al mínimo de preguntas, elimina el botón de eliminación
    botPreg = document.getElementById("botRmvPreg");
    botPreg.remove();
  }
  //Reinicia el contador de opciones al borrar la pregunta en turno
  if(numPreg == 5)
  {
    numOpc5 = 2;
    var regrBotAgregPreg = document.getElementById('agregaPregBotCont');
    regrBotAgregPreg.innerHTML = "<button id = 'agregarPreg' onclick='agregarPreg()'>Agregar Pregunta</button>";
  }
  else if(numPreg == 4)
  {
    numOpc4 = 2;
  }
  else if(numPreg == 3)
  {
    numOpc3 = 2;
  }
  else if(numPreg == 2)
  {
    numOpc2 = 2;
  }
  numPreg = numPreg - 1;
}
