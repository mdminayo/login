<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once dirname(__FILE__).'/clases/Usuario.php';
require_once dirname(__FILE__).'/../clases/ConectorBD.php';

$user=$_POST['user'];
$password=$_POST['password'];

if (Usuario::validate($user, $password)){
    //inicio de sesion
    session_start();
    $_SESSION['user']=$user;//se crea una variable de sesion
    
    
    $usuario=new Usuario("email", $user);
    if ($usuario->getIdtipousuario()==1){
        header("location: ../principal.php?CONTENIDO=inicio.php");
    }else if($usuario->getIdtipousuario()==2){
        header("location: ../principal.php?CONTENIDO=inicio.php");
    }
    
}
else{
    $mensaje="usuario y/o contraseña no valida";
    header("location: ../index.php?mensaje=$mensaje");//envia el mensaje de error si el usuario no es valido
}

