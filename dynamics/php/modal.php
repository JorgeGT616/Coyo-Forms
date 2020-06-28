<?php
    //si se recibe una peticion
    if(isset($_GET['opcion'])){
        //valor de peticion se guarda en variable
        $opcion = $_GET['opcion'];

        /*Modales para errores y exitos en inicio de sesion y registro de usuarios*/

        if($opcion == 1){//indica que ya hay una sesion
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Ya existe una sesion abierta</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>Redireccionando a página principal</div>
                        </div>
                    </div>
                </div>";
        }elseif($opcion == 2){//usuario con datos similares
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Error</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>Hubo un error, puede que exista un usuario con datos similares.</div>
                        </div>
                    </div>
                </div>";
        }elseif($opcion == 3){//no se guardó la imagen
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Error</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>No se pudo subir la imagen, trate de nuevo, usando los formatos requridos!</div>
                        </div>
                    </div>
                </div>";
        }elseif($opcion == 4){//NO coinciden datos con curp o rfc
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Error</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>Tus datos no coinciden, porfavor verificalos</div>
                        </div>
                    </div>
                </div>";
        }elseif($opcion == 5){//Usuario no registrado
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Error</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>Usuario invalido, primero debes registrate</div>
                        </div>
                    </div>
                </div>";
        }elseif($opcion == 6){//Imposible validar
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Error</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>No pudimos validar tu informacion intentalo mas tarde</div>
                        </div>
                    </div>
                </div>";
        }elseif($opcion == 7){//EXITO EN REGISTRO
            echo "<div id='modal' >
                    <div class='afuera' id='afuera'>
                        <div class='content'>
                           <div class='head'>
                                <h2>Registro exitoso</h2>
                                <span>x</span>
                            </div>
                            <div class='body'>Todo bien :)</div>
                        </div>
                    </div>
                </div>";
        }
    }

?>