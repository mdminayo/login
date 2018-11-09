<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) .'/../clases/ConectorBD.php';
require_once dirname(__FILE__) .'/clases/Categoria.php';
foreach ($_GET as $Variable => $Valor) ${$Variable}=$Valor;
if($accion=='Modificar') $categoria=new Categoria ('id', $id);
else $categoria=new Categoria (null, null);
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
<h3><?=strtoupper($accion)?> CATEGORIAS</h3>
<form name="formulario" method="post" action="principal.php?CONTENIDO=world/categoriaActualizar.php">
    <table border="0">
        <tr><th>Nombre</th>
            <td>
                <input type="text" name="nombre" value="<?= $categoria->getNombre()?>"/>
            </td>
        </tr>
        <tr><th>Descripcion</th>
            <td>
                <textarea  name="descripcion" cols="25" rows="5"><?=$categoria->getDescripcion()?> </textarea>
            </td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?=$categoria->getid()?>"/>
    <input type="submit" name="accion" value="<?=$accion?>"/>
</form>
</center>

