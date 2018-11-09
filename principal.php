<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();//crea o mantiene la sesion, asi se tiene acceso a las variables de sesion creadas

require_once dirname(__FILE__).'/world/clases/Usuario.php';
require_once dirname(__FILE__).'/clases/ConectorBD.php';

if (!isset($_SESSION['user'])){
    $mensaje="session no valida";
    header("location: index.php?mensaje=$mensaje");
}

$USUARIO= new Usuario('email', $_SESSION['user']);

?>
<html>
    <head>
      
        <meta charset="UTF-8">
        <title>World Heart</title>
       <link rel="stylesheet" type="text/css" href="presentacion/css/estilomodal.css">
       <link rel="stylesheet" type="text/css" href="presentacion/css/estilo.css">
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <script src="lib/jquery-3.3.1.min.js" type="text/javascript"></script>
    </head>
    <body>

        <header>
            <div class="contenedor">
                <div id="marca">
                    <h1><span class="resaltado">World</span>Heart</h1>
                </div>
                <nav>

                    <?= $USUARIO->getMenu($USUARIO->getIdtipousuario()) ?>
                </nav>
            </div>
        </header>
        <header>
            <nav class="actual" style="margin: 0; padding: 0; margin-top: -20px">
                <a >Lista de Eventos</a>
            </nav>
        </header>
        <div id="contenido" style="background: #f7f7f8"><?php include $_GET['CONTENIDO'] ?></div>


    </body>
</html>
