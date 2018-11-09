<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//importacion de las clases que se requieren para este programa.

require_once dirname(__FILE__).'/../clases/ConectorBD.php';
require_once dirname(__FILE__).'/clases/Categoria.php';
//fin de importacion de las clases.

//recuperar las variables que llegan.
foreach ($_POST as $Variable => $Valor) ${$Variable}=$Valor; 
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor; 

//fin de recuperacion de las variables.


switch ($accion){
    case 'Adicionar':
        $categoria=new Categoria(null,null);
        $categoria->setNombre($nombre);
        $categoria->setDescripcion($descripcion);
        $categoria->grabar();
        break;
    case 'Modificar':
        $categoria=new Categoria(null,null);
        $categoria->setId($id);
        $categoria->setNombre($nombre);
        $categoria->setDescripcion($descripcion);
        $categoria->modificar();
        break;
    case 'Eliminar':
        $categoria=new Categoria(null, null);
        $categoria->setId($id);
        $categoria->eliminar();
        break;
}
header("Location: principal.php?CONTENIDO=world/categoria.php");

