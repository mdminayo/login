<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__).'/../clases/ConectorBD.php';
require_once dirname(__FILE__).'/clases/Imagen.php';
//fin de importacion de las clases.

//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor; 
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor; 
$idevento=1;

//fin de recuperacion de las variables.

//ADICION DE IMAGENES
if($accion=='Adicionar'){
    $ruta = "presentacion";
    $archivo = $_FILES['archivo']['tmp_name'];
    $nombreArchivo = $_FILES['archivo']['name'];
    move_uploaded_file($archivo, $ruta . "/" . $nombreArchivo);
    $ruta = $ruta . "/" . $nombreArchivo;
}
if($accion=='Modificar'){
    $ruta = "presentacion";
    $archivo = $_FILES['archivo']['tmp_name'];
    $nombreArchivo = $_FILES['archivo']['name'];
    move_uploaded_file($archivo, $ruta . "/" . $nombreArchivo);
    $ruta = $ruta . "/" . $nombreArchivo;
}


switch ($accion){
    case 'Adicionar':
        $imagen=new Imagen(null,null);
        $imagen->setArchivo($ruta);
        $imagen->setDescripcion($descripcion);
        $imagen->setIdevento($idevento);
        $imagen->grabar();
        break;
    case 'Modificar':
        $imagen=new Imagen(null,null);
        $imagen->setId($id);
        $imagen->setArchivo($ruta);
        $imagen->setDescripcion($descripcion);
        $imagen->setIdevento($idevento);
        $imagen->modificar();
        break;
    case 'Eliminar':
        $imagen=new Imagen(null,null);
        $imagen->setId($id);
        $imagen->eliminar();
        break;
}
header("Location: principal.php?CONTENIDO=world/imagen.php");

