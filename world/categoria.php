<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once dirname(__FILE__) .'/../clases/ConectorBD.php';
require_once dirname(__FILE__).'/clases/Categoria.php';
$datos= Categoria::getDatosEnObjetos(null, 'id');
$lista='';
for ($i = 0; $i < count($datos); $i++) {
    $objeto=$datos[$i];
    $lista.='<tr>';
    $lista.="<td>{$objeto->getNombre()}</td><td>{$objeto->getDescripcion()}</td>";
    $lista.='<td>';
    $lista.="<a href='principal.php?CONTENIDO=world/categoriaFormulario.php&accion=Modificar&id={$objeto->getId()}'><img src='presentacion/imagenes/modificar.png' title='Modificar'></a>";
    $lista.="<img src='presentacion/imagenes/eliminar.png' title='Eliminar' onClick='eliminar({$objeto->getId()});'/>";
    $lista.='</td>';
    $lista.='</tr>';
}
?>
<center>
<h3>LISTA DE CATEGORIAS</h3>
<table border="1">
    <tr><th>NOMBRE</th><th>DESCRIPCION</th>
        <th><a href="principal.php?CONTENIDO=world/categoriaFormulario.php&accion=Adicionar"><img src="presentacion/imagenes/adicionar.png" title="Adicionar"/></a></th>
    
    </tr>
    <?=$lista?>
</table>
</center>
<script type="text/javascript">
    function eliminar(id){
        if(confirm('Realmente desea eliminar este registro?')) 
            location='principal.php?CONTENIDO=world/categoriaActualizar.php&accion=Eliminar&id='+id;   
    }
</script>
