<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) .'/../clases/ConectorBD.php';
require_once dirname(__FILE__) .'/clases/Imagen.php';
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;

if($accion=='Modificar') $imagen=new Imagen ('id', $id);
else $imagen=new Imagen (null, null);


/*$listaScriptBD="";*/
/*$arrego=scandir(dirname(__FILE__).'/../datos');*/

/*for ($i = 0; $i < count($arrego); $i++) {
    if ($arrego[$i]!='.' && $arrego[$i]!='..'){
        if ($arrego[$i]==$si->getScriptbd()) $auxiliar='selected';
        else $auxiliar='';
        $listaScriptBD.="<option $auxiliar>{$arrego[$i]}</option>";
    }
 }*/
?>
<center>
<h3><?=strtoupper($accion)?> IMAGENES</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=world/imagenActualizar.php" enctype="multipart/form-data">
    <table border="0">
        <tr><th>Archivo</th>
            <td>
                <input type="file" name="archivo" value="<?= $imagen->getArchivo()?>"/>
            </td>
        </tr>
        <tr><th>Descripcion</th>
            <td>
                <textarea  name="descripcion" cols="25" rows="5"><?=$imagen->getDescripcion()?> </textarea>
            </td>
        </tr>
        <tr><th>idevento</th>
            <td>
                <input type="number" value="<?= $imagen->getIdevento()?>"/>
            </td>
        </tr>
       
       
    </table>
    <input type="hidden" name="id" value="<?=$imagen->getid()?>"/>
    <input type="submit" name="accion" value="<?=$accion?>"/>
</form>
</center>

