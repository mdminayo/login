<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
session_unset();
session_destroy();
if(isset($_GET['mensaje'])) $mensaje=$_GET['mensaje'];
else $mensaje='';
?>
<html>
    <head>@
        <meta charset="UTF-8">
        <title>WORLD HEART</title>
        <link rel="stylesheet" type="text/css" href="presentacion/css/style.css">  
        
    </head>
    <style>
            body{
                background-image: url(presentacion/imagenes/fondo.jpg);
                width: 1360px;
                height: 579px
            }
        </style>
    <body>
        
        <div class="login-box">
         <img src="presentacion/imagenes/avatar.png" class="avatar">
        
        <h1>LOGIN</h1>
        <font color="red"><?=$mensaje?></font>
        <form name="formulario" method="post" action="world/validar.php">
                  
            <p>Empresa</p>
            <input type="email" name="user" placeholder="Email" required>
            <p>Clave</p>
            <input type="password" name="password" placeholder="Clave" required>
        
        <input type="submit" value="Ingresar"/>
        <a href="#">¿Olvidaste tu Contraseña?</a>  
        </form>
            
        </div>
    
        
       
   
    </body>
</html>
